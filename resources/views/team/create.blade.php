@extends('layout.user')
@section('title', 'UnameCTF - ScoreBoard')
@section('score', 'active')
@section('conteudo')
  @php $tokenHash = md5(rand()) @endphp
  <div class="container">
    <div class="row">
      <header>
        <h2 class="page-title">Nova equipe</h2>
      </header>
      <div class="espacos"></div>
      <form class="form-horizontal" role="form" method="POST" action="">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
              <label for="nickname" class="col-md-4 control-label">Nome do time: </label>
              <div class="col-md-6">
                  <input id="nickname" type="text" class="form-control input" name="nickname" value="{{ old('nickname') }}" required autofocus placeholder="Nome do time...">
                  @if ($errors->has('nickname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('nickname') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">Tag: </label>
              <div class="col-md-6">
                  <input id="email" type="text" class="form-control input" name="tag" value="{{ old('tag') }}" placeholder="Tag para o time...">
                  @if ($errors->has('tag'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tag') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('token') ? ' has-error' : '' }}">
              <label for="token" class="col-md-4 control-label">Token da equipe: </label>
              <div class="col-md-6">
                  <div class="input-group">
                  <input type="text" class="form-control input" placeholder="Username" aria-describedby="basic-addon1" value="{{$tokenHash}}" disabled>
                  <a class="tokenHash input-group-addon input" data-clipboard-action="copy" data-clipboard-target="#tokenHash" id='spanToken'>
                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                  </a>
                  {{-- <span class="input-group-addon input" id="basic-addon1">@</span> --}}
                  </div>
                  @if ($errors->has('avatar'))
                      <span class="help-block">
                          <strong>{{ $errors->first('token') }}</strong>
                      </span>
                  @endif
              </div>
              <script src="{{asset('assets/js/clipboard.min.js')}}"></script>
              <script>
              var clipboard = new Clipboard('.tokenHash');
              clipboard.on('success', function(e) {
                  console.log(e);
              });
              clipboard.on('error', function(e) {
                  console.log(e);
              });
              </script>
          </div>
          <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
              <label for="avatar" class="col-md-4 control-label">Avatar do time: </label>
              <div class="col-md-6">
                  <input type="file" name="avatar" id='avatar'>
                  @if ($errors->has('avatar'))
                      <span class="help-block">
                          <strong>{{ $errors->first('avatar') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group text-left">
              <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="button button-black">
                      Criar time
                  </button>
              </div>
          </div>
      </form>
    </div>
    <h3 class="text-center">Token da equipe:
      <span id='tokenHash'>
        {!! $tokenHash !!}
      </span>
    </h3>
  </div>
@endsection
