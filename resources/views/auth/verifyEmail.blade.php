@extends('templates.base')

@section('title', 'Verify Email')

@section('content')
    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <h2>Foi enviado um email contendo um link de ativação, para seu cadastro!</h2>
                <div class="text-muted">Verifique em sua caixa de <b>Spam</b> ou <b>lixo eletrônico</b></div>
                <form action="{{route('verification.send')}}" class="d-flex justify-content-center mt-4" method="POST">
                    <button type="submit" class="btn btn-outline-primary w-50 rounded-2">Reenviar email de verificação</button>
                    @CSRF
                </form>
            </div>
        </div>
    </div>
@endsection
