@include('admin.template.header')
@include('admin.template.sidebar')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>{{$alert->name}}</h3> <a href="{{URL::previous()}}" class="btn btn-dark">voltar</a>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                   <div class="card">
                        <div class="card-header">
                          <h4>visualizando o {{$alert->name}}</h4>  
                        </div><!--card-header-->
                        <div class="card-body">
                            Nome do projecto: <strong>{{$alert->name}}</strong><br>
                            Data de inicial dos alertas: <strong>{{$alert->date_start}}</strong><br>
                            Data de final dos alertas: <strong>{{$alert->date_finish}}</strong><br>
                        </div><!--body-->
                        <div class="card-footer">
                            @if (isset($messageAlert))
                                <div class="">
                                    <a href="{{route('alert.message.index',[$messageAlert->id])}}" 
                                    class="btn btn-primary">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                    <a href="{{route('alert.member.index',$messageAlert->id)}}" 
                                        class="btn btn-info">
                                        <i class="bi bi-people"></i>
                                    </a>
                                    <a href="" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            @else
                            Para melhorar o seu projecto adicione uma mensagem de alerta e adicione
                            pessoas para receberem os alertas sobre o projecto, não te esqueças
                            elas precisao aceitar para poderem receber os emails alerta<br>
                            <div class="my-2">
                                <a href="{{route('alert.message.create',$alert->id)}}" 
                                    class="btn btn-info">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>
                            @endif
                        </div><!--footer-->
                   </div><!--card-->
            </div>
        </section>
    </div>
</div>

@include('admin.template.footer')