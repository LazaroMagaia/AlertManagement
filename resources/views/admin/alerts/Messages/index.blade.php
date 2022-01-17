@include('admin.template.header')
@include('admin.template.sidebar')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Messagem de alerta para {{ $message->subject }}</h3>
        <a href="{{ URL::previous() }}" class="btn btn-dark">voltar</a>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <div class="flex-start">
                                <h4>Configure o horario para o envio</h4>
                                <a href="{{ route('alert.message.info') }}">
                                    <i class="bi bi-info-circle"></i></a>
                            </div>
                            <form action="{{ route('alert.message.cronstore', $message->id) }}" method='POST'>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="choices form-select" name="time">
                                                @foreach ($crons as $cron)
                                                    <option value="{{ $cron->type }}" 
                                                        {{(!$cronc) ? '' :
                                                        ($cron->type == $cronc->time) ? 
                                                        'selected' :''}}>
                                                        {{ $cron->type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--col-->
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">
                                            Escolher
                                        </button>
                                    </div>
                                    <!--col-->
                                </div>
                                <!--row-->

                            </form>
                        </div>
                        <!--header-->

                        <div class="card-body">
                            Titulo: {{ $message->subject }}<br>
                            Messagem: {{ $message->message }}<br>
                            @if ($cronc)
                                Periodo de envio: {{ $cronc->time }}
                                @else
                                Periodo de envio: Não definiu nehnum periodo de envio
                            @endif
                        </div>
                        <!--card-body-->
                        <div class="card-footer flex" style="justify-content: start;">
                            <a href="{{ route('alert.message.edit', $message->id) }}" class="btn btn-info">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('alert.message.delete', $message->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger mx-1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                        <!---->
                    </div>
                    <!--card-->
                </div>
        </section>
    </div>
</div>

@include('admin.template.footer')
