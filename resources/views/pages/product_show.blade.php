@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
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
                    <div class="panel-hdr">
                        <h2>
                            Discount
                        </h2>
                        <div class="panel-toolbar">
                            <a class="btn btn-primary" href="{{route('admin.products.add_discount_to_product',$relation['product_id'])}}"><i class="fal fa-plus"></i> Add discount</a>
                        </div>
                    </div>
                    <div class="panel-content">
                        <div class="frame-wrap">
                            <table class="table m-0 table-hover">
                                <thead class="bg-fusion-50">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Start</th>
                                    <th scope="col">Finish</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($relation['discount'] !== null)
                                    <tr>
                                        <td>{{$relation['discount']['title']}}</td>
                                        <td>{{$relation['discount']['size']}}</td>
                                        <td>{{$relation['discount']['type']===0?'%':'грн.'}}</td>
                                        <td>{{$relation['discount']['start']}}</td>
                                        <td>{{$relation['discount']['finish']}}</td>
                                        <td class="row">
                                            <form class="col" action="{{route('admin.products.remove-discount',$relation['product_id'])}}" method="POST">
                                                {{method_field('DELETE')}}
                                                @csrf
                                                <button type="submit" class="border-0 bg-white">
                                                    <i class="fal fa-trash-alt text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
