@extends('quiz.layouts.front')

@section('content')
<div class="container-fluid">
	<div class="spinner" id="quizzer-loader" ng-show="isLoading">
	  <div class="double-bounce1"></div>
	  <div class="double-bounce2"></div>
	</div>
	<div class="row quizzer-container">
		<div class="animated fadeIn" ng-show="doneLoading" style=" text-align:center;">
			<div class="col-md-12"  ng-show="doneLoading">

				<h1 class="page-header" ng-cloak>
					@{{question}}
				</h1>
				<input type="hidden" name="key" id="key" value="{{$key}}">
				<div ng-repeat="item in items">

					<!-- First Blog Post -->

					<p class="lead" ng-cloak>
						@{{$index+1}}. @{{item.label}}
					</p>

					<img class="img-responsive" src="@{{item.image}}" alt="" style="margin: 0 auto;" ng-cloak>
					<br>

					<div class="radio icheck-success" ng-repeat="choice in item.choices" ng-cloak>

					    <button id="check-@{{item.answer_id}}@{{$index}}" value="@{{choice}}" type="button" class="btn btn-primary btn-block radio-choices radio-choices-@{{item.answer_id}}" ng-click="selectChoice($event,item.answer_id)">@{{choice}}</button>

					</div>

					<div class="row mc-quiz-result" id="result-@{{item.answer_id}}" ng-cloak>
						<div class="col-md-12">
							<h1 ng-if="result.response == 'false'"><i style="color:red" class="fa fa-times" aria-hidden="true"></i></h1>
							<h1 ng-if="result.response == 'true'"><i style="color:green" class="fa fa-check" aria-hidden="true"></i></h1>
							<h2 ng-cloak>
								Answer is: @{{item.answer}}
							</h2>
							<br>
								<img ng-if="item.outcome_image != ''" class="img-responsive" src="@{{item.outcome_image}}" alt="@{{item.answer}}" style="margin: 0 auto;">

							<blockquote class="blockquote" style="margin-top:10px">
							  <p class="m-b-0" ng-cloak>@{{item.outcome}}</p>
							</blockquote>
							<hr>
							<div class="row" id="result-ad-@{{item.answer_id}}" ng-cloak>
								@{{item.ad}}
							</div>
						</div>
					</div>

					<hr>

				</div>
			</div>

		</div>

	</div>
	<div class="row" ng-show="showResult">
			<div class="col-md-12" id="result-container">
			<div style="margin:15px; padding: 10px; border:5px solid #000; text-align: center;">
				<div class="alert @{{alert}}" style="margin:5px;">
					<h1 ng-cloak>@{{scoreresult}}</h1>
				</div>
				<h2 ng-cloak>Your score: @{{checked}} / @{{total}}</h2>
				<button type='button' class='btn btn-default btn-lg retake-btn' onClick='location.reload()'>Retake</button>
				<br>
			</div>
			</div>
	</div>
</div>
@endsection
