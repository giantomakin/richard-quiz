<?php

namespace App\Http\Controllers;

use Models\Home\Home as HomeModel;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;

class HomeController extends Controller
{

	private $rules = array(
		'title' => 'required',
		'type' => 'required'
		);
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
    	$this->data['quizzes'] = HomeModel::paginate(5);
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


    public function getQuiz($id)
    {
    	$quizzer = HomeModel::find($id);
    	$this->data['quiz'] = $quizzer;
    	//$this->assets['action'] = secure_url('admin/quizzer/update') . '/' . $id;

    	// switch ($quizzer->type) {
    	// 	case 'se':
    	// 		$this->assets['iframe_src'] = url('quiz/widget') . '/' . $quizzer->unique_id;
    	// 		break;
    	// 	case 'co':
    	// 		$this->assets['iframe_src'] = url('quiz/widget/co') . '/' . $quizzer->unique_id;
    	// 		break;
    	// 	case 'mc':
    	// 		$this->assets['iframe_src'] = url('quiz/widget/mc') . '/' . $quizzer->unique_id;
    	// 		break;
    	// }

    	return view( 'quiz', $this->data );
    }

    public function removeQuiz($id)
    {
    	HomeModel::destroy($id);
    	Session::flash('success', 'Deleted successfully');
    	return Redirect::to('list');
    }
}
