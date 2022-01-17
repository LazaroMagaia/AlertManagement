@include('admin.template.header')
@include('admin.template.sidebar')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Membros de equipe do {{$message->subject}}</h3>
        <a href="{{URL::previous()}}" class="btn btn-dark">voltar</a>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                 <div class="card">
                    <div class="card-header">
                        gerencie membros que vao receber os email alertas a partir desse painel
                        <br>
                        <a href="{{route('alert.member.create',$message->id)}}"
                         class="btn btn-primary"><i class="bi bi-person-plus"></i></a>
                    </div><!--header-->
                    <div class="card-body">
                        <div class="table-responsive m-2">
                            <table class="table table-borderless mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>email</th>
                                        <th>Situacao</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                    <tr>
                                        <td class="text-bold-500">{{$member->name}}</td>
                                        <td>
                                            {{ $member->email }}
                                        </td>
                                        <td>
                                            @if ($member->status == 1)
                                                activo
                                            @else
                                                Inativo
                                            @endif
                                        </td>
                                        <td class="flex">
                                            <a href="{{route("alert.member.edit",$member->id)}}" 
                                                class="btn btn-warning mx-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{route('alert.member.delete',$member->id)}}"
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
                    </div><!--card-body-->
                 </div><!--card-->
            </div>
        </section>
    </div>
</div>

@include('admin.template.footer')