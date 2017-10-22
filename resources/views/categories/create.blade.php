@extends('layout.user')
@section('challs', 'active')
@section('titulo',"UnameCTF - Categoria: ")
@section('conteudo')
    <h2 class='text-center'>Criar Categoria</h2>
    <div class="espacos"></div>
    <div class="espacos"></div>
    <form class="form-horizontal" role="form" method="POST" action="{{route('categoriasCreate')}}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nickname" class="col-md-4 control-label">Nome da Categoria: </label>
            <div class="col-md-6">
                <input id="nome" type="text" class="form-control input" name="nome" value="{{ old('nome') }}" required autofocus placeholder="Nome da categoria...">
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
                <input id="color" type="color" class="form-control input" name="color" value="{{ old('color') }}" required autofocus placeholder="Cor da categoria..." onchange="getRgb(this)">
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
                <textarea class="form-control input" name="descricao" id="descricao">{{ old('descricao') }}</textarea>
                @if ($errors->has('descricao'))
                    <span class="help-block">
                          <strong>{{ $errors->first('descricao') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="button button-black">
                    Criar Categoria
                </button>
            </div>
        </div>
    </form>
    <script>
        function getRgb(button){
            var colorReturn = hexToRgba(button.value, 0.85);
        }
        function hexToRgba(hex, opacity) {
            return 'rgba(' + (hex = hex.replace('#', '')).match(new RegExp('(.{' + hex.length/3 + '})', 'g')).map(function(l) { return parseInt(hex.length%2 ? l+l : l, 16) }).concat(opacity||1).join(',') + ')';
        }
    </script>
@endsection