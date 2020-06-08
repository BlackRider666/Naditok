
@foreach($fields as $field)
    @if($model->getCasts()[$field] !== 'boolean')
        <div class="form-group">
            <label for="{{$field}}" class="form-label">{{str_replace('_', ' ', ucfirst($field))}}</label>
            @if($model->getCasts()[$field] === 'image')
                <?php $url = $field.'_url' ?>
                @include('components.inputs.'.$model->getCasts()[$field],[
                    'name'  =>  $field,
                    'value' =>  $model->$url,
                    ])
            @elseif($model->getCasts()[$field] === 'select')
                @include('components.inputs.'.$model->getCasts()[$field],[
                    'name'  =>  $field,
                    'value' =>  $model->$field,
                    'items' =>  $options[$field],
                    ])
            @else
                @include('components.inputs.'.$model->getCasts()[$field],[
                    'name'  =>  $field,
                    'value' =>  $model->$field,
                    ])
            @endif
            @error($field)
            <div class="invalid-feedback">
                    {{ $message }}
                </div>
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
            <div class="invalid-feedback">
                        {{ $message }}
                    </div>
            @enderror
        </div>
    @endif
@endforeach
