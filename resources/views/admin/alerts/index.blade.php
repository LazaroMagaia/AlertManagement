@include('admin.template.header')
@include('admin.template.sidebar')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Alertas</h3> <a href="{{URL::previous()}}" class="btn btn-dark">voltar</a>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('alerts.create')}}" class="btn btn-dark">Novo Alerta</a>    
                        </div><!--cardTitle-->
                        <div class="card-body">
                            <section class="section">
                                <div class="row" id="table-borderless">
                                    <div class="col-12">
                                        <div class="card">
                                        <!-- table with no border -->
                                        <div class="table-responsive m-2">
                                            <table class="table table-borderless mb-0 text-center">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Data Inicio</th>
                                                        <th>Data Final</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alerts as $alert)
                                                    <tr>
                                                        <td class="text-bold-500">{{$alert->name}}</td>
                                                        <td>
                                                            {{ date('d/m/Y', strtotime($alert->date_start))}}
                                                        </td>
                                                        <td>
                                                            {{ date('d/m/Y', strtotime($alert->date_finish))}}
                                                        </td>
                                                        <td class="flex">
                                                            <a href="{{route("alerts.show",$alert->id)}}"
                                                            class="btn btn-info mx-1">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <a href="{{route("alerts.edit",$alert->id)}}" 
                                                                class="btn btn-warning mx-1">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                            <form action="{{route('alerts.delete',$alert->id)}}"
                                                             method="POST"> @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-danger mx-1">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                            </form>
                                                        </td>
                                                    </tr>   
                                                    @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div><!--card-body-->
                    </div><!--card-->
            </div><!--col-12-->
        </section>
    </div>
</div>

@include('admin.template.footer')