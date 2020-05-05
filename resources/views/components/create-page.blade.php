@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create {{ucfirst(substr($name, 0, -1))}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.'.$name.'.store')}}" method="POST">
                            @csrf
                            @include('components.create',$fields)
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
