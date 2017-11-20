@extends('layout.admin') 
@section('challs','active')
@section('titulo', getenv('CTF_NAME', true)."- Challenges")
@section('conteudo')
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
        <h4 class="modal-title">{{$challenge->nome}} - {{$challenge->category->nome}}</h4>
      </div>
      <div class="modal-body">
        <p class="paragrafos">{{$challenge->enunciado}}</p>
        <div class="espacos"></div>
        @if(isset($challenge->arquivo))
          <h4>Downloads</h4>
          <ul>
            <li>{{$challenge->arquivo}}</li>
          </ul>
        @endif
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
            <div class="espacos"></div>
              <form class="form-inline" action="{{url(getenv('ADMIN_ROUTE', true)."/challs/deletar/$challenge->nome/$challenge->id")}}" method="POST">
              {{csrf_field()}}
                <a href="" class="button button-blue">Editar</a>
                <input type="submit" class="button button-red" value="Deletar" />
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