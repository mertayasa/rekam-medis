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
                        {!! Form::model($profile, ['route' => ['profile.update', $profile->id], 'method' => 'patch']) !!}
                        <div class="row">
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('nama', 'Nama', ['class' => 'mb-1']) !!}
                                {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'nama']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('nik', 'NIK', ['class' => 'mb-1']) !!}
                                {!! Form::text('nik', null, ['class' => 'form-control', 'id' => 'nik']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('nip', 'NIP', ['class' => 'mb-1']) !!}
                                {!! Form::text('nip', null, ['class' => 'form-control', 'id' => 'nip']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0 row">
                                <div class="col-6">
                                    {!! Form::label('tempat_lahir', 'Tempat Lahir', ['class' => 'mb-1']) !!}
                                    {!! Form::text('tempat_lahir', null, ['class' => 'form-control', 'id' => 'tempat_lahir']) !!}
                                </div>
                                <div class="col-6">
                                    {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class' => 'mb-1']) !!}
                                    {!! Form::date('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}
                                </div>
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('alamat', 'Alamat', ['class' => 'mb-1']) !!}
                                {!! Form::text('alamat', null, ['class' => 'form-control', 'id' => 'alamat']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('no_hp', 'No Handphone', ['class' => 'mb-1']) !!}
                                {!! Form::text('no_hp', null, ['class' => 'form-control', 'id' => 'no_hp']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('email', 'Email', ['class' => 'mb-1']) !!}
                                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                            </div>
                            <div class="col-12 mt-2  pb-3 pb-md-0">
                                {!! Form::label('jabatan', 'Jabatan', ['class' => 'mb-1']) !!}
                                {!! Form::text('jabatan', null, ['class' => 'form-control', 'id' => 'jabatan']) !!}
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-sm btn-warning">Update Biodata</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
