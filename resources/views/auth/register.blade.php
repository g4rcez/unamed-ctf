@extends('layout.guest')
@section('register', 'active')
@section('titulo', getenv('CTF_NAME',true).' - Registrar')
@section('conteudo')
<div class="container">
    <div class="row">
        @if (count($errors) > 0)
            <div class="row">
                <div class="container">
                    <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
                        <div class="warning warning-red denuncia-errors">
                            @foreach($errors->all() as $error)
                                <ul class="fa-ul">
                                    <li>
                                        <i class="fa fa-times" aria-hidden="true"></i> {!! $error !!}
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-10">
            <h2 class="text-center">Registro de Usuário</h2>
            <div class="espacos"></div>
            <div class="espacos"></div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('post-register') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                    <label for="nickname" class="col-md-4 control-label">Nickname: </label>
                    <div class="col-md-8">
                        <input id="nickname" type="text" class="form-control input" name="nickname" value="{{ old('nickname') }}" required autofocus>
                        @if ($errors->has('nickname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nickname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Email: </label>
                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control input" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="favorita" class="col-md-4 control-label">Melhor Maestria: </label>
                    <div class="col-md-8">
                        @if($maestrias->count() == 0)
                            <input id="favorita" type="text" class="form-control input" name="categoria_favorita" value="{{ old('email') }}" required>
                        @else
                        <select name="categoria_favorita" class="form-control input">
                            @foreach($maestrias as $maestria)
                                <option value="{{$maestria->$maestria}}">{{$maestria->maestria}}</option>
                            @endforeach
                        </select>
                        @endif
                        @if ($errors->has('categoria_favorita'))
                            <span class="help-block">
                                <strong>{{ $errors->first('categoria_favorita') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="favorita" class="col-md-4 control-label">Avatar: </label>
                    <div class="col-md-8">
                        <input id="avatar" type="text" class="form-control input" name="avatar" value="{{ old('avatar') }}" required>
                        @if ($errors->has('avatar'))
                            <span class="help-block">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Senha: </label>
                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control input" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirmação de Senha: </label>
                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control input" name="password_confirmation" required>
                    </div>
                </div>
                <div class="form-group text-left">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="button button-black">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
