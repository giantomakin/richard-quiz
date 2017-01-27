@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

         <div class="row">
         	<div class="col-md-12">
         		<ul class="breadcrumb">
         		  <li><a href="#">Home</a></li>
         		  <li class="active">Create</li>
         		</ul>
         	</div>
             <div class="col-md-2">
				@include('layouts.left-panel')
             </div>
             <div class="col-md-10">
                 @include('contents.home')
             </div>
         </div>


        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
	$.get('http://quotes.rest/qod.json?category=inspire ').done(function(data){
		console.log(data.contents.quotes[0]);
		$('#q-content').text(data.contents.quotes[0].quote);
		$('#q-cite').text(data.contents.quotes[0].author);

	});
</script>
@endsection
