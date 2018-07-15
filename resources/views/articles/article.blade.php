					<div class="media-body">
						<div class="stream-headline">
							<h5 class="stream-author">
								{{ $article->user()->first()->name }}
								<small>{{ $article->created_at }}</small>  status : {{ $article->status() }}
							</h5>
				    	<article>
				    			<ul class="ul_in_article">
										<li><span class="li_in_article">System</span>  {{ $article->system }} </li>
										<li><span class="li_in_article">Type</span>  {{ $article->type }}  </li>
								    <li><span class="li_in_article">Urgency</span>  {{ $article->urgency }}  </li>
							    </ul>
	            @if (!(isset($page) && $page == 'show'))

							<h4><a href={{ url('articles', $article->id)}}>{{ $article->id }} : {{ 
								$article->title }}</a></h4>
							@else
								<br>
								
							@endif

					        <div class="stream-text feed_artcile">
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
										<button id="js-button-like" class="btn btn-small jscl-button-like" data-like-num="{{ $article->id }}"><i class="icon-ok shaded"></i>
											Me too {{ $article->likes_count }}
										</button>
									@else
										<button id="js-button-unlike" class="btn btn-small jscl-button-like" data-like-num="{{ $article->id }}"><i class="icon-ok shaded"></i>
											Me too Cancel {{ $article->likes_count }}
										</button>
									@endif

			            @if (!(isset($page) && $page == 'show'))

										<a href="" class="jq_comment_triger btn btn-small" data-box-num="{{ $article->id }}"><i class="icon-reply shaded"></i>Comment</a>
									@endif
							@endif
						</div>
					</div>
