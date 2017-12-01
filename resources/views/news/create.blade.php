@extends('layout.admin')
@section('categories','active')
@section('titulo', getenv("CTF_NAME",true)." - Noticias")
@section('conteudo')

    <h2 class="text-center">Notícia</h2>


    <form class="form-horizontal" method="POST" action="{{route('newsCreate')}}">
        {{--getenv('ADMIN_ROUTE',true).'/'.getenv('NEWS_ROUTE',true).'/'.getenv('CREATE_ROUTE',true)--}}
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
            <label for="titulo" class="col-md-4 control-label">Título: </label>
            <div class="col-md-6">
                <input id="titulo" type="text" class="form-control input" name="titulo" value="{{ old('titulo') }}"
                       required autofocus placeholder="titulo da categoria..." onchange="tituloAlter()">
                @if ($errors->has('titulo'))
                    <span class="help-block">
                          <strong>{{ $errors->first('titulo') }}</strong>
                      </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
            <label for="descricao" class="col-md-4 control-label">@lang('categories.labelDescricao') </label>
            <div class="col-md-6">
                <textarea class="form-control input" name="descricao" id="descricao"
                          onchange="descAlter()">{{ old('descricao') }}</textarea>
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
                    Criar notícia
                </button>
            </div>
        </div>

    </form>

@endsection