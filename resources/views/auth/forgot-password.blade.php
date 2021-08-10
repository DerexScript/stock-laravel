@extends('templates.base')

@section('title', $title)

@section('content')
    <main class="mt-5" style="background-color: #ccc;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <form class="needs-validation" novalidate action="{{ route('password.email') }}" method="POST">
                        <a class="d-flex justify-content-center" href="">
                            <img class="mb-4" src="{{ asset('assets/img/brand/bootstrap-logo.svg') }}" alt="" width="72"
                                 height="57">
                        </a>
                        <h1 class="h3 mb-3 fw-normal d-flex justify-content-center">Solicitar nova senha.</h1>
                        <div class="form-floating mt-1">
                            <input type="text" name="email"
                                   class="form-control {{-- $errors->has('credential') ? 'is-invalid' : '' --}}"
                                   id="email"
                                   placeholder=""
                                   value="{{ !empty(old('credential')) ? old('credential') : '' }}"
                                   aria-describedby="emailHelp" required>
                            <label for="email" class="form-label">Email</label>
                            <div id="emailHelp" class="form-text text-white bg-warning border border-1 rounded-2">
                                @if ($errors->has('credential'))
                                    {{ $errors->first('credential') }} @endif
                            </div>
                            <div class="valid-feedback">
                                Parece bom!
                            </div>
                            <div class="invalid-feedback">
                                Por favor, preencha com um e-mail valido.
                            </div>
                        </div>

                        <button class="w-100 btn btn-secondary" type="submit">Solicitar nova Senha</button>
                        <p class="text-info">Não tem uma conta?
                            <a href="{{ route('auth.create') }}"
                               class="text-decoration-none text-primary">Registre-se</a>
                        </p>
                        <p class="mt-5 mb-3 text-muted">&copy; 2021–{{ date('Y') }}</p>
                        @CSRF
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    {{-- <script> --}}
    {{--  --}}
    {{-- (function () { --}}
    {{-- 'use strict' --}}
    {{-- var forms = document.querySelectorAll('.needs-validation') --}}
    {{-- Array.prototype.slice.call(forms).forEach(function (form) { --}}
    {{-- form.addEventListener('submit', function (event) { --}}
    {{-- if (!form.checkValidity()) { --}}
    {{-- event.preventDefault() --}}
    {{-- event.stopPropagation() --}}
    {{-- } --}}
    {{-- form.classList.add('was-validated') --}}
    {{-- }, false); --}}
    {{-- }); --}}
    {{-- })(); --}}
    {{-- </script> --}}
@endsection
