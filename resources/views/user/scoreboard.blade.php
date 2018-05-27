@extends('layout.user')
@section('title', 'UnameCTF - ScoreBoard')
@section('score', 'active')
@section('conteudo')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-md-12 col-lg-12">
                    <h2 class="text-center page-title">
                        Scoreboard
                    </h2>
                    <div class="espacos"></div>
                    <table class="table table-responsive table-bordered table-hover">
                        <thead>
                        <td valign="middle" class="table-body-dark" align="center">
                            <h3>Avatar</h3>
                        </td>
                        <td valign="middle" class="table-body-dark" align="center">
                            <h3>Colocação</h3>
                        </td>
                        <td valign="middle" class="table-body-dark" align="center">
                            <h3>Jogador</h3>
                        </td>
                        <td valign="middle" class="table-body-dark" align="center">
                            <h3>Equipe</h3>
                        </td>
                        <td valign="middle" class="table-body-dark" align="center">
                            <h3>Pontuação</h3>
                        </td>
                        </thead>
                        @php $count=1 @endphp
                        @foreach($score as $usuario)
                            <tbody class="table-hover">
                            <td valign="middle" align="center" class="table-body-transparent">
                                <img src="{{$usuario->getAvatar()}}" class="img-responsive" width="32px"
                                     height="32px">
                            </td>
                            <td valign="middle" align="center" class="table-body-transparent">{{ $count }}</td>
                            <td valign="middle" align="center" class="table-body-transparent">
                                <a href="#">{{$usuario->getNome()}}</a>
                            </td>
                            <td valign="middle" align="center" class="table-body-transparent">
                                <a href="#">{{$usuario->getTeam()->nome or ""}}</a>
                            </td>
                            <td valign="middle" align="center"
                                class="table-body-transparent">{{$usuario->getScore()}}</td>
                            </tbody>
                            @php $count+=1 @endphp
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
