<?php

namespace App\Http\Controllers;

use Models\Home\Home as HomeModel;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;
use Response;

class HomeController extends Controller
{

	private $rules = array(
		'title' => 'required',
		'type' => 'required'
		);

	private $rules2 = array(
		'question_title' => 'required',
		'question_answer' => 'required'
		);

	const D_PATH = 'examimg';

	private $validator;

	protected $data;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->data['quiz_count'] = HomeModel::all()->count();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home',$this->data);
    }

    public function createView()
    {
    	return view('create',$this->data);
    }

    public function quizList()
    {
    	$this->data['quizzes'] = HomeModel::paginate(10);
    	return view('list',$this->data);
    }

    public function createQuiz(Request $request)
    {
    	$this->validator = Validator::make($request->all(), $this->rules);
    	if ($this->validator->fails()) {

    		return Redirect::to('create')
    		->withErrors($this->validator);

    	} else {
    		$data = array(
    			'title' => $request->title,
    			'unique_id' => time() . uniqid(),
    			'type' => $request->type
    			);
    		$id = HomeModel::create($data)->id;
    		Session::flash('success', 'Added successfully');
    		return Redirect::to('quiz/' . $id);
    	}
    }

    public function ajaxGetQuiz($id)
    {
    	$quizzer = HomeModel::find($id);
    	return Response::json($quizzer);
    }

    public function getQuiz($id)
    {
    	$quizzer = HomeModel::find($id);
    	$this->data['quiz'] = $quizzer;
    	$this->data['action'] = url('update') . '/' . $id;

    	switch ($quizzer->type) {
    		case 'se':
    			$this->data['iframe_src'] = url('quiz/single') . '/' . $quizzer->unique_id;
    			break;
    		case 'co':
    			$this->data['iframe_src'] = url('quiz/poll') . '/' . $quizzer->unique_id;
    			break;
    		case 'mc':
    			$this->data['iframe_src'] = url('quiz/multi') . '/' . $quizzer->unique_id;
    			break;
    	}

    	return view( 'quiz', $this->data );
    }

    public function updateQuiz(Request $request,$id)
    {
    	$quiz = $request->all();
    	$answers = $quiz['answers'];
    	$imgs = [];
    	$counter = [];
    	$flag = false;
    	$outcome_flag = false;
    	$quizzermodel = HomeModel::find($id);
    	$this->validator = Validator::make($request->all(), $this->rules2);

    	if ($this->validator->fails()) {

    		return Redirect::to('quiz/' . $id)->withErrors($this->validator);

    	} else {

    		foreach ($answers as $key => $answer):

    			if (is_object($answers[$key]['image'])) {

    				$flag = true;
    				$unique_name = time() . uniqid();
    				$extension = $answer['image']->getClientOriginalExtension();
    				$filename = $answer['image']->move(self::D_PATH, $unique_name . '.' . $extension);
    				$answers[$key]['image'] = url('/') . '/' . self::D_PATH . '/' . $unique_name . '.' . $extension;
    				$imgs[] = url('/') . '/' . self::D_PATH . '/' . $unique_name . '.' . $extension;

    				if(!empty($quizzermodel->data_counter))
    				{
    					$counter[] = 0;
    				}

    			} else {

    				$imgs[] = $answer['img_path'];
    				$answers[$key]['image'] =$answer['img_path'];

    			}

    			if($quizzermodel->type == 'mc'){
    				$quizzermodel->results = json_encode($quiz['results']);
    				if (is_object($answers[$key]['outcome_image'])) {
    				$outcome_flag = true;
    				$outcome_img_unique_name = time() . uniqid();
    				$outcome_img_extension = $answer['outcome_image']->getClientOriginalExtension();
    				$outcome_img_filename = $answer['outcome_image']->move(self::D_PATH, $outcome_img_unique_name . '.' . $outcome_img_extension);
    				$answers[$key]['outcome_image'] = url('/') . '/' . self::D_PATH . '/' . $outcome_img_unique_name . '.' . $outcome_img_extension;
    				$outcome_imgs[] = url('/') . '/' . self::D_PATH . '/' . $outcome_img_unique_name . '.' . $outcome_img_extension;

    				}else{

    					$outcome_imgs[] = $answer['outcome_imagepath'];
    					$answers[$key]['outcome_image'] = $answer['outcome_imagepath'];

    				}
    			}


    			endforeach;

    			$quizzermodel->data = stripslashes(str_replace(array("\'","'"),"",json_encode($answers)));
    			$quizzermodel->title = $quiz['question_title'];
    			$quizzermodel->answer = $quiz['question_answer'];
    			if(!empty($quizzermodel->data_counter)){
    				$quizzermodel->data_counter = json_encode($counter);
    			}
    			if ($flag) : $quizzermodel->data_img = json_encode($imgs); endif;
    			if ($outcome_flag) : $quizzermodel->outcome_img = json_encode($outcome_imgs); endif;
    			$quizzermodel->save();

    			Session::flash('success', 'Added successfully');
    			return Redirect::to('quiz/' . $id);
    		}
    	}

    public function removeQuiz($id)
    {
    	HomeModel::destroy($id);
    	Session::flash('success', 'Deleted successfully');
    	return Redirect::to('list');
    }
}
