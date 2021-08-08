@extends('templates.base')

@section('title', $title)

@section('content')
    <main class="mt-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <form class="needs-validation" novalidate action="{{route('auth.verifyLogin')}}" method="POST">
                        <a class="d-flex justify-content-center" href="">
                            <img class="mb-4" src="{{asset('assets/img/brand/bootstrap-logo.svg')}}" alt="" width="72"
                                 height="57">
                        </a>
                        @if($errors->has('loginFailed'))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('loginFailed')}}
                            </div>
                        @endif
                        <h1 class="h3 mb-3 fw-normal d-flex justify-content-center">Entrar</h1>
                        <div class="form-floating mt-1">
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="name@example.com"
                                   value="{{!empty(old('email')) ? old('email') : 'jessica12@example.com'  }}"
                                   aria-describedby="emailHelp" required>
                            <label for="email" class="form-label">Email</label>
                            <div id="emailHelp"
                                 class="form-text text-warning">@if($errors->has('email')) {{$errors->first('email')}} @endif</div>
                            <div class="valid-feedback">
                                Parece bom!
                            </div>
                            <div class="invalid-feedback">
                                Por favor, preencha com um e-mail valido.
                            </div>
                        </div>
                        <div class="form-floating mt-1">
                            <input type="password" class="form-control" name="password" id="password"
                                   value="{{!empty(old('password')) ? old('password') : 'password'  }}"
                                   minlength="8" aria-describedby="pwHelp" placeholder="*******"
                                   required>
                            <label for="password">Password</label>
                            <div id="pwHelp"
                                 class="form-text text-warning">@if($errors->has('password')) {{$errors->first('password')}} @endif</div>
                            <div class="valid-feedback">
                                Parece bom!
                            </div>
                            <div class="invalid-feedback">
                                Por favor, preencha com uma senha valida.
                            </div>
                        </div>

                        <div class="checkbox mb-3 mt-1">
                            <label>
                                <input type="checkbox" name="remember"> Lembrar-me
                            </label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
                        <p class="mt-5 mb-3 text-muted">&copy; 2017–{{date('Y')}}</p>
                        @CSRF
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
{{--    <script>--}}
{{--  --}}
{{--        (function () {--}}
{{--            'use strict'--}}
{{--            var forms = document.querySelectorAll('.needs-validation')--}}
{{--            Array.prototype.slice.call(forms).forEach(function (form) {--}}
{{--                form.addEventListener('submit', function (event) {--}}
{{--                    if (!form.checkValidity()) {--}}
{{--                        event.preventDefault()--}}
{{--                        event.stopPropagation()--}}
{{--                    }--}}
{{--                    form.classList.add('was-validated')--}}
{{--                }, false);--}}
{{--            });--}}
{{--        })();--}}
{{--    </script>--}}
@endsection
