Posted New Report!<br>
<br><br>
From : {{ $name }}

<hr>
System :  {{ $article->system }} <br>
Type :  {{ $article->type }} <br>
Urgency :  {{ $article->urgency }} <br>

<h4><a href={{ url('articles', $article->id)}}>{{ $article->title }}</a></h4>


<div class="stream-text">
  {!! nl2br($article->body) !!}
</div>