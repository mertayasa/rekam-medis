@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Pengkajian</div>
    <div class="card-body">
        @include('layouts.flash')
        @include('layouts.error_message')
    </div>
</div>
@endsection