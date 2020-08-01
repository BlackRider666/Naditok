@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
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
                    <form action="{{route('admin.'.$name.'.index')}}" method="GET" class="px-2 px-sm-3 pt-3">
                        <h3 class="mb-2">
                            {{$items->total()}} Results for {{ucfirst($name)}}
                        </h3>
                        <div class="input-group shadow-1 rounded">
                            <input type="text" name="search" class="form-control shadow-inset-2" id="filter-icon" aria-label="type 2 or more letters" placeholder="Search anything..." value="{{request()->get('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary hidden-sm-down waves-effect waves-themed" type="submit"><i class="fal fa-search mr-lg-2"></i><span class="hidden-md-down">Search</span></button>
                            </div>
                        </div>
                    </form>
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
