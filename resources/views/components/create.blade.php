
@foreach($fields as $key => $value)
    @if($value !== 'boolean')
        <div class="form-group">
            <label for="{{$key}}">{{str_replace('_', ' ', ucfirst($key))}}</label>
            @include('components.inputs.'.$value,[
                'name'  =>  $key,
                'value' =>  null,
                ])
        </div>
    @else
        <div class="form-group form-check">
            @include('components.inputs.'.$value,[
                'name'  =>  $key,
                'value' =>  null,
                ])
            <label class="form-check-label" for="{{$key}}">{{str_replace('_', ' ', ucfirst($key))}}</label>
        </div>
    @endif
@endforeach
