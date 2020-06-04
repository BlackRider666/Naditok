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
                            <a class="btn btn-primary" href="{{route('admin.'.$relation['name'].'.create',$relation['product_group_id'])}}"><i class="fal fa-plus"></i> Create</a>
                        </div>
                    </div>
                    <div class="panel-content">
                        <div class="frame-wrap">
                            <table class="table m-0 table-hover">
                                <thead class="bg-fusion-50">
                                <tr>
                                    <th scope="col">#</th>
                                    @foreach($relation['headers'] as $header)
                                        <th scope="col">{{$header}}</th>
                                    @endforeach
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($relation['items'] as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        @foreach($relation['headers'] as $key => $value)
                                            @if($key === 'color')
                                                <td><input type="color" value="{{$item->$key}}" disabled></td>
                                            @else
                                                <td>{{$item->$key}}</td>
                                            @endif
                                        @endforeach
                                        <td class="row">
                                            <a class="col" href="{{route('admin.'.$relation['name'].'.show',$item->id)}}"><i class="fal fa-eye text-info"></i></a>
                                            <a class="col" href="{{route('admin.'.$relation['name'].'.edit', $item->id)}}"><i class="fal fa-edit text-warning"></i></a>
                                            <form class="col" action="{{route('admin.'.$relation['name'].'.destroy',$item->id)}}" method="POST">
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
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
