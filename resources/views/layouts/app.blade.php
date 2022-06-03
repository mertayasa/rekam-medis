<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Informasi Rekam Medis</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .form-control{
            background-color: white;
        }
        .btn{
            font-weight: 600 !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href=" {{ asset('plugin/datatable/datatables.min.css') }}">
    <link href="{{ asset('plugin/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet">   
    <link href="{{ asset('plugin/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">   
    @stack('styles')
</head>
<body>
    <div id="app" x-data="{}">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistem Informasi Rekam Medis
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav me-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li>
                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nama }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        Biodata
                                    </a>

                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <b> {{ __('Logout') }} </b>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    
                </div>
            </div>
        </nav>

        <main class="py-4">
            {{-- <div class="container">
                <div class="row justify-content-center">
                    <div class="col-9">
                        @include('layouts.flash')
                        @include('layouts.error_message')
                    </div>
                </div>
            </div> --}}
            <div class="container">
                <div class="row justify-content-center">
                    @auth
                        @include('layouts.sidebar')
                    @endauth
                    <div class="col-md-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('plugin/jquery/dist/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('plugin/popper/popper.min.js') }}"></script>
    <script src="{{ asset('plugin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugin/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('plugin/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script defer src="{{ asset('plugin/alpinejs/alpine.min.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script>
        const baseUrl = "{{ url('/') }}"

        function deleteModel(deleteUrl, tableId, additionalMethod = null) {
            Swal.fire({
                title: "Warning",
                text: "Yakin menghapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#169b6b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        dataType: "Json",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        method: "delete",
                        success: function(data) {
                            if (data.code == 1) {
                                Swal.fire(
                                    'Berhasil',
                                    data.message,
                                    'success'
                                )

                                if (additionalMethod != null) {
                                    additionalMethod.apply(this, [data.args])
                                }

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data.message
                                })
                            }

                            $('#' + tableId).DataTable().ajax.reload();
                        }
                    })
                }
            })
        }

        function showToast(code, text) {
            if (code == 1) {
                toastr.success(text)
            }

            if (code == 0) {
                toastr.error(text)
            }
        }

        function showSwalAlert(type, message){
            const title = type == 'success' ? 'Success' : (type == 'error' ? 'Oppps..' : 'Warning')
            return Swal.fire({
                title: title,
                text: message,
                icon: type,
            })
        }

        function numberFormat(num){
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
        }

        function clearErrorMessage() {
            const invalidFeedback = document.getElementsByClassName('invalid-feedback')

            for (let invalid = 0; invalid < invalidFeedback.length; invalid++) {
                const element = invalidFeedback[invalid]
                const targetField = element.getAttribute('error-name')
                const inputElement = document.querySelectorAll(`[name="${targetField}"]`)
                element.innerHTML = ''
                for (let inputEl = 0; inputEl < inputElement.length; inputEl++) {
                    if (inputElement[inputEl] != undefined) {
                        inputElement[inputEl].classList.remove('is-invalid')
                    }
                }

            }
        }

        function showValidationMessage(errors) {
            const divValidation = document.getElementById('divValidation')
            const ulValidation = document.getElementById('ulValidation')

            divValidation.classList.remove('d-none')

            Object.keys(errors).forEach(function(key) {
                // let errorSpan = document.querySelectorAll(`[error-name="${key}"]`)
                // let errorInput = document.querySelectorAll(`[name="${key}"]`)

                // for (let eInput = 0; eInput < errorInput.length; eInput++) {
                //     const selectedErrorInput = errorInput[eInput];
                //     selectedErrorInput.classList.add('is-invalid')
                // }

                // for (let eSpan = 0; eSpan < errorSpan.length; eSpan++) {
                //     const selectedErrorSpan = errorSpan[eSpan];
                //     if (selectedErrorSpan != undefined) {
                //         selectedErrorSpan.innerHTML = errors[key][0]
                //     } else {
                //         showToast(0, 'Terjadi kesalahan pada sistem')
                //     }
                // }
            })
        }

        function isNull(value) {
            if (value == '' || value == undefined || value == null) {
                return true
            }

            return false;
        }

        function showPassword(id) {
            var passWordEl = document.getElementById(id);
            if (passWordEl.type === "password") {
                passWordEl.type = "text";
            } else {
                passWordEl.type = "password";
            }
        }

        const numberOnlyInput = document.getElementsByClassName('number-only')
        for (let index = 0; index < numberOnlyInput.length; index++) {
            const numberOnly = numberOnlyInput[index];
            numberOnly.addEventListener('input', function(element) {
                element.target.value = element.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')
            })
        }

        function clearFlash(){
            Alpine.store('global').isFlash = false
            Alpine.store('global').flashData = []
        }

        document.addEventListener('alpine:init', () => {
            Alpine.store('global', {
                isFlash: false,
                flashClass: 'error',
                flashData: [],
                showFlash: function(message, flashType) {
                    this.isFlash = true
                    switch(flashType) {
                        case 'success':
                            this.flashClass = 'bg-success'
                            break
                        case 'error':
                            this.flashClass = 'bg-danger'
                            break
                        case 'warning':
                            this.flashClass = 'bg-warning'
                            break
                        case 'info':
                            this.flashClass = 'bg-info'
                            break
                        default:
                            this.flashClass = 'bg-danger'
                            break
                    }
                    
                    if(typeof message === 'object') {
                        this.flashData = message
                    }else{
                        this.flashData.push(message)
                    }
                },
            })
        })
    </script>
    @stack('scripts')
</body>
</html>
