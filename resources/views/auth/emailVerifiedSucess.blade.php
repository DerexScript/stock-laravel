@extends('templates.base')

@section('title', 'Email Verificado Com Sucesso')

@section('content')
    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <h2>Email Verificado Com Sucesso!</h2>
                <div class="text-muted">Obrigado por verificar seu e-mail.</div>
                <a href="{{route('dashboard')}}" class="text-decoration-none text-success">Click aqui </a>para acessar a Dashboard.
            </div>
        </div>
    </div>
@endsection

