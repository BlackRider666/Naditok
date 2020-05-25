<table class="table">
    <tbody>
    @foreach($item as $key => $value)
        <tr>
            <th>{{$fields[$key]}}</th>
            @if($key === 'thumb_url')
               <td>
                   <img src="{{$value}}" alt="{{$key}}" class="img-thumbnail">
               </td>
            @else
            <td>{{$value}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
