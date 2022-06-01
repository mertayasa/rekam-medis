@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Pengkajian</div>
        <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['route' => ['pasien.store'], 'method' => 'post', 'id' => 'createPasienForm']) !!}
            <div class="row">
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('keluahan_utama', 'Keluhan Utama', ['class' => 'mb-1']) !!}
                    {!! Form::textarea('keluahan_utama', null, ['class' => 'form-control', 'id' => 'keluahan_utama', 'style' => 'height: 100px']) !!}
                </div>

                <h5 class="mt-3">Data Subjektif</h5>
                <div class="col-12 pb-3 pb-md-0">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="isNyeri">
                        <label class="form-check-label" for="isNyeri">
                            Pasien Mengeluh Nyeri
                        </label>
                    </div>
                </div>

                <div class="col-12 pb-3 pb-md-0">
                    {!! Form::label('provoking', 'Provoking', ['class' => 'mb-1']) !!}
                    {!! Form::text('provoking', null, ['class' => 'form-control', 'id' => 'provoking']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('quality', 'Quality', ['class' => 'mb-1']) !!}
                    {!! Form::text('quality', null, ['class' => 'form-control', 'id' => 'quality']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('region', 'Region', ['class' => 'mb-1']) !!}
                    {!! Form::text('region', null, ['class' => 'form-control', 'id' => 'region']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('severity', 'Severity', ['class' => 'mb-1']) !!}
                    {!! Form::text('severity', null, ['class' => 'form-control', 'id' => 'severity']) !!}
                </div>
                <div class="col-12 mt-2  pb-3 pb-md-0">
                    {!! Form::label('time', 'Time', ['class' => 'mb-1']) !!}
                    {!! Form::text('time', null, ['class' => 'form-control', 'id' => 'time']) !!}
                </div>

                <div class="col-12 mt-2  pb-3 pb-md-0">
                    <h5 class="mt-3">Data Objektif</h5>
                </div>

                <div class="col-12 pb-3 pb-md-0">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <p class="mb-0">Tanda Mayor : <button class="btn btn-sm btn-primary">Edit</button> </p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="mb-0">Tanda Minor : <button class="btn btn-sm btn-primary">Edit</button> </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2  pb-3 pb-md-0">
                    <h5 class="mt-3">Kondisi Klinis</h5>
                </div>

                <div class="col-12 pb-3 pb-md-0">
                    <p class="mb-0">Kondisi : <button class="btn btn-sm btn-primary">Edit</button> </p>
                </div>
                
            </div>
        </div>
    </div>
@endsection
