@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Pasien</div>
        <div class="card-body">
            @include('pasien.datatable')
        </div>
    </div>

    @include('includes.pasien.biodata_modal')
@endsection
