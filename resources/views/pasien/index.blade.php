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
            @include('pasien.datatable')
        </div>
    </div>

    @include('includes.pasien.biodata_modal')
@endsection
