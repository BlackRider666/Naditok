@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-6">
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
                </div>
            </div>

        </div>
    </div>
@endsection
