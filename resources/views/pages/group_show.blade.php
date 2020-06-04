@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-6">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        {{$header}}
                    </h2>
                </div>
                <div class="panel-container show">
                    @include('components.show',$data)
                    <hr>
                    <div class="panel-hdr">
                        <h2>
                            {{ucfirst($relation['name'])}}
                        </h2>
                        <div class="panel-toolbar">
                            <a class="btn btn-primary" href="{{route('admin.'.$relation['name'].'.create')}}"><i class="fal fa-plus"></i> Create</a>
                        </div>
                    </div>
                    @include('components.table',$relation)
                </div>
            </div>

        </div>
    </div>
@endsection
