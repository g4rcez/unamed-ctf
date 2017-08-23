@extends('layout.guest')
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
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">Registro de Usuário</h2>
            <div class="espacos"></div>
            <div class="espacos"></div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                            <label for="nickname" class="col-md-4 control-label">Nickname: </label>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control input" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                            <label for="password-confirm" class="col-md-4 control-label">Confirmação de Senha: </label>
                            <div class="col-md-6">
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
