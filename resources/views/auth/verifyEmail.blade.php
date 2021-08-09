<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} - Verify Email</title>
</head>
<body>
<h1>Foi enviado um email contendo um link de ativação do seu cadastro!</h1>
<form action="{{route('verification.send')}}" id="form1" method="POST" style="display: none;">@CSRF</form>
<button onclick="document.querySelector('#form1').submit()">Reenviar email de verificação</button>
</body>
</html>
