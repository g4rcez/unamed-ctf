@extends('layout.user')
@section('perfil','active')
@section('titulo',getenv("CTF_NAME",true)." - Bem vindo $usuario->nickname")
@section('conteudo')
    <script src="{!!asset('assets/js/exporting.js')!!}"></script>
    <script src='{!!asset('assets/js/highcharts.src.js')!!}'></script>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <header>
                    <h2>
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> Painel do {{ $usuario->nickname }}
                        <small>
                            @isset($team)
                                {{ "$team->nome - token: $team->token" }}
                            @endisset
                        </small>
                    </h2>
                    <div class="espacos"></div>
                </header>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3 col-xs-12">
                <div class="card">
                    <img class="card-img-top"
                         src="{{ $usuario->avatar }}"
                         class="img-responsive">
                    <div class="card-block">
                        <figure class="profile">
                            <img src="{{ $usuario->avatar }}"
                                 class="profile-avatar" alt="avatar for user">
                        </figure>
                        <h4 class="card-title mt-3">
                            {{ $usuario->nickname }}
                            <small>{{$team->nome or ''}}</small>
                        </h4>
                    </div>
                    <div class="card-footer">
                        @isset($team)
                            <span class="dark">Nome da equipe: {{$team->token}}</span><br/>
                        @endisset
                        <a data-toggle="modal" data-target="#myModal">For nerds</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-9 col-lg-9 col-xs-12">
                <h2>Estátisticas <i class="fa fa-bar-chart" aria-hidden="true"></i></h2>
                <div class="row">
                    <div id="container"></div>
                </div>
                <script>
                    Highcharts.chart('container', {
                        chart: {
                            backgroundColor: '#121212',
                            type: 'bar',
                            shadow: true
                        },
                        title: {
                            style: {"color": "#fff"},
                            text: 'Histórico de Flags',
                        },
                        xAxis: {
                            categories: [
                                @foreach($categories['pontos'] as $key=>$category)
                                    '{{$key}}',
                                @endforeach
                            ],
                            style: {"color": "#fff"},
                            title: {
                                style: {"color": "#fff"}
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Pontos',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' pontos'
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: false
                                }
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                            name: "{{ $usuario->nickname }}",
                            data: [
                                @foreach($categories['pontos'] as $category)
                                {{"$category"}},
                                @endforeach
                            ]
                        }]
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close light" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">
              <i class="fa fa-times"></i>
            </span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        Estátisticas de {{ $usuario->nickname }}
                    </h4>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Total de flags capturadas: <strong>{{$usuario->challenges()->count()}}</strong></li>
                        <li>Total de pontos: <strong>{{$pontuacao}}</strong></li>
                        <li>Usuário desde: <strong>{{$usuario->created_at}}</strong></li>
                        @isset($team)
                            <li>Nome do time: {{$team->nome}}</li>
                        @endisset
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button button-red" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
