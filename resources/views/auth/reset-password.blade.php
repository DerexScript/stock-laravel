@extends('templates.base')

@section('title', $title)

@section('content')
    <pre>
        {{$errors}}
    </pre>
    <main class="mt-5" style="background-color: #ccc;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <form method="POST" class="needs-validation" novalidate action="{{ route('password.update') }}">
                        <a class="d-flex justify-content-center" href="">
                            <img class="mb-4" src="{{ asset('assets/img/brand/bootstrap-logo.svg') }}" alt="" width="72"
                                 height="57">
                        </a>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <h1 class="h3 mb-3 fw-normal d-flex justify-content-center">Mudar Senha.</h1>
                        <div class="form-floating mt-1">
                            <input type="email" name="email"
                                   class="form-control-plaintext {{-- $errors->has('email') ? 'is-invalid' : '' --}}"
                                   id="email"
                                   placeholder="Email"
                                   value="{{ $email }}"
                                   required>
                            <label for="email" class="form-label"></label>
                        </div>

                        <div class="form-floating mt-1">
                            <input type="password" name="password"
                                   class="form-control {{-- $errors->has('password') ? 'is-invalid' : '' --}}"
                                   id="password"
                                   placeholder=""
                                   value="{{ !empty(old('password')) ? old('password') : '' }}"
                                   aria-describedby="passwordHelp" required>
                            <label for="password" class="form-label">Password</label>
                            <div id="passwordHelp" class="form-text text-white bg-warning border border-1 rounded-2">
                                @if ($errors->has('password'))
                                    {{ $errors->first('password') }} @endif
                            </div>
                            <div class="valid-feedback">
                                Parece bom!
                            </div>
                            <div class="invalid-feedback">
                                Por favor, preencha com uma senha valida.
                            </div>
                        </div>

                        <div class="form-floating mt-1">
                            <input type="password" name="password_confirmation"
                                   class="form-control {{-- $errors->has('password_confirmation') ? 'is-invalid' : '' --}}"
                                   id="password_confirmation"
                                   placeholder=""
                                   value="{{ !empty(old('password_confirmation')) ? old('password_confirmation') : '' }}"
                                   aria-describedby="password_confirmationHelp" required>
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <div id="password_confirmationHelp"
                                 class="form-text text-white bg-warning border border-1 rounded-2">
                                @if ($errors->has('password_confirmation'))
                                    {{ $errors->first('password_confirmation') }} @endif
                            </div>
                            <div class="valid-feedback">
                                Parece bom!
                            </div>
                            <div class="invalid-feedback">
                                Por favor, preencha com uma senha valida.
                            </div>
                        </div>
                        <input type="hidden" name="token" id="token" value="{{$token}}">
                        @CSRF
                        <button class="w-100 btn btn-secondary" type="submit">Salvar nova senha</button>
                        <p class="text-info">Não tem uma conta?
                            <a href="{{ route('auth.create') }}"
                               class="text-decoration-none text-primary">Registre-se</a>
                        </p>
                        <p class="mt-5 mb-3 text-muted">&copy; 2021–{{ date('Y') }}</p>
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
