@include('admin.template.header')
@include('admin.template.sidebar')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Message info</h3>
        <a href="{{URL::previous()}}" class="btn btn-dark">voltar</a>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <ol>
                                <li>se escolher hora, o envio de email será a cada hora</li>
                                <li>se escolher dia, o envio de email será a cada dia</li>
                                <li>se escolher semanal, o envio de email será a cada semana nos
                                    sabados</li>
                                <li>se escolher mensal, o envio de email será a cada mês no 
                                    primeiro dia
                                </li>
                                <li>se escolher anual, o envio de email será a cada ano no 
                                    primeiro dia do ano
                                </li>
                            </ol>
                        </div><!--body-->
                    </div><!--card-->
            </div>
        </section>
    </div>
</div>

@include('admin.template.footer')