@extends('layout.user')
@section('title', 'UnameCTF - ScoreBoard')
@section('score', 'active')
@section('conteudo')
    <script src="{!!asset('assets/js/exporting.js')!!}"></script>
    <script src='{!!asset('assets/js/highcharts.src.js')!!}'></script>
    <div class="container">
        <div class="row">
            <header>
                <h2 class="page-title tc center"><i class="fa fa-users" aria-hidden="true"></i>
                    {{ $team->nome}}
                    <small>{{$team->tag}}</small>
                </h2>
            </header>
            <div class="espacos"></div>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <h2>Membros da Equipe</h2>
                    <div class="espacos"></div>
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-md-12 col-lg-12">
                                <img src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png"
                                     width="64px" style="float:left;background:#aaa;margin-right:10px">
                                <h4>Membro: {{ $user->getNickname() }}</h4>
                                <h4>Pontos: {{$user->getPontos() }}</h4>
                                <div class="espacos"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <h2>Dados da Equipe</h2>
                    <div class="espacos"></div>
                    <h3>- Classificação:
{{--                        <strong>{{ $equipe->ranking }}</strong>--}}
                    </h3>
                    <h3>- Tag:
                        <strong>{{ $team->tag }}</strong>
                    </h3>
                    <h3>- Total de Flags:
                        <strong>{{ count($challenges) }}</strong>
                    </h3>
                </div>
            </div>
        </div>
    </div>
@endsection
