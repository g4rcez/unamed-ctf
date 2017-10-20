@extends('layout.user')
@section('challs', 'active')
@section('titulo',"UnameCTF - Categoria: ")
@section('conteudo')
<h2 class='text-center'>Criar desafio</h2>
<div class="espacos"></div>
<div class="espacos"></div>
     <form class="form-horizontal" role="form" method="POST" action="">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
              <label for="nickname" class="col-md-4 control-label">Nome do Desafio: </label>
              <div class="col-md-6">
                  <input id="nickname" type="text" class="form-control input" name="nickname" value="{{ old('nickname') }}" required autofocus placeholder="Nome do desafio...">
                  @if ($errors->has('nickname'))
                      <span class="help-block">
                          <strong>{{ $errors->first('nickname') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">Pontos: </label>
              <div class="col-md-6">
                  <input id="email" type="number" class="form-control input" name="tag" value="{{ old('tag') }}" placeholder="Pontuação...">
                  @if ($errors->has('tag'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tag') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">Enunciado: </label>
              <div class="col-md-6">
                  <textarea rows="10" cols="79"></textarea>
                  @if ($errors->has('tag'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tag') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">Flag: </label>
              <div class="col-md-6">
                  <input id="email" type="text" class="form-control input" name="tag" value="{{ old('tag') }}" placeholder="Flag...">
                  @if ($errors->has('tag'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tag') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">Autor: </label>
              <div class="col-md-6">
                  <input id="email" type="text" class="form-control input" name="tag" value="{{ old('tag') }}" placeholder="Nome do Autor...">
                  @if ($errors->has('tag'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tag') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
              <label for="avatar" class="col-md-4 control-label">Arquivos: </label>
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
@endsection