@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Edit {{ucfirst(substr($name, 0, -1))}}
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{route('admin.'.$name.'.update',$model->getKey())}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            @include('components.edit',[
                                'model'     =>  $model,
                                'fields'    =>  $fields,
                                'options'   =>  $options,
                            ])
                            @include('components.inputs.submit', [
                                'function'  => 'Update',
                                'name'  => substr($name, 0, -1),
                            ])
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
