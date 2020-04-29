@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$user->fullname}}
                    </div>
                    <div class="card-body">
                        @include('components.show',[
                            'items' => $user->only(['fullname','email']),
                            'fields' => [
                                'first_name'    =>  'First Name',
                                'last_name'     =>  'Last Name',
                                'email'         =>  'Email',
                                'fullname'      =>  'Full Name'
                            ]
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
