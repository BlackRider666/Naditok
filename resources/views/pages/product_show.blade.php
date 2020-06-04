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
                            Photos
                        </h2>
                        <div class="panel-toolbar">
                            <a class="btn btn-primary" href="{{route('admin.'.$relation['photos']['name'].'.create',$relation['product_id'])}}"><i class="fal fa-plus"></i> Add photo</a>
                        </div>
                    </div>
                    @include('components.grid',$relation['photos'])

                    <div class="panel-hdr">
                        <h2>
                            Sizes
                        </h2>
                        <div class="panel-toolbar">
                            <a class="btn btn-primary" href="{{route('admin.'.$relation['sizes']['name'].'.create',$relation['product_id'])}}"><i class="fal fa-plus"></i> Add size</a>
                        </div>
                    </div>
                    @include('components.table',$relation['sizes'])
                </div>
            </div>

        </div>
    </div>
@endsection
