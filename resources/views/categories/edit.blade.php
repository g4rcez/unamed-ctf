@extends('layout.admin')
@section('categories', 'active')
@section('titulo',"Editar Categoria")
@section('conteudo')
    <h2 class='text-center'>Editar {{$category->name}}</h2>
    <div class="espacos"></div>
    <div class="espacos"></div>
    <form class="form-horizontal" role="form" method="POST"
          action="{{url(getenv('ADMIN_ROUTE')."/".getenv('CATEGORIES_ROUTE')."/".getenv("EDIT_ROUTE")."/".$category->name."/".$category->id)}}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Nome da Categoria: </label>
            <div class="col-md-6">
                <input id="nome" type="text" class="form-control input" name="name" value="{{ $category->name }}"
                       required autofocus placeholder="Nome da categoria..." onchange="tituloAlter()">
                @if ($errors->has('name'))
                    <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
            <label for="nickname" class="col-md-4 control-label">Cor da Categoria: </label>
            <div class="col-md-1">
                <input id="color" type="color" class="form-control input" name="color" value="{{$category->color}}"
                       required autofocus placeholder="Cor da categoria..." onchange="getRgb(this)">
                @if ($errors->has('color'))
                    <span class="help-block">
        <strong>{{ $errors->first('color') }}</strong>
        </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Descrição: </label>
            <div class="col-md-6">
        <textarea class="form-control input" name="description" id="description"
                  onchange="descAlter()">{{ $category->description }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
        <strong>{{ $errors->first('description') }}</strong>
        </span>
                @endif
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-md-6 col-md-offset-4">
                <a href="{{route('categories')}}" class="button button-orange">Voltar</a>
                <button type="submit" class="button button-black text-right">
                    Atualizar {{$category->name}}
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-offset-4 col-md-3 col-lg-3">
            <div class="box-users" id='box-categoria' style="background-color:'{{$category->color}}';">
                <h3><a data-toggle="modal" data-target="#teste" style="color:#fff; cursor:pointer" id='novoTitulo'>
                        {{$category->name}}
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
                    <h4 class="modal-title" id='novoTituloModal'>{{$category->name}}</h4>
                </div>
                <div class="modal-body">
                    <p class="paragrafos" id="descricaoModal">
                        {{ $category->description }}
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
        function getRgb(button) {
            var colorReturn = hexToRgba(button.value, 0.85);
            document.getElementById('box-categoria').style.backgroundColor = colorReturn;
            document.getElementById('box-categoria').style.borderColor = colorReturn;
        }

        function hexToRgba(hex, opacity) {
            return 'rgba(' + (hex = hex.replace('#', '')).match(new RegExp('(.{' + hex.length / 3 + '})', 'g')).map(function (l) {
                return parseInt(hex.length % 2 ? l + l : l, 16)
            }).concat(opacity || 1).join(',') + ')';
        }

        function tituloAlter() {
            var titulo = document.getElementById("name").value;
            var div = document.getElementById("novoTitulo");
            var div2 = document.getElementById("novoTituloModal");
            div.innerText = titulo;
            div2.innerText = titulo;
        }

        function descAlter() {
            var titulo = document.getElementById("name").value;
            var div = document.getElementById("descricaoModal");
            div.innerText = titulo;
        }
    </script>
@endsection
