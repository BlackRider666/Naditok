@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-6">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        {{ucfirst($name)}}
                    </h2>
                    <div class="panel-toolbar">
                        <a class="btn btn-primary" href="{{route('admin.'.$name.'.create')}}"><i class="fal fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="panel-container show">
                    @include('components.table',[
                            'headers'   =>  $headers,
                            'name'  => $name,
                            'items' => $items,
                        ])
                </div>
            </div>

        </div>
    </div>
@endsection
