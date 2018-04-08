@extends('layout')

@section('title', "Edit")

@section('content')

  <h4>{{ $article->title }}</h4>

{{--   <hr/>
 --}}

  @include('errors.form_errors')

    {!! Form::model($article, ['method' => 'PATCH', 'url' => ['articles', $article->id] , 'enctype' => "multipart/form-data" ]) !!}

      @include('articles.form', ['submitButtonTitle' => 'Edit Article'])


    {!! Form::close() !!}


@endsection <!--  content -->


@section('additionaljs')

  @include('articles.form_js')

@endsection