@extends('layout')

@section('title', "New inquiry")

@section('content')



		<form method="POST" action="/articles" enctype="multipart/form-data">

	        @include('articles.form', ['submitButtonTitle' => 'Add Article'])
		</form>

@endsection


