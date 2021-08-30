@extends('templates.base')

@section('title', $title)

@section('content')
    <div class="container mt-5 mb-5 p-1" style="background-color: #ccc;">
        <div class="row">
            <div class="col-md-12">
                <form class="row g-3 p-2" action="{{route('auth.store')}}" method="POST">
                    <a class="d-flex justify-content-center" href="">
                        <img class="mb-4" src="{{asset('assets/img/brand/estoque.png')}}" alt="" width="72"
                             height="57">
                    </a>
                    <h1 class="h3 mb-3 fw-normal d-flex justify-content-center">Registrar</h1>

                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome</label>
                        <input value="Derex" type="text" name="name" class="form-control" id="name"
                               aria-describedby="nameHelp">
                        <div id="nameHelp"
                             class="form-text text-info">@if($errors->has('name')) {{$errors->first('name')}} @endif</div>
                    </div>

                    <div class="col-md-6">
                        <label for="surname" class="form-label">Sobrenome</label>
                        <input type="text" value="Script" name="surname" class="form-control" id="surname"
                               aria-describedby="surnameHelp">
                        <div id="surnameHelp"
                             class="form-text text-info">@if($errors->has('surname')) {{$errors->first('surname')}} @endif</div>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="Derex@outlook.com.br" name="email" class="form-control" id="email"
                               aria-describedby="emailHelp">
                        <div id="emailHelp"
                             class="form-text text-info">@if($errors->has('email')) {{$errors->first('email')}} @endif</div>
                    </div>

                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" value="Derex" name="username" maxlength="15" class="form-control"
                               id="username" aria-describedby="usernameHelp">
                        <div id="usernameHelp"
                             class="form-text text-info">@if($errors->has('username')) {{$errors->first('username')}} @endif</div>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" value="password" name="password" class="form-control" id="password"
                               aria-describedby="passwordHelp">
                        <div id="passwordHelp"
                             class="form-text text-info">@if($errors->has('password')) {{$errors->first('password')}} @endif</div>
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" value="password" name="password_confirmation" class="form-control"
                               id="password_confirmation" aria-describedby="password_confirmationHelp">
                        <div id="password_confirmationHelp"
                             class="form-text text-info">@if($errors->has('password_confirmation')) {{$errors->first('password_confirmation')}} @endif</div>
                    </div>


                    <div class="col-md-12">
                        <label for="role" class="form-label">Função Do Usuario</label>
                        <select class="form-select" id="role" name="role_id" required>
                            @foreach($roles as $key => $role)
                                <option
                                    {{($loop->first) ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Parece bom!
                        </div>
                        <div class="invalid-feedback">
                            Selecione uma opção válida.
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms"
                                   aria-describedby="termsHelp">
                            <label class="form-check-label" for="terms">
                                Aceito com os <a href="#">termos</a>
                            </label>
                            <div id="termsHelp"
                                 class="form-text text-info">@if($errors->has('terms')) {{$errors->first('terms')}} @endif</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success w-100">Cadastrar</button>
                    </div>
                    @CSRF

                </form>
            </div>
        </div>
    </div>

@endsection
