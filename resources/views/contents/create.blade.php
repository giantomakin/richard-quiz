<div class="panel panel-default">
	<div class="panel-heading">
		Create Quiz
	</div>

	<div class="panel-body">
		<form action="{{url('create')}}" role="form" method="post">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
				<label for="type">Type</label>
				<select name="type" class="form-control">
					<option value="se" >Single Quiz</option>
					<option value="co" >Poll Quiz</option>
					<option value="mc" >Multiplechoice Quiz</option>
				</select>
				@if ($errors->has('type'))
				<span class="help-block">
					<strong>{{ $errors->first('type') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title">Title</label>
				<input name="title" class="form-control" id="title" placeholder="Quiz Title">
				@if ($errors->has('title'))
				<span class="help-block">
					<strong>{{ $errors->first('title') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
			    <div class="col-md-12">
			        <button type="submit" class="btn btn-success pull-right">
			            <i class="fa fa-btn fa-sign-in"></i> Create Quiz
			        </button>

			    </div>
			</div>
		</form>
	</div>
</div>

