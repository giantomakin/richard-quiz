	<div class="panel panel-default">
	    <div class="panel-heading">Menu</div>

	    <div class="list-group">
	      <a href="{{url('home')}}" class="list-group-item {{ Request::is('home') ? 'active' : '' }}">Home</a>
	      <a href="{{url('create/user')}}" class="list-group-item {{ Request::is('create/user') ? 'active' : '' }}">Create User</a>
	      <a href="{{url('create')}}" class="list-group-item {{ Request::is('create') ? 'active' : '' }}">Create Quiz</a>
	      <a href="{{url('list')}}" class="list-group-item {{ Request::is('list') ? 'active' : '' }}">My Quizzes<span class="badge">{{$quiz_count}}</span></a>
	    </div>
	</div>
