@extends('layout.user')
@section('challs','active')
@section('title','CTF - Challenges')
@section('conteudo')
<div class="row">
    <div class="container">
        @for ($i = 1; $i <= 6; $i++)
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
              <div class="alert desafio-box">
                  <h3>{{ "$i - Ola" }}</h3>
                  <div class="paragrafos">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                        qui officia deserunt mollit anim id est laborum.
                    </p>
                  </div>
                  <p class="desafio-informacao">
                      <a data-toggle="modal" data-target="#{{ "modal$i" }}">
                          <i class="fa fa-eye" aria-hidden="true"></i> Mais informações...
                      </a>
                  </p>
              </div>
          </div>
        @endfor
    </div>
</div>

@for ($i = 1; $i <= 6; $i++)
<div id="{{ "modal$i" }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ "$i - Ola" }}</h4>
      </div>
      <div class="modal-body">
        <p class="paragrafos">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
          fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
          qui officia deserunt mollit anim id est laborum.
        </p>
        <ul>
          <li>Autor: {{ $autor or 'Fulano de Tal'}}</li>
          <li>Link: <a href="{{ $link or 'Linkão bolado'}}">{{ $link or 'Linkão bolado'}}</a></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="button button-blue" data-dismiss="modal">Editar</button>
        <button type="button" class="button button-red" data-dismiss="modal">Deletar</button>
        <button type="button" class="button button-black" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
@endfor
