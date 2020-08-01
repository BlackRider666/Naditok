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
                            Items
                        </h2>
                    </div>
                    <div class="panel-content">
                        <div class="frame-wrap">
                            <table class="table m-0 table-hover">
                                <thead class="bg-fusion-50">
                                <tr>
                                    <th scope="col">#</th>
                                    @foreach($relation['items']['headers'] as $header)
                                        <th scope="col">{{$header}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($relation['items']['items'] as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        @foreach($relation['items']['headers'] as $key => $value)
                                            @if($key === 'color')
                                                <td><input type="color" value="{{$item->$key}}" disabled></td>
                                            @else
                                                <td>{{$item->$key}}</td>
                                            @endif
                                        @endforeach
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
