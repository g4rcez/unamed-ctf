@extends('layout.admin')
@section('permissions','active')
@section('title','Permissões de usuário')
@section('conteudo')
    <style>
        [data-style=primary] + .popover {
            background: #121212;
            border-radius: 0;
        }
    </style>
    @if (Session::has('nova'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('nova') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <h2 class="page-title text-center">
        Permissões
    </h2>
    <h4 class="text-center">
        <small>
        Permissão de Administrador: {{getenv('ADMIN_PERM')}} - 
        <a data-toggle="collapse" data-target="#cadastrar">
                Adicionar <i class="fa fa-plus"></i>
        </a></small>
    </h4>
    <div class="collapse" id="cadastrar">
        <form class="form-inline text-center" method="POST" action="{{route('permissionCreate')}}">
            {{csrf_field()}}
            <label for="permissao">Adicionar Permissão: </label>
            <input name="permissao" class="form-control input" id="permissao" placeholder="Nova maestria..."
                   data-toggle="popover" data-trigger="hover" data-style="primary"
                   data-content="Item que caracteriza os jogadores" data-placement="bottom"/>
            <input type="submit" class="button button-black" value="Criar Permissão">
        </form>
    </div>
    <div class="espacos"></div>
    <div class="row">
        <div class="container">
            @foreach($permissoes as $permissao)
                <div class="col-xs-2 col-sm-3 col-lg-3 col-md-3">
                    <a data-toggle="modal" data-target="#{{md5($permissao->permissao)}}" style="color:#fff;cursor:pointer;font-size: 1.4em">
                        <i class="fa fa-rebel"aria-hidden="true"></i> {{ $permissao->permissao }}
                    </a>
                    <div class="espacos"></div>
                </div>
            @endforeach
        </div>
    </div>

    @foreach($permissoes as $maestria)
        <div id="{{md5($maestria->maestria)}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$maestria->maestria}}</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{url(getenv('ADMIN_ROUTE', true)."/".getenv('permissoes_ROUTE',true)."/".getenv('EDIT_ROUTE',true)."/"."$maestria->maestria/$maestria->id")}}" method="POST" class="form-inline">
                            {{ csrf_field() }}
                            <label for="nova-maestria">Adicionar Maestria: </label>
                            <input name="maestria" class="form-control input" id="novamaestria" placeholder="Nova maestria..."
                                   data-toggle="popover" data-trigger="hover" data-style="primary"
                                   data-content="Item que caracteriza os jogadores" data-placement="bottom"/>
                            <input type="submit" class="button button-blue" value="Editar"/>
                        </form>
                        <hr>
                        <p class="paragrafos">
                            <h3>Top 10 players:</h3>
                            <ul>
                                <li>Ola</li>
                            </ul>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{url(getenv('ADMIN_ROUTE', true)."/maestria/deletar/$maestria->maestria/$maestria->id")}}" class="form-inline" method="POST">
                            {{ csrf_field() }}
                            <input type="submit" class="button button-red" value="Deletar"/>
                            <button type="button" class="button button-black" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script type='text/javascript'>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        })
    </script>
@endsection
