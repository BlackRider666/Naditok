@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <span class="col"  style="padding: 0.5em 0.7em">{{ucfirst($name)}}</span>
                            <div class="col row justify-content-end">
                                <a class="btn btn-primary" href="{{route('admin.'.$name.'.create')}}"><i class="fas fa-plus"></i> Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('components.table',[
                            'headers'   =>  $headers,
                            'name'  => $name,
                            'items' => $items,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
