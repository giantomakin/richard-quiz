	<div class="panel panel-default">
	    <div class="panel-heading">Manage Quiz</div>

	    <div class="list-group">
	      <a href="{{url('home')}}" class="list-group-item {{ Request::is('home') ? 'active' : '' }}">Home</a>
	      <a href="{{url('create')}}" class="list-group-item {{ Request::is('create') ? 'active' : '' }}">Create</a>
	      <a href="{{url('list')}}" class="list-group-item {{ Request::is('list') ? 'active' : '' }}">List<span class="badge">{{$quiz_count}}</span></a>
	    </div>
	</div>
