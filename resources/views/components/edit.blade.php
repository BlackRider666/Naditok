
@foreach($fields as $field)
    @if($model->getCasts()[$field] !== 'boolean')
        <div class="form-group">
            <label for="{{$field}}">{{str_replace('_', ' ', ucfirst($field))}}</label>
            @include('components.inputs.'.$model->getCasts()[$field],[
                'name'  =>  $field,
                'value' =>  $model->$field,
                ])
        </div>
    @else
        <div class="form-group form-check">
            @include('components.inputs.'.$model->getCasts()[$field],[
                'name'  =>  $field,
                'value' =>  $model->$field,
                ])
            <label class="form-check-label" for="{{$field}}">{{str_replace('_', ' ', ucfirst($field))}}</label>
        </div>
    @endif
@endforeach
