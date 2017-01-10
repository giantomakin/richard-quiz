<div class="panel panel-default">
	<div class="panel-heading">
		Quiz
	</div>

	<div class="panel-body">
		<div class="page-title">
			<h3>
				{{$quiz['title']}}
			</h3>
			<div class="form-group">
				<label for="code">Code:</label>
				<textarea class="form-control" rows="5" id="code"><iframe class="hidden-xs hidden-sm hidden-md" width="100%" height="1200" scrolling="no" id="iframe-widget" allowfullscreen="allowfullscreen" style="border: none;" src="{{$iframe_src}}"></iframe><iframe class="hidden-lg" width="100%" height="600" scrolling="no" id="iframe-widget" allowfullscreen="allowfullscreen" style="border: none;" src="{{$iframe_src}}"></iframe></textarea>
			</div>
			<div class="form-actions">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" data-clipboard-target="#code">Copy!</button>
				</span>
			</div>
			<div class="form-actions">
				<input type="hidden" name="question_id" id="question_id" value="{{$quiz['id']}}">
			</div>

		</div>
		<div class="row">
			<div class="col-md-12">
				@if(Session::has('success'))
				<br>
				<div class="alert alert-success fade in block-inner">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{{ Session::get('success') }}
				</div>
				@endif
				@if (count($errors) > 0)
				<br>
				<div class="alert alert-danger fade in block-inner">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>

		</div>
		<div class="page-title">
			<h3>Add Choices</h3>

			<p><a href="{{$iframe_src}}" target="_blank" class="btn btn-info">Preview</a></p>
		</div>

		<form class="form-horizontal " action="{{$action}}" role="form" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
			<div class="panel panel-default">
				<div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-right2"></i> Add Quiz</h6></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2 control-label text-right">Question Title:</label> <div class="col-sm-10">
						<input name="question_title" type="text" value="@{{quiz.title}}" class="form-control">

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label text-right">Question Answer:</label> <div class="col-sm-10">
					<input name="question_answer" value="@{{quiz.answer}}" class="form-control" <?php echo ($quiz['type'] == 'se') ? '': 'readonly'; ?> >

				</div>
			</div>

			<div class="form-group" hidden>
				<label class="col-sm-2 control-label text-right">Question Ad:</label> <div class="col-sm-10">

				<textarea name="question_ad" class="form-control" rows="5">@{{quiz.ad}}</textarea>

			</div>
		</div>
		<?php if($quiz['type'] == 'mc'): ?>
			<div class="form-group" >
				<label class="col-sm-2 control-label text-right">Result Percentage:</label>
				<div class="col-sm-10">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">0 - 59</span>
						<input type="text" name="results[0]" class="form-control" value="@{{results[0]}}"aria-describedby="basic-addon1">
						<span class="input-group-addon" id="basic-addon1">60 - 69</span>
						<input type="text" name="results[1]" class="form-control" value="@{{results[1]}}"aria-describedby="basic-addon1">
						<span class="input-group-addon" id="basic-addon1">70 - 79</span>
						<input type="text" name="results[2]" class="form-control" value="@{{results[2]}}"aria-describedby="basic-addon1">
						<span class="input-group-addon" id="basic-addon1">80 - 89</span>
						<input type="text" name="results[3]" class="form-control" value="@{{results[3]}}"aria-describedby="basic-addon1">
						<span class="input-group-addon" id="basic-addon1">90 - 100</span>
						<input type="text" name="results[4]" class="form-control" value="@{{results[4]}}"aria-describedby="basic-addon1">
					</div>
				</div>
			</div>
		<?php endif; ?>
		<hr>
		<div id="answers-section">
			<?php if($quiz['type'] != 'mc') { ?>
			<div ng-repeat="item in items">
				<div id="answer-container-@{{$index+1}">

				<div class="form-group" hidden>

						<label class="col-sm-2 control-label text-right">Answer {{$index+1}} Label:
						</label>
						<div class="col-sm-10">
							<div class="input-group">

								<input name="answers[@{{$index+1}}][label]" value="@{{item.label}}" type="text" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button"  ng-click="removeAnswer(items, $index)">x</button>
								</span>
							</div>

						</div>
					</div>
					<div class="form-group">
						<a href="#" class="btn btn-danger pull-right" ng-click="removeAnswer(items, $index)" style="margin-right:20px"><i class="fa fa-times-circle" aria-hidden="true" style="margin:0"></i></a>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label text-right">Answer Image:</label> <div class="col-sm-10">

						<img src="@{{item.image}}" class="img-responsive">
						<input type="file" name="answers[@{{$index+1}}][image]" class="form-control input-image">
						<input type="hidden" name="answers[@{{$index+1}}][answer_id]" class="form-control" value="@{{$index+1}}">
						<input type="hidden" name="answers[@{{$index+1}}][img_path]" class="form-control" value="@{{item.image}}">

					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label text-right">Answer Outcome:</label> <div class="col-sm-10">
					<textarea name="answers[@{{$index+1}}][outcome]" class="form-control" rows="5">@{{item.outcome}}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Answer Ad:</label> <div class="col-sm-10">
				<textarea name="answers[@{{$index+1}}][ad]" class="form-control" rows="5">@{{item.ad}}</textarea>
			</div>
		</div>
	</div>
	<hr>
	<?php } else { ?>
	<div ng-repeat="item in items">
		<div id="answer-container-@{{$index+1}">

			<div class="form-group" >

				<label class="col-sm-2 control-label text-right">Question {{$index+1}} Label:
				</label>
				<div class="col-sm-10">
					<div class="input-group">

						<input name="answers[@{{$index+1}}][label]" value="@{{item.label}}" type="text" class="form-control">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"  ng-click="removeAnswer(items, $index)">x</button>
						</span>
					</div>

				</div>
			</div>
			<div class="form-group">
				<a href="#" class="btn btn-danger pull-right" ng-click="removeAnswer(items, $index)" style="margin-right:20px"><i class="fa fa-times-circle" aria-hidden="true" style="margin:0"></i></a>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label text-right">Answer Image:</label> <div class="col-sm-10">

				<img src="@{{item.image}}" class="img-responsive">
				<input type="file" name="answers[@{{$index+1}}][image]" class="form-control input-image">
				<input type="hidden" name="answers[@{{$index+1}}][answer_id]" class="form-control" value="@{{$index+1}}">
				<input type="hidden" name="answers[@{{$index+1}}][img_path]" class="form-control" value="@{{item.image}}">

			</div>

		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label text-right">Answer:</label> <div class="col-sm-10">
			<input name="answers[@{{$index+1}}][answer]" type="text" value="@{{item.answer}}" class="form-control">

		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label text-right">Choices:</label>
		<div class="col-sm-10">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">1</span>
				<input type="text" name="answers[@{{$index+1}}][choices][0]" class="form-control" placeholder="Choice 1" aria-describedby="basic-addon1" value="@{{item.choices[0]}}">
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">2</span>
				<input type="text" name="answers[@{{$index+1}}][choices][1]" class="form-control" placeholder="Choice 1" aria-describedby="basic-addon1" value="@{{item.choices[1]}}">
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">3</span>
				<input type="text" name="answers[@{{$index+1}}][choices][2]" class="form-control" placeholder="Choice 1" aria-describedby="basic-addon1" value="@{{item.choices[2]}}">
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">4</span>
				<input type="text" name="answers[@{{$index+1}}][choices][3]" class="form-control" placeholder="Choice 1" aria-describedby="basic-addon1" value="@{{item.choices[3]}}">
			</div>

		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label text-right">Answer Outcome:</label>
		<div class="col-sm-10">
			<textarea name="answers[@{{$index+1}}][outcome]" class="form-control" rows="5">@{{item.outcome}}</textarea>
		</div>
		<label class="col-sm-2 control-label text-right">Outcome Image:</label>
		<div class="col-sm-10">

			<img src="@{{item.outcome_image}}" class="img-responsive">
			<input type="file" name="answers[@{{$index+1}}][outcome_image]" class="form-control input-image">
			<input type="hidden" name="answers[@{{$index+1}}][outcome_imagepath]" class="form-control" value="@{{item.outcome_image}}">

		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label text-right">Answer Ad:</label> <div class="col-sm-10">
		<textarea name="answers[@{{$index+1}}][ad]" class="form-control" rows="5">@{{item.ad}}</textarea>
	</div>
</div>
</div>
<hr>
<?php } ?>
</div>
</div>

<div class="form-actions text-right">
	<input type="submit" value="Save Quiz" class="btn btn-primary">
	<button type="button" class="btn btn-primary" ng-click="addAnswer($event)">Add Answer</button>
</div>


</div>
</div>
</form>

</div>
</div>

