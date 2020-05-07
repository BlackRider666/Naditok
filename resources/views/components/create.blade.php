
@foreach($fields as $key => $value)
    @if($value !== 'boolean')
        <div class="form-group">
            <label for="{{$key}}" class="form-label">{{str_replace('_', ' ', ucfirst($key))}}</label>
            @include('components.inputs.'.$value,[
                'name'  =>  $key,
                'value' =>  null,
                ])
        </div>
        @error($key)
        <span class="invalid-feedback">
                    {{ $message }}
                </span>
        @enderror
    @else
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                @include('components.inputs.'.$value,[
                    'name'  =>  $key,
                    'value' =>  null,
                    ])
                <label class="custom-control-label" for="{{$key}}">{{str_replace('_', ' ', ucfirst($key))}}</label>
            </div>
            @error($key)
            <span class="invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>
    @endif
@endforeach
