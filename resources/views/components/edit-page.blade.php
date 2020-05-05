@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit {{ucfirst(substr($name, 0, -1))}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.'.$name.'.update',$model->getKey())}}" method="POST">
                            @csrf
                            {{method_field('PUT')}}
                            @include('components.edit',[
                                'model'     =>  $model,
                                'fields'    =>  $fields,
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
