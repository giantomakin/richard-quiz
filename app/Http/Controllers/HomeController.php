<?php

namespace App\Http\Controllers;

use Models\Home\Home as HomeModel;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\Quiz\QuizRepository;
use App\Repositories\Quiz\CountableRepository;
use App\Repositories\Quiz\AdsRepository;
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

	private $rules3 = array(
		'content' => 'required'
		);

	const D_PATH = 'examimg';

	private $validator;
	protected $quiz;
	protected $countable;
	protected $ads;
	protected $data;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(QuizRepository $quiz, CountableRepository $countable, AdsRepository $ads)
    {
    	$this->middleware('auth');
    	$this->quiz = $quiz;
    	$this->countable = $countable;
    	$this->ads = $ads;
    	$this->data['quiz_count'] = $this->countable->count();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$colorarr = array(' ','blue-card','red-card','green-card','yellow-card');
    	$this->data['color'] = $colorarr[rand(0,4)];
    	return view('home',$this->data);
    }

    public function createView()
    {
    	return view('create',$this->data);
    }

    public function createUserView()
    {
    	return view('create-user',$this->data);
    }

    public function adsView()
    {
    	$this->data['ads_list'] = $this->ads->getAll();
    	return view('ads',$this->data);
    }

    public function quizList()
    {
    	$this->data['quizzes1'] = $this->quiz->findBy('type', 'se')->paginate(10);
    	$this->data['quizzes2'] = $this->quiz->findBy('type', 'co')->paginate(10);
    	$this->data['quizzes3'] = $this->quiz->findBy('type', 'mc')->paginate(10);
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
    			'type' => $request->type,
                'data_counter' => ($request->type == 'co') ?json_encode(array(0)) : ''
    			);
    		$id = $this->quiz->create($data)->id;
    		Session::flash('success', 'Added successfully');
    		return Redirect::to('quiz/' . $id);
    	}
    }

    public function createAd(Request $request)
    {
    	$this->validator = Validator::make($request->all(), $this->rules3);
    	if ($this->validator->fails()) {

    		return Redirect::to('ads')
    		->withErrors($this->validator);

    	} else {
    		$data = array(
    			'ad_content' => $request->content,
    			'ad_position' => $request->position
    			);
    		$id = $this->ads->create($data);
    		Session::flash('success', 'Added successfully');
    		return Redirect::to('ads');
    	}
    }

    public function ajaxGetQuiz($id)
    {
    	$quizzer = $this->quiz->find($id);
    	return Response::json($quizzer);
    }

    public function getQuiz($id)
    {
    	$quizzer = $this->quiz->find($id);
    	$this->data['quiz'] = $quizzer;
    	$this->data['action'] = url('update') . '/' . $id;

    	switch ($quizzer->type) {
    		case 'se':
    		$this->data['iframe_src'] = secure_url('quiz/single') . '/' . $quizzer->unique_id;
    		break;
    		case 'co':
    		$this->data['iframe_src'] = secure_url('quiz/poll') . '/' . $quizzer->unique_id;
    		break;
    		case 'mc':
    		$this->data['iframe_src'] = secure_url('quiz/multi') . '/' . $quizzer->unique_id;
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
    	$quizzermodel = $this->quiz->find($id);
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
    				$answers[$key]['image'] = secure_url('/') . '/' . self::D_PATH . '/' . $unique_name . '.' . $extension;
    				$imgs[] = secure_url('/') . '/' . self::D_PATH . '/' . $unique_name . '.' . $extension;

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
    					$answers[$key]['outcome_image'] = secure_url('/') . '/' . self::D_PATH . '/' . $outcome_img_unique_name . '.' . $outcome_img_extension;
    					$outcome_imgs[] = secure_url('/') . '/' . self::D_PATH . '/' . $outcome_img_unique_name . '.' . $outcome_img_extension;

    				}else{

    					$outcome_imgs[] = $answer['outcome_imagepath'];
    					$answers[$key]['outcome_image'] = $answer['outcome_imagepath'];

    				}
    			}


    			endforeach;

    			// $quizzermodel->data = stripslashes(str_replace(array("\'","'"),"",json_encode($answers)));
    			$quizzermodel->data = json_encode($answers, JSON_UNESCAPED_SLASHES);
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
    		$this->quiz->delete($id);
    		Session::flash('success', 'Deleted successfully');
    		return Redirect::to('list');
    	}

    	public function removeAd($id)
    	{
    		$this->ads->delete($id);
    		Session::flash('success', 'Deleted successfully');
    		return Redirect::to('ads');
    	}

    }
