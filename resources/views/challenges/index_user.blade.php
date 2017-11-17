@extends('layout.user') 
@section('challs','active') 
@section('titulo',' - Challenges') 
@section('conteudo') 

@if (Session::has('flagCaptured'))
<div class="row">
  <div class="container">
    <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
      <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('flagCaptured') }}
      </div>
    </div>
  </div>
</div>
@endif

<div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
  <h2 class="text-center page-title">
    <i class="fa fa-flag" aria-hidden="true"></i> Capture the Flags</h2>
  <div class="espacos"></div>
  <div class="espacos"></div>
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <h3 class="text-left">Challenges disponíveis: {{$challenges->count()}}</h3>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <h3 class="text-right">Pontuação total: {{$challenges->sum("pontos")}}</h3>
    </div>
  </div>
  <div class="col-md-12 col-lg-12">
    <hr>
  </div>
  <div class="row">
    @foreach($challenges as $challenge)
    <div class="col-md-3 col-lg-3">
      <div class="chall-box" style="background-color:{{$challenge->category->color}}20">
        <h3>
          <a data-toggle="modal" data-target="#{{str_replace(' ','',$challenge->nome)}}" style="color:#fff;cursor:pointer">
            <i class="fa fa-flag" aria-hidden="true"></i>
            {{$challenge->nome}}
          </a>
        </h3>
        <h4>
          <small>{{$challenge->category->nome}}</small>
        </h4>
        <h4>{{$challenge->pontos}}</h4>
      </div>
      <div class="espacos"></div>
    </div>
    @endforeach
  </div>
</div>
<div class="espacos"></div>
<div class="espacos"></div>
<div class="espacos"></div>
@foreach($challenges as $challenge)
<div id="{{str_replace(' ','',$challenge->nome)}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{$challenge->nome}}</h4>
      </div>
      <div class="modal-body">
        <p class="paragrafos">{{$challenge->enunciado}}</p>
        <div class="espacos"></div>
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <form class="form-inline" action="{{url(" /challs/submit ")}}" method="POST">
                {{csrf_field()}}
                <label for="flag" class="control-label">Flag: </label>
                <input id="flag" class="form-control input" name="flag" value="{{ old('flag') }}" required autofocus placeholder="UCTF{S0U_M357R3_D05_1337}"
                  size="50"> @if ($errors->has('flag'))
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
@endsection