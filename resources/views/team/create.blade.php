@extends('layout.user')
@section('title', 'UnameCTF - ScoreBoard')
@section('score', 'active')
@section('conteudo')
    <div class="container">
        <ul class="nav nav-tabs nav-justified center tc">
            <li class="active"><a data-toggle="tab" href="#new" class="bg-black-40 link pointer white">Nova Equipe</a>
            </li>
            <li><a data-toggle="tab" href="#join" class="bg-black-40 link pointer white">Alistar</a></li>
        </ul>

        <div class="tab-content">
            <div id="new" class="tab-pane fade in active">
                <div id="new" class="tab-pane fade in active">
                    <div class="row">
                        <header>
                            <h2 class="page-title center tc">Nova equipe</h2>
                        </header>
                        <div class="espacos"></div>
                        <form class="form-horizontal" role="form" method="POST" action="{{route('createTeamPost')}}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="nome" class="col-md-4 control-label">Nome do time: </label>
                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control input" name="nome"
                                           value="{{ old('nome') }}" required autofocus
                                           placeholder="Nome do time...">
                                    @if ($errors->has('nome'))
                                        <span class="help-block">
                          <strong>{{ $errors->first('nome') }}</strong>
                      </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Tag: </label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control input" name="tag"
                                           value="{{ old('tag') }}"
                                           placeholder="Tag para o time...">
                                    @if ($errors->has('tag'))
                                        <span class="help-block">
                          <strong>{{ $errors->first('tag') }}</strong>
                      </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label for="avatar" class="col-md-4 control-label">Avatar do time: </label>
                                <div class="col-md-6">
                                    <input type="text" max="128" maxlength="128" name="avatar" id='avatar'
                                           class="form-control input"
                                           placeholder="https://d14rmgtrwzf5a.cloudfront.net/sites/default/files/marijuana-from-marijuana-farm.jpg">
                                    @if ($errors->has('avatar'))
                                        <span class="help-block">
                          <strong>{{ $errors->first('avatar') }}</strong>
                      </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="button button-black">
                                        Criar time
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="join" class="tab-pane fade">
                <div class="espacos"></div>
                <header>
                    <h2 class="page-title center tc">Alistar a uma equipe equipe</h2>
                </header>
                <form action="{{route('joinTeam')}}" method="post" class="form-horizontal mt3">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                        <label for="avatar" class="col-md-4 control-label">Avatar do time: </label>
                        <div class="col-md-6">
                            <input type="text" max="32" maxlength="32" name="token" id='token'
                                   class="form-control input" placeholder="0f40a5b17e5bf664f339800316443e4b">
                            @if ($errors->has('avatar'))
                                <span class="help-block">
                          <strong>{{ $errors->first('avatar') }}</strong>
                      </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="button button-black">
                                Entrar no time
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
