@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong> {{ $message }}</strong>
    </div>
    <script>
        window.localStorage.clear();
    </script>
@endif

@if ($message = Session::get('error') )
    <div class="alert alert-danger alert-block">

        <strong> {{$message}}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
    <strong> {{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
    <strong> {{ $message }}</strong>
    </div>
@endif

@push('scripts')
    <script>
        $(".alert-block").fadeTo(5000, 500).slideUp(500);
    </script>
@endpush