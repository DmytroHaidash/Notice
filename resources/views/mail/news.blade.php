<h3>Добрый день, на сайте появились новые объявления:</h3>
@if($advertisements)
    <table>
        @foreach($advertisements as $advertisement)
            <tr>
                <td><img src="{{$advertisement->image}}" width="50"></td>
                <td><a href="{{url('/advertisement/'. $advertisement->id)}}">{{$advertisement->title}}</a></td>
            </tr>
        @endforeach
    </table>
@endif
<p><a href="{{url('/')}}">Все объявления</a></p>

<p><a href="{{$unsubscribe_link}}">Отписаться от рассылки</a></p>