@include('admin.template.header')
@include('admin.template.sidebar')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Editar Membro</h3> <a href="{{URL::previous()}}" class="btn btn-dark">voltar</a>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8 m-center">
                   <div class="card">
                        <div class="card-header">
                            @include('admin.AlertMessages.alert')
                            <h4>Novo alerta</h4>
                        </div><!---->
                        <div class="card-body">
                            <form action="{{route('alert.member.update',$member->id)}}" 
                            method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-4">
                                    <label>Nome</label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" id="name" class="form-control"
                                    name="name" value="{{$member->name}}">
                                </div>
                                <div class="col-md-4">
                                    <label>email</label>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" id="email" class="form-control"
                                    name="email" value="{{$member->email}}">

                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit"
                                        class="btn btn-primary me-1 mb-1 my-1">Submit</button>
                                </div>
                            </form><!--form-->
                        </div><!--card-body-->
                   </div><!--card-->
                </div><!--col-->
            </div><!--row-->
        </section>
    </div>
</div>

@include('admin.template.footer')