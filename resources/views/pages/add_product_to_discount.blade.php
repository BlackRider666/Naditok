@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Add Product
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="{{route('admin.discounts.add_product')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="discount_id" value="{{$discount_id}}">
                            <div class="form-group">
                                <label for="product_id" class="form-label">Product</label>
                                @include('components.inputs.select',[
                                    'items'    =>  $items,
                                    'name'     =>  'product_id',
                                    'value'    =>   old('product_id')
                                ])
                            </div>

                            @include('components.inputs.submit', [
                                'function'  => 'Add',
                                'name'  => 'product',
                            ])
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
