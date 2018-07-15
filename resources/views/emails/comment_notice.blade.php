Posted New Comment!<br>
<br><br>
<p>Comment From : {{ $name }}</p>

<hr>
Id : {{ $article->id }} <br>
System :  {{ $article->system }} <br>
Type :  {{ $article->type }} <br>
Urgency :  {{ $article->urgency }} <br>
Posted by : {{ $article->user->name }}

<h4><a href={{ url('articles', $article->id)}}>{{ $article->id }} : {{ $article->title }}</a></h4>


<strong>New Comment is below.</strong>

<hr>

<div class="stream-text">
  {!! nl2br($comment->body) !!}
</div>