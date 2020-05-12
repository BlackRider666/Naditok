<select class="form-control" id="{{$name}}" name="{{$name}}" >
    <option value="" selected disabled hidden>Choose here</option>
    @foreach($items as $item)
        <option value="{{$item->id}}" {{$value === $item->id?'selected':''}}>{{$item->title}}</option>
    @endforeach
</select>
