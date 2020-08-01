@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Create {{ucfirst(substr($name, 0, -1))}}
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{route('admin.'.$name.'.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('components.create',[
                                'fields'    =>  $fields,
                                'options'   =>  $options,
                            ])
                            @include('components.inputs.submit', [
                                'function'  => 'Create',
                                'name'  => substr($name, 0, -1),
                            ])
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
