@extends('quiz.layouts.front')

@section('content')
<div class="container-fluid">
	<div class="spinner" id="quizzer-loader" ng-show="isLoading">
	  <div class="double-bounce1"></div>
	  <div class="double-bounce2"></div>
	</div>
	<div class="row quizzer-container">
		<div class="col-md-12 animated fadeIn" id="widget-container" ng-show="doneLoading">
			<div class="col-md-12">
				<h1 class="quizzer-question hidden-xs" style="text-align:center;" ng-cloak>@{{question}}</h1>
				<h1 class="quizzer-question hidden-lg hidden-md hidden-sm" style="text-align:center;" ng-cloak>@{{question}}</h1>
				<input type="hidden" name="key" id="key" value="{{$key}}">
			</div>
			<div class="col-sm-6 col-md-4" ng-repeat="item in items">
				<a class="thumbnail single-images" href="#">
					<img src="@{{item.image}}" style="margin: 0 auto;" id="@{{item.answer_id}}" data-outcome="@{{item.outcome}}" data-ad="@{{item.ad}}" data-label="@{{item.label}}" ng-click="result($event)" data-img="@{{item.image}}" alt="" ng-cloak>
				</a>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12" id="result-container">

		</div>
	</div>
</div>
@endsection
