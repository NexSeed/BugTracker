Posted New Comment!<br>
<br><br>
From : {{ $name }}

<hr>
System :  {{ $article->system }} <br>
Type :  {{ $article->type }} <br>
Urgency :  {{ $article->urgency }} <br>
Posted by : {{ $article->user->name }}

<h4><a href={{ url('articles', $article->id)}}>{{ $article->title }}</a></h4>


New Comment is below.

<hr>

<div class="stream-text">
  {!! nl2br($comment->body) !!}
</div>