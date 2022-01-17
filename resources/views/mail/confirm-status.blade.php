@component('mail::message')
#Confirmamos o seu cadastro

Olá {{$member->name}}, queremos parabeniza-lo pela inscrição nos email alertas,
apartir de agora irá receber emails alertas sobre o projecto que estará trabalhando,
os alertas serão enviado pelo criador dos mesmo.


Obrigado,<br>
{{ config('app.name') }}
@endcomponent
