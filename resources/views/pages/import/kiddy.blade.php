@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-6">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Import Kiddy
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <h3>Update Brands</h3>
                        <form action="{{route('admin.import.kiddy.brand')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file" class="form-label">File (.csv)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$errors->has('file') ? 'is-invalid':''}}" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            @include('components.inputs.submit', [
                                'function'  => 'Import',
                                'name'      => 'Kiddy',
                            ])
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
