@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-6">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Add Discount
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{route('admin.products.add_discount')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product_id}}">
                            <div class="form-group">
                                <label for="product_id" class="form-label">Discount</label>
                                @include('components.inputs.select',[
                                    'items'    =>  $items,
                                    'name'     =>  'discount_id',
                                    'value'    =>   old('discount_id')
                                ])
                            </div>

                            @include('components.inputs.submit', [
                                'function'  => 'Add',
                                'name'  => 'discount',
                            ])
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
