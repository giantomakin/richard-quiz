<div class="panel panel-default">
	<div class="panel-heading">
		<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">List</li>
		</ul>
	</div>

	<div class="panel-body">
		@if(Session::has('success'))
		<div class="alert alert-success fade in block-inner">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{{ Session::get('success') }}
		</div>
		@endif
		<ul class="list-group">
		@foreach ($quizzes as $quiz)
		     <li class="list-group-item">
		     	<a href="{{url('quiz')}}/{{$quiz->id}}">{{$quiz->title}}</a>
		     	<a href="{{url('remove-quiz')}}/{{$quiz->id}}" class="pull-right" id="{{$quiz->id}}" ng-click="removeQuiz($event)">
		     		<i class="fa fa-times" id="{{$quiz->id}}"></i>
		     	</a>
		     </li>
		@endforeach
		</ul>
		<div class="text-center">
			{{ $quizzes->links() }}
		</div>
	</div>
</div>

