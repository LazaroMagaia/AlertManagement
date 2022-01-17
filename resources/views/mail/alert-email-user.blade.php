@component('mail::message')

Ola {{$email->name}} esse é o alerta do projecto {{$alert->name}}.<br>
{{$message->message}}

Obrigado,<br>
{{ $user->name }}
@endcomponent
