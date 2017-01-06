@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard - <small>You are logged in!</small></div>

                <div class="panel-body">
		                 <div class="row">
		                     <div class="col-md-4">
								@include('layouts.left-panel')
		                     </div>
		                     <div class="col-md-8">
		                         @include('contents.list')
		                     </div>
		                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
