@extends('templates.base')

@section('title', 'Confirme seu email')

@section('content')
    <div class="container mt-4 mb-4">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <h1>Verifique seu endereço de e-mail</h1><br>
                <h4>Foi enviado um email contendo um link de ativação, para seu cadastro!</h4>
                <div class="text-muted">Verifique em sua caixa de <b>Spam</b> ou <b>lixo eletrônico</b></div>
                <form action="{{route('verification.send')}}" class="d-flex justify-content-center mt-4" method="POST">
                    <button type="submit" class="btn btn-outline-primary w-50 rounded-2">Reenviar email de verificação</button>
                    @CSRF
                </form>
            </div>
        </div>
    </div>
@endsection
