					<div class="media-body">
						<div class="stream-headline">
							<h5 class="stream-author">
								{{ $article->user()->first()->name }}
								<small>{{ $article->created_at }}</small>  status : {{ $article->status() }}
							</h5>
					    	<article>
										system : {{ $article->system }} <br>
									type : {{ $article->type }} <br>
								    Urgency :{{ $article->urgency }} <br>
								<h4><a href="{{ url('articles', $article->id) }}">{{ $article->title }}</a></h4>
						        <div class="stream-text">
						          {!! nl2br($article->body) !!}
						        </div>
								<div>
									<div class="article-image">
										{{-- */$path = $article->getImage1Path()/* --}}
										@if (isset($path))
											<img src="{{ asset($path) }}" alt="image1">
										@endif
										{{-- */$path = $article->getImage2Path()/* --}}
										@if (isset($path))
											<img src="{{ asset($path) }}" alt="image2">
										@endif
										{{-- */$path = $article->getImage3Path()/* --}}
										@if (isset($path))
											<img src="{{ asset($path) }}" alt="image3">
										@endif
									</div>
								</div>
					    	</article>
						</div>
						<div class="stream-options">
							@if (Auth::check())
							<hr>
									@if ( $article->i_like_this() <= 0)
										<button id="js-button-like" class="btn btn-small jscl-button-like" data-like-num="{{ $article->id }}"><i class="icon-thumbs-up shaded"></i>
											Like {{ $article->likes_count }}
										</button>
									@else
										<button id="js-button-unlike" class="btn btn-small jscl-button-like" data-like-num="{{ $article->id }}"><i class="icon-thumbs-up"></i>
											Like取り消す {{ $article->likes_count }}
										</button>
									@endif

			            @if (!(isset($page) && $page == 'show'))

										<a href="" class="jq_comment_triger btn btn-small" data-box-num="{{ $article->id }}"><i class="icon-reply shaded"></i>Comment</a>
									@endif
							@endif
						</div>
					</div>
