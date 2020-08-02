@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Import Kiddy
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        @if(session('done'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                                <strong>Выполнено!</strong> {{ session('done') }}
                            </div>
                        @endif
                        @if(session('alert'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                                <strong>Ошибка!</strong> {{ session('alert') }}
                            </div>
                        @endif
                        <h3>Update Brands</h3>
                        <form action="{{route('admin.import.kiddy.brand')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file" class="form-label">File (.csv)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$errors->has('file_brand') ? 'is-invalid':''}}" id="file" name="file_brand" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    @error('file_brand')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @include('components.inputs.submit', [
                                'function'  => 'Import',
                                'name'      => 'Brands',
                            ])
                        </form>
                        <hr>
                        <h3>Update Category</h3>
                        <form action="{{route('admin.import.kiddy.category')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file" class="form-label">File (.csv)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$errors->has('file_category') ? 'is-invalid':''}}" id="file" name="file_category" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    @error('file_category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @include('components.inputs.submit', [
                                'function'  => 'Import',
                                'name'      => 'Categories',
                            ])
                        </form>
                        <hr>
                        <h3>Update Product</h3>
                        <form action="{{route('admin.import.kiddy.product')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file" class="form-label">File (.csv)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$errors->has('file_product') ? 'is-invalid':''}}" id="file" name="file_product" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    @error('file_product')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @include('components.inputs.submit', [
                                'function'  => 'Import',
                                'name'      => 'Products',
                            ])
                        </form>
                        <hr>
                        <h3>Update Photos</h3>
                        <form action="{{route('admin.import.kiddy.photos')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file" class="form-label">File (.zip)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$errors->has('photos') ? 'is-invalid':''}}" id="file" name="photos" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    @error('photos')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @include('components.inputs.submit', [
                                'function'  => 'Import',
                                'name'      => 'Photos',
                            ])
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
