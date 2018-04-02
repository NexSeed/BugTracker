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

<script>

  function js_deleteimage($article_id,$image_num) {

      deleteImageAjax($article_id,$image_num);
  }

  function deleteImageAjax($article_id,$image_num) {

    $url = '/articles/deleteImage/'+ $article_id + '/' + $image_num;
    console.log($url );
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url : $url,
        contentType: 'application/json',
        dataType: 'json'
      })
      .done((data, textStatus, jqXHR) => {

          console.log('done');
          console.log(data);
          console.log(textStatus);

      })
      .fail((jqXHR, textStatus, errorThrown) => {
          console.log('fail', jqXHR.status);
          console.log(jqXHR);
          console.log(textStatus);
                    console.log(errorThrown);
          var res = $.parseJSON(jqXHR.responseText);
          console.log(res.code,res.message);
          console.log(res.message);

          alert('できなかった');
          confirm('どうする？');
      });

    
  }

  $(function(){

    $(document).on('change', '.js_btn_file', function(e){
      var $fileNum = $(this).attr('data-file-btn');
        $file = e.target.files[0],
        $reader = new FileReader(),
        $preview = $('.js_form_image_preview' + $fileNum);
        console.log('koko');
      if($file.type.indexOf('image') < 0){
        return false;
      }

      $reader.onload = (function($file){
        return function(e){
          $preview.attr('src', e.target.result);
          $(this).val($file['name']);

          $fileSize01 = $file['size'];
          $fileType01 = $file['type'];
        };
      })($file);
      $reader.readAsDataURL($file);
    });

  });

  $(document).on('click', '.js_btn_delete', function(){
    var $deleteNum = $(this).attr('data-delete-btn');
    $('.js_form_image_preview' + $deleteNum).attr('src', '');
  });

</script>

@endsection