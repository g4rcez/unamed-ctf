@extends('layout.admin')
@section('challs', 'active')
@section('titulo', getenv('CTF_NAME')."Categoria: ")
@section('conteudo')
    <script src="{{asset('assets/js/multiselect.js') }}"></script>
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
        Nova challenge
    </h2>
    <div class="espacos"></div>
    <div class="espacos"></div>
    <form class="form-horizontal" role="form" method="POST" action="{{route("createChall")}}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Nome do Desafio: </label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control input" name="name" value="{{ old('name') }}" required
                       autofocus placeholder="Nome do desafio...">
                @if ($errors->has('nome'))
                    <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
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
                            <option value="{{$categoria->id}}">{{$categoria->name}}</option>
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
                    @forelse($skills as $maestria)
                        <option value="{{$maestria->id}}">{{$maestria->name}}</option>
                    @empty
                </select>
                <h3>Sem maestria cadastrada</h3>
                @endforelse
                </select>
            </div>
        </div>

        <div class="form-group{{ $errors->has('available') ? ' has-error' : '' }}">
            <label for="available" class="col-md-4 control-label">Desafio liberado: </label>
            <div class="col-md-6">
                <select class="form-control input" id="available" name="available">
                    <option value="1">Disponível</option>
                    <option value="0">Bloqueado</option>
                </select>
                @if ($errors->has('available'))
                    <span class="help-block">
                          <strong>{{ $errors->first('available') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
            <label for="points" class="col-md-4 control-label">points: </label>
            <div class="col-md-6">
                <input id="points" type="number" class="form-control input" name="points" value="{{ old('points') }}"
                       placeholder="Pontuação...">
                @if ($errors->has('points'))
                    <span class="help-block">
                          <strong>{{ $errors->first('points') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">description: </label>
            <div class="col-md-6">
                <textarea rows="10" cols="66" class="input form-input" name="description"></textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('flag') ? ' has-error' : '' }}">
            <label for="flag" class="col-md-4 control-label">Flag: </label>
            <div class="col-md-6">
                <input id="flag" type="text" class="form-control input" name="flag" value="{{ old('flag') }}"
                       placeholder="Flag...">
                @if ($errors->has('flag'))
                    <span class="help-block">
                          <strong>{{ $errors->first('tag') }}</strong>
                      </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
            <label for="author" class="col-md-4 control-label">author: </label>
            <div class="col-md-6">
                <input id="author" type="text" class="form-control input" name="author"
                       value="{{ Auth::user()->nickname }}"
                       placeholder="Nome do author...">
                @if ($errors->has('author'))
                    <span class="help-block">
                          <strong>{{ $errors->first('author') }}</strong>
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
