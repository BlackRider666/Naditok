@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-6">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        {{ucfirst($name)}}
                    </h2>
                    @if(!$withoutToolbar)
                    <div class="panel-toolbar">
                        <a class="btn btn-primary" href="{{route('admin.'.$name.'.create')}}"><i class="fal fa-plus"></i> Create</a>
                    </div>
                    @endif
                </div>
                <div class="panel-container show">
                    @include('components.table',[
                            'headers'   =>  $headers,
                            'name'  => $name,
                            'items' => $items,
                            'withoutToolbar'    =>  $withoutToolbar,
                        ])
                </div>
            </div>

        </div>
    </div>
@endsection
