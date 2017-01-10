@extends('layouts.app')

@section('content')
<div class="container" ng-controller="backendCtrl">
    <div class="row">
        <div class="col-md-12">
             <div class="row">
             	<div class="col-md-12">
             		<ul class="breadcrumb">
             			<li><a href="#">Home</a></li>
             			<li><a href="#">Create</a></li>
             			<li class="active">Quiz</li>
             		</ul>
             	</div>
                 <div class="col-md-4">
					@include('layouts.left-panel')
                 </div>
                 <div class="col-md-8">
                     @include('contents.quiz')
                 </div>
             </div>

        </div>
    </div>
</div>
@endsection
