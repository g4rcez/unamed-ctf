@extends('layout.user')
@section('challs', 'active')
@section('titulo',"UnameCTF - Categoria: ")
@section('conteudo')
    <div class="container">
        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ route('createChall') }}">{{ csrf_field() }}
                <input name="nome" />
                <input name="pontos" />
                <textarea name="enunciado"></textarea>
                <input name="autor" />
                <input name="flag" />
                <input type="submit" />
            </form>
        </div>
    </div>
@endsection