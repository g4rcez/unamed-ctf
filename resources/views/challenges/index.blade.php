@extends('layout.admin')
@section('challs','active')
@section('titulo', getenv('CTF_NAME', true)."- Challenges")
@section('conteudo')
    <div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">

        <div class="espacos"></div>
        <div class="espacos"></div>
        <div class="row">
            @if($challenges->count() == 0)
                <h2 class="text-center">@lang('challenges.empty')</h2>
                <div class="espacos"></div>
                <h2 class="text-center page-title">
                    <a href="{{route('createChall')}}">
                        @lang('challenges.newChallenge') <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </h2>
                <div class="espacos"></div>
                <div class="espacos"></div>
                <div class="espacos"></div>
            @else
                <h2 class="text-center page-title">
                    <i class="fa fa-flag" aria-hidden="true"></i> @lang("admin.challsTitle")</h2>
                    <h4 class="text-center">
                        <a href="{{route('createChall')}}">
                            @lang("admin.challsCreateLink") <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </h4>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <h3 class="text-left">@lang('admin.challsCount'){{$challenges->count()}}</h3>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <h3 class="text-right">@lang('admin.challsPoints'){{$challenges->sum("pontos")}}</h3>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <hr>
                </div>
                @foreach($challenges as $challenge)
                    <div class="col-md-3 col-lg-3">
                        <div class="chall-box" style="cursor:pointer;background-color:{{$challenge->category->color}}" data-toggle="modal" data-target="#{{md5($challenge->nome)}}">
                            <h3>
                                <i class="fa fa-flag" aria-hidden="true"></i>
                                {{$challenge->nome}}
                            </h3>
                            <h4>
                                <small>{{$challenge->category->nome}}</small>
                            </h4>
                            <h4>{{$challenge->pontos}}</h4>
                        </div>
                        <div class="espacos"></div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="espacos"></div>
    <div class="espacos"></div>
    <div class="espacos"></div>
    @foreach($challenges as $challenge)
        <div id="{{md5($challenge->nome)}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$challenge->nome}} - {{$challenge->category->nome}}</h4>
                    </div>
                    <div class="modal-body">
                        <p class="paragrafos">{{$challenge->enunciado}}</p>
                        <div class="espacos"></div>
                        @if(isset($challenge->arquivo))
                            <h4>Downloads</h4>
                            <ul>
                                <li>{{$challenge->arquivo}}</li>
                            </ul>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="espacos"></div>
                                    <form class="form-inline" action="{{url(getenv('ADMIN_ROUTE', true)."/challs/deletar/$challenge->id")}}"
                                          method="POST">
                                        {{csrf_field()}}
                                        <a href="{{url(getenv("ADMIN_ROUTE",true).'/challs/editar/'.$challenge->id)}}" class="button button-blue">Editar</a>
                                        <input type="submit" class="button button-red" value="Deletar"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-black" data-dismiss="modal" value="">Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach