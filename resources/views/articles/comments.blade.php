<div>
  {{-- */ $comments = $article->comments()->get() /* --}}
  @foreach($comments as $comment)
  <div class="stream-headline feed-comment">
    <hr>
    <h5 class="stream-author feed-comment">
      {{ App\User::findOrFail($comment["user_id"])->name }}
      <small>{{ $comment->created_at }}</small>
    </h5>
    <article>
      <div class="stream-text feed-comment">
      {!! nl2br($comment["body"]) !!}
      </div>
      <div class="comment_image feed-comment">
      {{-- */$path = $comment->getImagePath()/* --}}
        @if (isset($path))
        <a href="{{ asset($path) }}"><img src="{{ asset($path) }}"></a>
        @endif
      </div>
    </article>
  </div>
  @endforeach
</div>

@if (Auth::check())
<div class="stream-composer media">
  <div class="media-body">
    <form name="jq_comment" action="/articles/comment/{{ $article->id }}/add" method="post" enctype="multipart/form-data">
      {!! csrf_field() !!}

      <div class="row-fluid">
        <textarea class="span12" name="body" style="height: 100px; resize: none;"></textarea>

        <div class="span6"><img class="js_comment_image_preview{{ $article->id }}" src=""></div>
        </div>

        <div class="clearfix">
        <div class="btn btn-small camera_btn_wrapper">
        <i class="icon-camera shaded"></i>

        <input class="js_btn_file btn_file" data-file-btn="{{ $article->id }}" type="file" name="image" accept="image/*">
        </div>
        <input class="js_btn_delete" data-delete-btn="{{ $article->id }}" type="button" value="×">


        </div>
        <div>
        <button type="submit"  class="btn btn-primary pull-left">
        Comment!
        </button>
      </div>
    </form>
  </div>
</div>
@endif