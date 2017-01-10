@extends('quiz.layouts.base')

@section('content')
<div class="container-fluid">
	<div class="spinner" id="quizzer-loader" ng-show="isLoading">
	  <div class="double-bounce1"></div>
	  <div class="double-bounce2"></div>
	</div>
	<div class="row quizzer-container">
		<div class="animated fadeIn" ng-show="doneLoading">
			<h1 class="page-header" ng-cloak>
				@{{question}}
			</h1>
			<input type="hidden" name="key" id="key" value="{{$key}}">
			<div ng-repeat="item in items">

				<!-- First Blog Post -->

				<p class="lead" ng-cloak>
					@{{$index+1}}. @{{item.label}}
				</p>

				<img class="img-responsive" src="@{{item.image}}" alt="" ng-cloak>
				<br>

				<div class="radio icheck-success" ng-repeat="choice in item.choices" ng-cloak>

				    <input type="radio" name="choices-@{{item.answer_id}}" id="check-@{{item.answer_id}}@{{$index}}" value="@{{choice}}" class="radio-choices radio-choices-@{{item.answer_id}}" ng-click="selectChoice($event,item.answer_id)" />
				    <label style="font-size:16px;" for="check-@{{item.answer_id}}@{{$index}}" ng-cloak>@{{choice}}</label>

				</div>

				<div class="row mc-quiz-result" id="result-@{{item.answer_id}}" ng-cloak>
					<div class="col-md-12">
						<h1 ng-if="result.response == 'false'"><i style="color:red" class="fa fa-times" aria-hidden="true"></i></h1>
						<h1 ng-if="result.response == 'true'"><i style="color:green" class="fa fa-check" aria-hidden="true"></i></h1>
						<h2 ng-cloak>
							Answer is: @{{item.answer}}
						</h2>
						<br>
							<img class="img-responsive" src="@{{item.outcome_image}}" alt="@{{item.answer}}">

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
			<div class='row' style='margin-bottom: 20px' ng-show="showResult">
				<div class='col-md-12 text-center'>
					<div class="alert @{{alert}}">
						<h1 ng-cloak>@{{scoreresult}}</h1>
					</div>
					<h2 ng-cloak>Your score: @{{checked}} / @{{total}}</h2>
					<button type='button' class='btn btn-default btn-lg' onClick='location.reload()'>Retake</button>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection
