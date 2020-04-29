<table class="table">
    <tbody>
    @foreach($item as $key => $value)
        <tr>
            <th>{{$fields[$key]}}</th>
            <td>{{$value}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
