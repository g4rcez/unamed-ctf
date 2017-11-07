@extends('layout.user')
@section('challs','active')
@section('titulo',' - Challenges')
@section('conteudo')
<div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
<h2 class="text-center page-title"><i class="fa fa-flag" aria-hidden="true"></i> Capture the Flags</h2>
<div class="espacos"></div><div class="espacos"></div>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h3 class="text-left">Challenges disponíveis: {{$categorias->count()}}</h3>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h3 class="text-right">Pontuação total: {{rand(0, 9999)}}</h3>
      </div>
    </div>
    <div class="col-md-12 col-lg-12">
      <hr>
    </div>
    <div class="row">
      @foreach($categorias as $categoria)
      <div class="col-md-3 col-lg-3">
          <div class="chall-box" style="background-color:{{$categoria->color}}20">
              <h3>
                <a data-toggle="modal" data-target="#{{str_replace(' ','',$categoria->nome)}}" style="color:#fff;cursor:pointer">
                  <i class="fa fa-flag" aria-hidden="true"></i>
                  Flag Monstra pra ownar
                </a>
            </h3>
            <h4><small>{{$categoria->nome}}</small></h4>
            <h4>{{rand(0, 9999)}}</h4>
          </div>
          <div class="espacos"></div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="espacos"></div><div class="espacos"></div><div class="espacos"></div>
  @foreach($categorias as $categoria)
      <div id="{{str_replace(' ','',$categoria->nome)}}" class="modal fade" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">{{$categoria->nome}}</h4>
                  </div>
                  <div class="modal-body">
                      <p class="paragrafos">{{$categoria->descricao}}</p>
                      <div class="espacos"></div>
                      <h4>Downloads</h4>
                      <ul>
                        @for($i=0; $i < 3; $i+=1)
                          <li>Ola</li>
                        @endfor
                      </ul>
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12 col-lg-12">
                            <form class="form-inline" action="" method="POST">
                                <label for="flag" class="control-label">Flag: </label>
                                  <input id="flag" class="form-control input" name="flag" value="{{ old('flag') }}" required autofocus placeholder="UCTF{S0U_M357R3_D05_1337}" size="50">
                                  @if ($errors->has('flag'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('flag') }}</strong>
                                      </span>
                                  @endif
                              <input type="submit" class="button button-black" value="Capture" />
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="button button-black" data-dismiss="modal" value="">Fechar
                    </button>
                  </div>
              </div>
          </div>
      </div>
  @endforeach
