@extends('layout')

@section('title', "Detail/".$article->title)


@section('content')

@include('errors.form_errors')

  <h3>Detail/Edit</h3>

@if (Auth::check())
	@if (Auth::id() == $article->user_id || App\User::findOrfail(Auth::id())->user_type == 1)
		<form method="POST" action="/articles/{{$article->id }}" accept-charset="UTF-8">
	  	{!! link_to(action('ArticlesController@edit', ['id' => $article->id]), '編集', ['class' => 'btn']) !!}
			<input name="_method" type="hidden" value="DELETE">
			{!! csrf_field() !!}
			<input class="btn" type="submit" value="Delete" onclick="return confirm('本当に削除しますか？');">
		</form>
	@endif
@endif
  <hr/>

@include('articles.article')

	<div class="media-body">

	@include('articles.comments')

	</div>



@endsection


@section('additionaljs')

<script>
	$(function(){
		$(document).on('change', '.js_btn_file', function(e){
			var $fileNum = $(this).attr('data-file-btn');
				$file = e.target.files[0],
				$reader = new FileReader(),
				$preview = $('.js_comment_image_preview' + $fileNum);

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

		$('.js_comment_image_preview' + $deleteNum).attr('src', '');
	});


	$(document).on('click', '.jscl-button-like', function(){
		var $id = $(this).attr('id'),
			$currentNum = $(this).attr('data-like-num');


		if($id == 'js-button-like'){
			likeAjax(true, $currentNum );
			
		}else if($id == 'js-button-unlike'){
			likeAjax(false, $currentNum );
			
		}
		
			
	});
	
	function likeAjax($isLike,$currentNum) {
		
		if ($isLike == true) {
			$url = '/articles/'+ $currentNum + '/like';

		}
		else {
			$url = '/articles/'+ $currentNum + '/unlike';
		}
		
		$.ajax({
				headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	},
				type: "POST",
				url : $url,
				contentType: 'application/json',
				dataType: 'json'
				
			})
			.done((data, textStatus, jqXHR) => {
			    $text = '<i class="icon-thumbs-up shaded"></i>' + 'Like取り消し ' + data['likes_count'];
			    console.log($text);
			    if ($isLike == true) {
				    console.log($(this).attr('id', 'js-button-unlike'));
				    
		    		$('#js-button-like').attr('id', 'js-button-unlike').html('<i class="icon-thumbs-up shaded"></i>' + 'Like取り消し ' + data['likes_count']);
		    		console.log("unlikeにする");
		    	}
		    	else {
		    		$('#js-button-unlike').attr('id', 'js-button-like').html('<i class="icon-thumbs-up shaded"></i>' + 'Like ' + data['likes_count']);
		    		console.log("likeにする");
		    	}
	
			})
			.fail((jqXHR, textStatus, errorThrown) => {
			    console.log('fail', jqXHR.status);
			    alert('できなかった');
			    confirm('どうする？');
			});

		
	}
</script>




@endsection <!--  additionaljs -->
