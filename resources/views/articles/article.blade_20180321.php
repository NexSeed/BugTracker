					<div class="media-body">
						<div class="stream-headline">
							<h5 class="stream-author">
								{{ $article->user()->first()->name }}
								<small>{{ $article->created_at }}</small>
							</h5>
					    	<article>
										{{ $article->system }} <br>
									type : {{ $article->type }} <br>
								    Urgency :{{ $article->urgency }} <br>
								<h4><a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a></h4>
						        <div class="stream-text">
						          {{ $article->body }}
						        </div>
								<div>
									<div class="article-image">
										<a href="{{ $article->getImage1Path() }}"><img src="{{ $article->getImage1Path() }}"></a>
										<a href="{{ $article->getImage2Path() }}"><img src="{{ $article->getImage2Path() }}"></a>
										<a href="{{ $article->getImage3Path() }}"><img src="{{ $article->getImage3Path() }}"></a>
									</div>
								</div>
					    	</article>
						</div>
						<hr>
						<div class="stream-options">
							@if (Auth::check())
								@if ( $article->i_like_this() <= 0)
									<form action="/articles/{{ $article->id }}/like" method="post">
								@else
									<form action="/articles/{{ $article->id }}/unlike" method="post">
								@endif
									{!! csrf_field() !!}
									
									@if ( $article->i_like_this() <= 0)
										<button type="submit" class="btn btn-small"><i class="icon-thumbs-up shaded"></i>
											Like {{ $article->likes_count }}
										</button>
									@else
										<button type="submit" class="btn btn-small"><i class="icon-thumbs-up shaded"></i>
											Like取り消す {{ $article->likes_count }}
										</button>
									@endif
	
										<a href="" class="jq_comment_triger btn btn-small" data-box-num="{{ $article->id }}"><i class="icon-reply shaded"></i>Comment</a>
									</form>
							@endif
						</div>
					</div>
