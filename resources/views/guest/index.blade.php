@extends('layout.guest')
@section('titulo',"UnameCTF - Bem vindo")
@section('home','active')
@section('conteudo')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <header>
                <h2><i class="fa fa-newspaper-o" aria-hidden="true"></i> Painel de Notícias
                    <small>Bem vindo Convidado</small>
                </h2>
            </header>
            <section class="row">
                @for($i=1; $i<10;$i++)
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h3>{{ $noticia->usuario->nickname or 'Anon' }}</h3>
                        <h4>{{ $noticia->created_at or 'Tarde da noite' }}</h4>
                        <img class='img-responsive'
                             style="float:left"
                             src="{{ $noticia->usuario->avatar or 'https://vignette.wikia.nocookie.net/avengers-academy/images/d/dc/Spider-Man_Icon_Rank_5.png/revision/latest?cb=20160512120602' }}"/>
                        <h3>{{ $noticia->titulo or 'Título' }}</h3>
                        <p class="paragrafos">
                            {{ $noticia->descricao or  'Notícia do caralho' }}
                        </p>
                    </div>
                @endfor
            </section>
        </div>
    </div>
@endsection
