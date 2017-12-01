@extends('layout.admin')
@section('challs', 'active')
@section('titulo',getenv('CTF_NAME',true).'- Editar Desafio')
@section('conteudo')
    <script src="{!! asset('assets/js/multiselect.js') !!}"></script>

    @if (Session::has('zeroCategorias'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-warning alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h4>{{ Session::get('zeroCategorias') }}</h4>
                        <h4>
                            <a href="{{route('categoriasViewCreate')}}">
                                <i class="fa fa-plus" aria-hidden="true"></i> Nova Categoria
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <h2 class='text-center'>
        <i class="fa fa-flag" aria-hidden="true"></i>
        Editar challenge
    </h2>
    <div class="espacos"></div>
    <div class="espacos"></div>
    <form class="form-horizontal" role="form" method="POST"
          action="{{url(getenv('ADMIN_ROUTE',true).'/'.getenv('CHALLS_ROUTE', true).'/'.getenv('EDIT_ROUTE', true).'/'.$challenge->id.'/'.$challenge->nome)}}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="nome" class="col-md-4 control-label">Nome do Desafio: </label>
            <div class="col-md-6">
                <input id="nome" type="text" class="form-control input" name="nome" value="{{$challenge->nome}}"
                       required autofocus placeholder="Nome do desafio...">
                @if ($errors->has('nome'))
                    <span class="help-block">
                          <strong>{{ $errors->first('nome') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="categorias" class="col-md-4 control-label">Categoria do desafio: </label>
            <div class="col-md-6">
                @if($categorias->count() > 0)
                    <select class="form-control input" name="categories_id">
                        @endif
                        @forelse($categorias as $categoria)
                            <option value="{{$categoria->id}}" selected>{{$categoria->nome}}</option>
                        @empty
                    </select>
                    <h3>Sem categoria cadastrada</h3>
                    @endforelse
                    </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="rolename">Maestria: </label>
            <div class="col-md-4">
                <select id="dates-field2" class="multiselect-ui form-control input" multiple="multiple"
                        name="maestrias[]">
                    @forelse($maestrias as $maestria)
                        <option value="{{$maestria->id}}">{{$maestria->maestria}}</option>
                    @empty
                </select>
                <h3>Sem maestria cadastrada</h3>
                @endforelse
                </select>
            </div>
        </div>

        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
            <label for="disponivel" class="col-md-4 control-label">Desafio liberado: </label>
            <div class="col-md-6">
                <select class="form-control input" id="categorias">
                    <option value=true>Disponível</option>
                    <option value=false>Bloqueado</option>
                </select>
                @if ($errors->has('disponivel'))
                    <span class="help-block">
                          <strong>{{ $errors->first('disponivel') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('pontos') ? ' has-error' : '' }}">
            <label for="pontos" class="col-md-4 control-label">Pontos: </label>
            <div class="col-md-6">
                <input id="pontos" type="number" class="form-control input" name="pontos" value="{{$challenge->pontos}}"
                       placeholder="Pontuação...">
                @if ($errors->has('pontos'))
                    <span class="help-block">
                          <strong>{{ $errors->first('points') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('enunciado') ? ' has-error' : '' }}">
            <label for="enunciado" class="col-md-4 control-label">Enunciado: </label>
            <div class="col-md-6">
                <textarea rows="10" cols="66" class="input form-input"
                          name="enunciado">{{$challenge->enunciado}}</textarea>
                @if ($errors->has('enunciado'))
                    <span class="help-block">
                          <strong>{{ $errors->first('enunciado') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('flag') ? ' has-error' : '' }}">
            <label for="flag" class="col-md-4 control-label">Flag: </label>
            <div class="col-md-6">
                <input id="flag" type="text" class="form-control input" name="flag" value="{{$challenge->flag}}"
                       placeholder="Flag...">
                @if ($errors->has('flag'))
                    <span class="help-block">
                          <strong>{{ $errors->first('tag') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('autor') ? ' has-error' : '' }}">
            <label for="autor" class="col-md-4 control-label">Autor: </label>
            <div class="col-md-6">
                <input id="autor" type="text" class="form-control input" name="autor" value="{{$challenge->autor}}"
                       placeholder="Nome do Autor...">
                @if ($errors->has('autor'))
                    <span class="help-block">
                          <strong>{{ $errors->first('autor') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
            <label for="arquivo" class="col-md-4 control-label">Arquivos: </label>
            <div class="col-md-6">
                <input type="file" name="arquivo" id='arquivo'>
                @if ($errors->has('arquivo'))
                    <span class="help-block">
                          <strong>{{ $errors->first('arquivo') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="button button-black">
                    Criar challenge
                </button>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        $(function () {
            $('.multiselect-ui').multiselect({
                includeSelectAllOption: true
            });
        });
    </script>
@endsection
