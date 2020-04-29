<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        @foreach($headers as $header)
            <th scope="col">{{$header}}</th>
        @endforeach
        <th scope="col">Options</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
    <tr>
        <th scope="row">{{$item->id}}</th>
        @foreach($headers as $key => $value)
            <td>{{$item->$key}}</td>
        @endforeach
        <td class="row border-0">
            <a class="col" href="{{route('admin.'.$name.'.show',$item->id)}}"><i class="far fa-eye text-info"></i></a>
            <a class="col" href="{{route('admin.'.$name.'.edit', $item->id)}}"><i class="far fa-edit text-warning"></i></a>
            <form class="col" action="{{route('admin.'.$name.'.delete',$item->id)}}" method="POST">
                {{method_field('DELETE')}}
                @csrf
                <button type="submit" class="border-0 bg-white">
                    <i class="far fa-trash-alt text-danger"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
