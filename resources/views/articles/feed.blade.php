@extends('layout')

@section('title',"TimeLine")

@section('content')

@include('errors.form_errors')

@include('articles.tabs')

<div class="module">





		<div class="module-body">
			<div class="article_list">
{{--         @if (Auth::check())
        <div class="btn-box-row row-fluid">
                <a href="/articles/create" class="btn-box small span2">
                    <i class="icon-edit"></i>
                      <b>New Report</b>
                </a>
        </div>
        @endif
 --}}
				@foreach($articles as $article)
				<div class="media stream">

					@include('articles.article')

					<div class="media-body jq_comment_box{{ $article->id }}">
						@include('articles.comments')

					</div>
				</div>
				@endforeach
			</div>
			{!! $articles->render() !!}
<!-- 						article_list -->
		</div>
	</div>




@endsection <!--  content -->

@section('additionaljs')

<script>
	$(function(){

		$(document).on('click', '.jq_comment_triger', function(){

			var $currentNum = $(this).attr('data-box-num'),
				$commentBox = $('.jq_comment_box' + $currentNum);

			if(!$(this).hasClass('on')){
				$(this).addClass('on');
				$commentBox.addClass('on');
				$commentBox.slideDown(300);

			}else{
				$(this).removeClass('on');
				$commentBox.removeClass('on');
				$commentBox.slideUp(300);
			}
			return false;
		});

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

