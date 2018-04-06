      {!! csrf_field() !!}

		@include('errors.form_errors')
			<div class="module">
        	<div class="module-head">
          	<h3>Forms <small>'*' is required</small></h3>
        	</div>
			  	<div class="module-body">
            @if (isset($page) && $page == 'edit')
              <div class="control-group">
                <div class="controls">
                  <span class="span1 control-label">Status  *</span>
                  {!! Form::select('status_list_id',
                        ['1'=>'NotYet',
                        '2'=>'Doing',
                        '3'=>'Done',
                        '4'=>'Pending'], old('status_list_id')) !!}
                </div>
              </div>
            @endif
          <div class="control-group">
            <div class="controls">
              <span class="span1 control-label">System  *</span>
						  {!! Form::select('system', ['ERP'=>'ERP','HackersStory'=>'HackersStory'], old('system')) !!}
            </div>
          </div>
        	<div class="control-group">
            <span class="span1 control-label">Type  *</span>
            <label class="radio inline">
							@if(Input::old('type') == 'Propose')
								{!! Form::radio('type', "Propose", ['checked' => '' ]) !!}
							@else
								{!! Form::radio('type', "Propose") !!}
							@endif
                      Propose
            </label>
            <label class="radio inline">
							@if(Input::old('type') == 'Bug')
								{!! Form::radio('type', "Bug", ['checked' => '' ]) !!}
							@else
								{!! Form::radio('type', "Bug") !!}
							@endif
                      Bug
            </label>
            <label class="radio inline">
							@if(Input::old('type') == 'Question')
								{!! Form::radio('type', "Question", ['checked' => '' ]) !!}
							@else
								{!! Form::radio('type', "Question") !!}
							@endif
                      Question
            </label>
            <label class="radio inline">
							@if(Input::old('type') == 'Other')
								{!! Form::radio('type', "Other", ['checked' => '' ]) !!}
							@else
								{!! Form::radio('type', "Other") !!}
							@endif
                      Other
            </label>
          </div>
        	<div class="control-group">
          	<span class="span1 control-label">Urgency *</span>
            <div class="controls">
              <label class="radio inline">
								@if(Input::old('urgency') == 'S')
									{!! Form::radio('urgency', "S", ['checked' => '' ]) !!}
								@else
									{!! Form::radio('urgency', "S") !!}
								@endif
                      S:超緊急
              </label>
              <label class="radio inline">
								@if(Input::old('urgency') == 'A')
									{!! Form::radio('urgency', "A", ['checked' => '' ]) !!}
								@else
									{!! Form::radio('urgency', "A") !!}
								@endif
                      A:１日以内
              </label>
              <label class="radio inline">
								@if(Input::old('urgency') == 'B')
									{!! Form::radio('urgency', "B", ['checked' => '' ]) !!}
								@else
									{!! Form::radio('urgency', "B") !!}
								@endif
                      B:３日以内
              </label>
              <label class="radio inline">
								@if(Input::old('urgency') == 'C')
									{!! Form::radio('urgency', "C", ['checked' => '' ]) !!}
								@else
									{!! Form::radio('urgency', "C") !!}
								@endif
                      C:１週間以内
              </label>
              <label class="radio inline">
								@if(Input::old('urgency') == 'D')
									{!! Form::radio('urgency', "D", ['checked' => '' ]) !!}
								@else
									{!! Form::radio('urgency', "D") !!}
								@endif
                      D:可能なら
              </label>
            </div>
          </div>
          <div class="control-group">
						<div class="controls">
              <span class="span1 control-label">Type  *</span>
					    {!! Form::textarea('body', old('body'), ['class' => 'span8','rows' => '20', 'placeholder' => 'Detail *']) !!}
          	</div>
    			</div>
    			<div class="control-group">
            @if (isset($page) && $page == 'edit')
              {{-- */$path = $article->getImage1Path()/* --}}
              <div class="edit_article_image">
              @if (isset($path))
                <div class="edit_image">
                  <img src="{{ asset($path) }}">
                </div>
              @endif
            {{-- 新規登録フォーム --}}
            @else
              <div class="edit_article_image">
            @endif
                <div class="image_preview"><img class="js_form_image_preview1" src=""></div>   {{-- プレビュー画面 --}}
                <div class="edit_btn">
                  <div class="edit_btn_upload">
                    <span class="btn-primary"><i class="fa fa-upload">&nbsp;</i>ファイルを選択</span>
                    {!! Form::file('image1', ['class' => 'image_button js_btn_file', 'data-file-btn' => '1' ,'accept' => 'image/*' ]) !!}
                  </div>
                  <!-- /.edit_btn_upload -->
                  @if (isset($page) && $page == 'edit')
                  <div onclick="js_deleteimage({{$article->id }},1);" class="edit_btn_delete btn-danger js_btn_delete" data-delete-btn="1">
                  @else
                  <div onclick="" class="edit_btn_delete btn-danger js_btn_delete" data-delete-btn="1">
                  @endif
                      <span><i class="far fa-trash-alt">&nbsp;</i>この画像を削除</span>
                  </div>
                  <!-- /.edit_btn_delete -->
                </div>
              </div>
          </div>
          <div class="control-group">
            @if (isset($page) && $page == 'edit')
              {{-- */$path = $article->getImage2Path()/* --}}
              <div class="edit_article_image">
              @if (isset($path))
                <div class="edit_image">
                  <img src="{{ asset($path) }}">
                </div>
              @endif
            {{-- 新規登録フォーム --}}
            @else
              <div class="edit_article_image">
            @endif
                <div class="image_preview"><img class="js_form_image_preview2" src=""></div>   {{-- プレビュー画面 --}}
                <div class="edit_btn">
                  <div class="edit_btn_upload">
                    <span class="btn-primary"><i class="fa fa-upload">&nbsp;</i>ファイルを選択</span>
                    {!! Form::file('image2', ['class' => 'image_button js_btn_file', 'data-file-btn' => '2' ,'accept' => 'image/*' ]) !!}
                  </div>
                  <!-- /.edit_btn_upload -->
                  @if (isset($page) && $page == 'edit')
                  <div onclick="js_deleteimage({{$article->id }},2);" class="edit_btn_delete btn-danger js_btn_delete" data-delete-btn="2">
                  @else
                  <div onclick="" class="edit_btn_delete btn-danger js_btn_delete" data-delete-btn="2">
                  @endif
                      <span><i class="far fa-trash-alt">&nbsp;</i>この画像を削除</span>
                  </div>
                  <!-- /.edit_btn_delete -->
                </div>
              </div>
          </div>
          <div class="control-group">
            @if (isset($page) && $page == 'edit')
              {{-- */$path = $article->getImage3Path()/* --}}
              <div class="edit_article_image">
              @if (isset($path))
                <div class="edit_image">
                  <img src="{{ asset($path) }}">
                </div>
              @endif
            {{-- 新規登録フォーム --}}
            @else
              <div class="edit_article_image">
            @endif
                <div class="image_preview"><img class="js_form_image_preview3" src=""></div>   {{-- プレビュー画面 --}}
                <div class="edit_btn">
                  <div class="edit_btn_upload">
                    <span class="btn-primary"><i class="fa fa-upload">&nbsp;</i>ファイルを選択</span>
                    {!! Form::file('image3', ['class' => 'image_button js_btn_file', 'data-file-btn' => '3' ,'accept' => 'image/*' ]) !!}
                  </div>
                  <!-- /.edit_btn_upload -->
                  @if (isset($page) && $page == 'edit')
                  <div onclick="js_deleteimage({{$article->id }},3);" class="edit_btn_delete btn-danger js_btn_delete" data-delete-btn="3">
                  @else
                  <div onclick="" class="edit_btn_delete btn-danger js_btn_delete" data-delete-btn="3">
                  @endif
                      <span><i class="far fa-trash-alt">&nbsp;</i>この画像を削除</span>
                  </div>
                  <!-- /.edit_btn_delete -->
                </div>
              </div>
          </div>
			  	<div class="control-group">
          	<label class="span1 control-label">Summary *</label>
						<div class="controls">
					    {!! Form::text('title', old('title'), ['class' => 'span4','placeholder' => '概要を書いてください']) !!}
  					</div>
        	</div>
          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn">{{ $submitButtonTitle }}</button>
            </div>
          </div>
				</div>
      </div>
      <!-- module -->
