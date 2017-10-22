@extends('layout.user')
@section('challs','active')
@section('title','ChallengesController')
@section('conteudo')
<div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
<h2 class="text-center page-title"><i class="fa fa-flag" aria-hidden="true"></i> Capture the Flags</h2>
<div class="espacos"></div><div class="espacos"></div>
  <div class="row box-users">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h3 class="text-left">Encerra em: HH:MM:YY</h3>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h3 class="text-right">Pontuação total: X</h3>
      </div>
    </div>
    <div class="col-md-12 col-lg-12">
      <hr>
    </div>
    <div class="row">
      @for ($i=0; $i < 20; $i++)
        <div class="col-md-2 col-lg-2">
          <div class="box-challs" style="background-color: #324c6530">
            <h3>Ola Mundo</h3>
          </div>
        </div>
      @endfor
    </div>
  </div>
  <div class="espacos"></div><div class="espacos"></div><div class="espacos"></div>
</div>
