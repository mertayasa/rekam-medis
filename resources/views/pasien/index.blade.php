@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header mx-0 row justify-content-between align-items-center">
            <div class="col-6">
                <h6 class="py-1 m-0">Pasien</h6>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('pasien.create') }}" class="btn btn-sm btn-primary"> <b>Tambah +</b> </a>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.flash')
            <div class="row mb-3">
                <div class="col-12 col-md-4">
                    {!! Form::label('filterStatus', 'Filter Status', ['class' => 'mb-2']) !!}
                    {!! Form::select('status', ['Belum Keluar' => 'Belum Keluar', 'Sudah Keluar' => 'Sudah Keluar'], null, ['class' => 'form-control', 'onchange' => 'filterStatus(this.value)']) !!}
                </div>
            </div>
            <hr>
            @include('pasien.datatable')
        </div>
    </div>

    @include('includes.pasien.biodata_modal')
@endsection
