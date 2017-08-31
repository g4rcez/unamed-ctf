@extends('layout.guest')
@section('login','active')
@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="text-center">
                  Login do Usuário
                </h2>

                <div class="espacos"></div>
                <div class="espacos"></div>

                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Nickname: </label>
                        <div class="col-md-6">
                            <input id="nickname" type="text" class="form-control input" name="nickname"
                                   value="{{ old('nickname') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Senha: </label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control input" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Manter conectado?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="button button-black">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#aed3f4;">
                                Esqueceu sua senha?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
