@extends('layout.user')
@section('challs', 'active')
@section('titulo',"Editar Categoria")
@section('conteudo')
    <h2 class='text-center'>Editar {{$categoria->nome}}</h2>
    <div class="espacos"></div>
    <div class="espacos"></div>
    <form class="form-horizontal" role="form" method="POST" action="{{url(getenv('ADMIN_ROUTE', true)."/categorias/editar/$categoria->nome/$categoria->id")}}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome" class="col-md-4 control-label">Nome da Categoria: </label>
            <div class="col-md-6">
                <input id="nome" type="text" class="form-control input" name="nome" value="{{ $categoria->nome }}" required autofocus placeholder="Nome da categoria..." onchange="tituloAlter()">
                @if ($errors->has('nome'))
                    <span class="help-block">
                          <strong>{{ $errors->first('nome') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
            <label for="nickname" class="col-md-4 control-label">Cor da Categoria: </label>
            <div class="col-md-1">
                <input id="color" type="color" class="form-control input" name="color" value="{{$categoria->color}}" required autofocus placeholder="Cor da categoria..." onchange="getRgb(this)">
                @if ($errors->has('color'))
                    <span class="help-block">
                          <strong>{{ $errors->first('color') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
            <label for="descricao" class="col-md-4 control-label">Descrição: </label>
            <div class="col-md-6">
                <textarea class="form-control input" name="descricao" id="descricao" onchange="descAlter()">{{ $categoria->descricao }}</textarea>
                @if ($errors->has('descricao'))
                    <span class="help-block">
                          <strong>{{ $errors->first('descricao') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-md-6 col-md-offset-4">
                <a href="{{route('categorias')}}" class="button button-cyan">Voltar</a>
                <button type="submit" class="button button-black text-right">
                    Atualizar {{$categoria->nome}}
                </button>
            </div>
        </div>
    </form>
    <div class="row">
      <div class="col-md-offset-4 col-md-3 col-lg-3">
          <div class="box-users" style="background-color:{{$categoria->color}}20" id='box-categoria'>
              <h3><a data-toggle="modal" data-target="#teste" style="color:#fff;cursor:pointer" id='novoTitulo'>
                      {{$categoria->nome}}
                  </a></h3>
              <ul>
                  <li>Total de Challs: <strong>X</strong></li>
                  <li>Total de pontos: <strong>X</strong></li>
              </ul>
          </div>
      </div>
    </div>
    <div id="teste" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id='novoTituloModal'>{{$categoria->nome}}</h4>
                </div>
                <div class="modal-body">
                    <p class="paragrafos" id="descricaoModal">
                        {{ $categoria->descricao }}
                    </p>
                </div>
                <div class="modal-footer">
                    <form>
                        <a href="#" class="button button-blue">Editar</a>
                        <input type="submit" class="button button-red" value="Deletar"/>
                        <button type="button" class="button button-black" data-dismiss="modal" value="">Fechar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getRgb(button){
          var colorReturn = hexToRgba(button.value, 0.85);
          document.getElementById('box-categoria').style.backgroundColor = colorReturn;
          document.getElementById('box-categoria').style.borderColor = colorReturn;
        }
        function hexToRgba(hex, opacity) {
            return 'rgba(' + (hex = hex.replace('#', '')).match(new RegExp('(.{' + hex.length/3 + '})', 'g')).map(function(l) { return parseInt(hex.length%2 ? l+l : l, 16) }).concat(opacity||1).join(',') + ')';
        }
        function tituloAlter(){
          var titulo = document.getElementById("nome").value;
          var div = document.getElementById("novoTitulo");
          var div2 = document.getElementById("novoTituloModal");
          div.innerText = titulo;
          div2.innerText = titulo;
        }
        function descAlter(){
          var titulo = document.getElementById("descricao").value;
          var div = document.getElementById("descricaoModal");
          div.innerText = titulo;
        }
    </script>
@endsection
