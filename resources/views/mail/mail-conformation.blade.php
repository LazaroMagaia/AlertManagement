@component('mail::message')
# Introduction

Olá esse é o email para a sua confirmação nos envios de alerta.<br>
olá {{$member->name}} <br>
Mensagem: {{$message->subject}} <br>
Quem Envio: {{$user->name}}

<a href="http://127.0.0.1:8000/mailConfirmation/{{$member->email}}/{{$member->token}}" 
    class="btn btn-primary">Quero receber</a>
Obrigado,<br>
{{$user->name}}
@endcomponent
