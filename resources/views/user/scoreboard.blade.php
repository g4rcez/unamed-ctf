@extends('layout.user')
@section('title', 'UnameCTF - ScoreBoard')
@section('score', 'active')
@section('conteudo')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-lg-12 col-md-12 col-lg-12">
      <h2 class="text-center page-title">
        Scoreboard
      </h2>
      <div class="espacos"></div>
      <table class="table table-responsive table-bordered table-hover">
        <thead>
          <td valign="middle" class="table-body-dark" align="center">
            <h3>Colocação</h3>
          </td>
          <td valign="middle" class="table-body-dark" align="center">
            <h3>Jogador</h3>
          </td>
          <td valign="middle" class="table-body-dark" align="center">
            <h3>Pontuação</h3>
          </td>
          <td valign="middle" class="table-body-dark" align="center">
            <h3>Avatar</h3>
          </td>
        </thead>
          @php $count=1 @endphp
        @foreach($score as $usuario)
          <tbody class="table-hover">
            <td valign="middle" align="center" class="table-body-transparent">{{ $count }}</td>
            <td valign="middle" align="center" class="table-body-transparent">
              <a href="http://google.com">{{$usuario->getNome()}}</a>
            </td>
            <td valign="middle" align="center" class="table-body-transparent">{{$usuario->getScore()}}</td>
            <td valign="middle" align="center" class="table-body-transparent">
              <img src="{{$usuario->getAvatar()}}" class="img-responsive" width="32px" height="32px">
            </td>
          </tbody>
              @php $count+=1 @endphp
        @endforeach
      </table>
    </div>
    {{--<div class="col-xs-12 col-lg-12 col-md-6 col-lg-6">--}}
      {{--<h2 class="text-center page-title">--}}
        {{--Challenges--}}
      {{--</h2>--}}
      {{--<div class="espacos"></div>--}}
      {{--<table class="table table-responsive table-bordered table-condensed table-hover">--}}
        {{--<thead>--}}
          {{--<td class="table-body-dark" align="center">--}}
            {{--<h3>Categoria</h3>--}}
          {{--</td>--}}
          {{--<td class="table-body-dark" align="center">--}}
            {{--<h3>Questão</h3>--}}
          {{--</td>--}}
          {{--<td class="table-body-dark" align="center">--}}
            {{--<h3>Pontuação</h3>--}}
          {{--</td>--}}
          {{--<td class="table-body-dark" align="center">--}}
            {{--<h3>Solvers</h3>--}}
          {{--</td>--}}
        {{--</thead>--}}
        {{--@for ($i=0; $i < 10; $i++)--}}
          {{--<tbody class="table-hover">--}}
            {{--<td align="center" class="table-body-transparent">Forense</td>--}}
            {{--<td align="center" class="table-body-transparent">Who is Next?</td>--}}
            {{--<td align="center" class="table-body-transparent">--}}
              {{--70--}}
            {{--</td>--}}
            {{--<td align="center" class="table-body-transparent">--}}
              {{--<p>--}}
                {{--<a href="http://google.com">RedHood</a><br />--}}
                {{--<a href="http://google.com">RedHood</a><br />--}}
                {{--<a href="http://google.com">RedHood</a>--}}
              {{--</p>--}}
            {{--</td>--}}
          {{--</tbody>--}}
        {{--@endfor--}}
      {{--</table>--}}
    {{--</div>--}}
  </div>
</div>
