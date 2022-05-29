@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('profile.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit Biodata</div>
                    <div class="card-body">
                        @include('layouts.flash')
                        @include('layouts.error_message')
                        {!! Form::model($profile, ['route' => ['profile.update_password', $profile->id], 'method' => 'patch']) !!}
                        <div class="row">
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('nama', 'Nama', ['class' => 'mb-1']) !!}
                                {!! Form::text('nama', null, ['readonly' => true, 'class' => 'form-control', 'id' => 'nama']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('email', 'Email', ['class' => 'mb-1']) !!}
                                {!! Form::text('email', null, ['readonly' => true, 'class' => 'form-control', 'id' => 'email']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('old_password', 'Password Lama', ['class' => 'mb-1']) !!}
                                {!! Form::password('old_password', ['class' => 'form-control', 'id' => 'old_password']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('password', 'Password Baru', ['class' => 'mb-1']) !!}
                                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('password_confirmation', 'Konfirmasi Password Baru', ['class' => 'mb-1']) !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation']) !!}
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-sm btn-warning">Update Password</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
