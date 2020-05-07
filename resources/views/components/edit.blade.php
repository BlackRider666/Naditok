
@foreach($fields as $field)
    @if($model->getCasts()[$field] !== 'boolean')
        <div class="form-group">
            <label for="{{$field}}" class="form-label">{{str_replace('_', ' ', ucfirst($field))}}</label>
            @include('components.inputs.'.$model->getCasts()[$field],[
                'name'  =>  $field,
                'value' =>  $model->$field,
                ])
            @error($field)
            <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>
    @else
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                @include('components.inputs.'.$model->getCasts()[$field],[
                    'name'  =>  $field,
                    'value' =>  $model->$field,
                    ])
                <label class="custom-control-label" for="{{$field}}">{{str_replace('_', ' ', ucfirst($field))}}</label>
            </div>
            @error($field)
            <span class="invalid-feedback">
                        {{ $message }}
                    </span>
            @enderror
        </div>
    @endif
@endforeach
