<div class="panel-content">
    <div class="frame-wrap">
        <table class="table m-0 table-hover">
            <thead class="bg-fusion-50">
            <tr>
                <th scope="col">#</th>
                @foreach($headers as $header)
                    <th scope="col">{{$header}}</th>
                @endforeach
                @if(!$withoutShow||!$withoutToolbar)
                    <th scope="col">Options</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    @foreach($headers as $key => $value)
                        @if(array_key_exists($key,$options))
                            <?php $option = $options[$key]->where('id',$item->$key)->first()->toArray()?>
                            <td>{{array_key_exists('title_ru',$option)?$option['title_ru']:$option['title']}}</td>
                        @else
                            @if($key === 'color')
                                <td><input type="color" value="{{$item->$key}}" disabled></td>
                            @else
                                <td>{{$item->$key}}</td>
                            @endif
                        @endif
                    @endforeach
                    <td class="row">
                        @if(!$withoutShow)
                            <a class="col" href="{{route('admin.'.$name.'.show',$item->id)}}"><i class="fal fa-eye text-info"></i></a>
                        @endif
                        @if(!$withoutToolbar)
                        <a class="col" href="{{route('admin.'.$name.'.edit', $item->id)}}"><i class="fal fa-edit text-warning"></i></a>
                        <form class="col" action="{{route('admin.'.$name.'.destroy',$item->id)}}" method="POST">
                            {{method_field('DELETE')}}
                            @csrf
                            <button type="submit" class="border-0 bg-white">
                                <i class="fal fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {{ $items->appends(request()->query())->links() }}
        </div>
    </div>
</div>
