<?php

namespace App\Http\Controllers;

use Models\Home\Home as HomeModel;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\Quiz\QuizRepository;
use App\Repositories\Quiz\CountableRepository;
use Validator;
use Redirect;
use Session;
use Response;

class FrontController extends Controller
{

	protected $quiz;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(QuizRepository $quiz)
    {
    	$this->quiz = $quiz;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function result($unique_id,$ans)
    {
    	$quizzer = $this->quiz->findBy('unique_id',$unique_id)->first();

    	if ($ans == $quizzer['answer']) {

    		$data['result'] = "<h1 class='quizzer-question text-center'>You got it Right!</h2>";

    	} else {

    		$data['result'] = "<h1 class='quizzer-question text-center'>Sorry! Try Again.</h2>";
    	}
    	$data['ad'] = $quizzer['ad'];
    	return Response::json($data);
    }

    public function resultMC(Request $request)
    {
    	$quizzer = $this->quiz->findBy('unique_id',$request->key)->first();
    	$datas =  json_decode($quizzer->data, true);

    	foreach ($datas as $key => $value) {
    		if($value['answer_id'] == $request->id){
    			if($value['answer'] == $request->value){
    				return  Response::json(["response" =>"true" , "ad" => $value['ad']]);
    			} else {
    				return Response::json(["response" =>"false" , "ad" => $value['ad']]);
    			}
    		}
    		continue;

    	}
    }

    public function getQuiz($unique_id)
    {
    	$quizzer = $this->quiz->findBy('unique_id',$unique_id)->first();
    	return Response::json($quizzer);
    }

    public function getSingleQuiz($unique_id)
    {
    	$data['key'] = $unique_id;
        return view('quiz.templates.single-quiz',$data);
    }

    public function getMultiQuiz($unique_id)
    {
    	$data['key'] = $unique_id;
    	return view('quiz.templates.multi-quiz',$data);
    }

    public function getPollQuiz($unique_id)
    {
    	$data['key'] = $unique_id;
    	return view('quiz.templates.poll-quiz', $data);
    }

    public function updateCounter(Request $request)
    {
    	$id = $request->id;
    	$counterArr = $request->counters;

    	$quizz = $this->quiz->find($id);
    	$quizz->data_counter = json_encode($counterArr);
    	$quizz->save();

    	echo $quizz->data;

    }

}
