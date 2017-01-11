<div class="panel panel-default">
	<div class="panel-heading">
		My Quizzes
	</div>

	<div class="panel-body">
		@if(Session::has('success'))
		<div class="alert alert-success fade in block-inner">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{{ Session::get('success') }}
		</div>
		@endif
		<ul class="list-group">
		<h2>Single Quiz</h2>
		@foreach ($quizzes1 as $quiz)
		     <li class="list-group-item">
		     	<a href="{{url('quiz')}}/{{$quiz->id}}">{{$quiz->title}}</a>
		     	<a href="{{url('remove-quiz')}}/{{$quiz->id}}" class="pull-right" id="{{$quiz->id}}" ng-click="removeQuiz($event)">
		     		<i class="fa fa-times" id="{{$quiz->id}}"></i>
		     	</a>
		     </li>
		@endforeach
		</ul>
		<div class="text-center">
			{{ $quizzes1->links() }}
		</div>
		<ul class="list-group">
		<h2>Poll Quiz</h2>
		@foreach ($quizzes2 as $quiz)
		     <li class="list-group-item">
		     	<a href="{{url('quiz')}}/{{$quiz->id}}">{{$quiz->title}}</a>
		     	<a href="{{url('remove-quiz')}}/{{$quiz->id}}" class="pull-right" id="{{$quiz->id}}" ng-click="removeQuiz($event)">
		     		<i class="fa fa-times" id="{{$quiz->id}}"></i>
		     	</a>
		     </li>
		@endforeach
		</ul>
		<div class="text-center">
			{{ $quizzes2->links() }}
		</div>
		<ul class="list-group">
		<h2>Multi Quiz</h2>
		@foreach ($quizzes3 as $quiz)
		     <li class="list-group-item">
		     	<a href="{{url('quiz')}}/{{$quiz->id}}">{{$quiz->title}}</a>
		     	<a href="{{url('remove-quiz')}}/{{$quiz->id}}" class="pull-right" id="{{$quiz->id}}" ng-click="removeQuiz($event)">
		     		<i class="fa fa-times" id="{{$quiz->id}}"></i>
		     	</a>
		     </li>
		@endforeach
		</ul>
		<div class="text-center">
			{{ $quizzes3->links() }}
		</div>
	</div>
</div>

