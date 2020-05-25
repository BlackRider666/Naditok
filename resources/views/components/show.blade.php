<table class="table">
    <tbody>
    @foreach($item as $key => $value)
        <tr>
            <th>{{$fields[$key]}}</th>
            @if($key === 'thumb_url')
                <img src="{{$value}}" alt="{{$key}}" class="img-thumbnail">
            @endif
            <td>{{$value}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
