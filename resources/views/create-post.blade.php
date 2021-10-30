@extends('layouts.insta')

@section('navbar')
@include('components.sidenav', [
'active' => "dashboard",
'form' => ""
])
@endsection

@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
	{{Session::get('success')}}
</div>
@elseif(Session::has('forbidden'))
<div class="alert alert-danger">
	{{Session::get('forbidden')}}
</div>
@elseif(Session::has('message'))
<div class="alert alert-warning">
	{{Session::get('message')}}
</div>
@endif

<form enctype="multipart/form-data" action="{{ route('post.create.post') }}" method="POST">
	@csrf
	<input type="hidden" name="id" value="{{ Auth::guard('web')->user()->id }}">
	<hr class="my-4" />
	<h6 class="heading-small text-muted mb-4">Posting</h6>
	<div class="pl-lg-4">
		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<label class="form-control-label" for="input-username">Foto</label>
					<input type="file" id="input-username" class="form-control" name="foto">
				</div>
			</div>
			<div class="col-12">
				<div class="form-group">
					<label class="form-control-label" for="input-username">Caption</label>
					<input type="text" id="input-username" class="form-control" name="caption">
				</div>
			</div>
		</div>
	</div>
	<div class="pl-pg-12">
		<div class="form-group">
			<div class="row" style="justify-content: center;">
				<button class="btn btn-success" type="submit">Posting</button>
			</div>
		</div>
		<div>
</form>
@endsection