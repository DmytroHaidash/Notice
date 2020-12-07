<p> Добрый день, на ваше объявление {{$comment->advertisement->title}} пользователь {{$comment->user->name }} оставил комментарий.</p>


<p>{!! $comment->content !!}</p>


<p>{{ $comment->created_at }}</p>