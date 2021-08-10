@component('mail::message')
# Introdução

O corpo da sua mensagem.

@component('mail::button', ['url' => ''])
    Botão de texto
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
