@extends('layout.guest')

@section('categories','active')
@section('titulo', getenv("CTF_NAME",true)." - Noticias")
@section('conteudo')
    @forelse($news as $new)
        <div class="container">
            <h2>{{$noticia->titulo}}</h2>
            <img src="{{$users->where('id', $noticia->users_id)->first()->avatar}}" alt=""
                 style="float:left; margin-right: 10px"
                 width="128px">
            <p class="paragrafos">{{$noticia->descricao}}</p>
            <p>Autor: <strong>{{$users->where('id', $noticia->users_id)->first()->nickname}}</strong></p>
        </div>
        <hr>
    @empty
        <h2>@lang('presentation.welcomeEmpty')</h2>
    @endforelse
@endsection
