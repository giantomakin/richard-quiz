<div class="panel panel-default">
	<div class="panel-heading">
		My Ads
	</div>

	<div class="panel-body">
		@if(Session::has('success'))
		<div class="alert alert-success fade in block-inner">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{{ Session::get('success') }}
		</div>
		@endif
		<form action="{{url('ads/create')}}" role="form" method="post">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
				<label for="comment">Ad Here:</label>
				<textarea class="form-control" rows="5" id="comment" name="content"></textarea>
				@if ($errors->has('content'))
				<span class="help-block">
					<strong>{{ $errors->first('content') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group">
				<label for="type">Position</label>
				<select name="position" class="form-control">
					<option value="" readonly>- Select Position -</option>
					<option value="main" >Main</option>
					<option value="sidebar" >Sidebar</option>
					<option value="right" >Right</option>
					<option value="show-first" >Show First</option>
					<option value="show-last" >Show Last</option>
				</select>

			</div>
			<div class="form-group">
				<div class="col-md-12">
					<button type="submit" class="btn btn-success pull-right">
						<i class="fa fa-btn fa-sign-in"></i> Add Ad
					</button>

				</div>
			</div>

		</form>

		<ul class="list-group">
		<h2>Ads List</h2>
		@forelse ($ads_list as $ad)
		    <li class="list-group-item">
		     	{{$ad->ad_content}}
		     	<a href="{{url('ads/remove')}}/{{$ad->ad_id}}" class="pull-right" id="{{$ad->ad_id}}">
		     		<i class="fa fa-times" id="{{$ad->ad_id}}"></i>
		     	</a>
		     </li>
		@empty
		    <p>Empty</p>
		@endforelse
		</ul>
	</div>

</div>


