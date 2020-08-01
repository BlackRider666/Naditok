@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        {{$header}}
                    </h2>
                    <div class="panel-toolbar">
                        <a class="btn btn-primary" href="{{route('admin.discounts.get_add_product',$data['item_id'])}}"><i class="fal fa-plus"></i> Add Product</a>
                    </div>
                </div>
                <div class="panel-container show">
                    <table class="table">
                        <tbody>
                        @foreach($data['item'] as $key => $value)
                            <tr>
                                <th>{{$data['fields'][$key]}}</th>
                                @if($key === 'thumb_url')
                                    <td>
                                        <img src="{{$value}}" alt="{{$key}}" class="img-thumbnail col-6">
                                    </td>
                                @elseif($key === 'type')
                                    <td>
                                    {{$data['fields'][$key] == 0 ? '%' : ' грн.'}}
                                    </td>
                                @else
                                    <td>{{array_key_exists($key,$relation)?$relation[$key]:$value}}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="panel-hdr">
                        <h2>
                            Products
                        </h2>
                    </div>
                    <div class="panel-content">
                        <div class="frame-wrap">
                            <table class="table m-0 table-hover">
                                <thead class="bg-fusion-50">
                                <tr>
                                    <th scope="col">#</th>
                                    @foreach($relation['products']['headers'] as $header)
                                        <th scope="col">{{$header}}</th>
                                    @endforeach
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($relation['products']['items'] as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        @foreach($relation['products']['headers'] as $key => $value)
                                            @if($key === 'color')
                                                <td><input type="color" value="{{$item->$key}}" disabled></td>
                                            @else
                                                <td>{{$item->$key}}</td>
                                            @endif
                                        @endforeach
                                        <td class="row">
                                            <form class="col" action="{{route('admin.discounts.remove-product',$item->id)}}" method="POST">
                                                {{method_field('DELETE')}}
                                                @csrf
                                                <button type="submit" class="border-0 bg-white">
                                                    <i class="fal fa-trash-alt text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $relation['products']['items']->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
