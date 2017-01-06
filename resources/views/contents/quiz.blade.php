<div class="panel panel-default">
	<div class="panel-heading">
		<ul class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li><a href="#">Create</a></li>
		<li class="active">Quiz</li>
		</ul>
	</div>

	<div class="panel-body">
		@if(Session::has('success'))
		<div class="alert alert-success fade in block-inner">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{{ Session::get('success') }}
		</div>
		@endif
		{{print_r($quiz)}}
	</div>
</div>

