@extends('layout.guest')
@section('perfil','active')
@section('titulo')
@section('conteudo')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{asset("assets/img/grupocomp.jpg")}}" class="img-responsive"/>
            </div>
            <div class="col-md-6">
                <img src="{{asset("assets/img/indicca.jpg")}}" class="img-responsive"/>
            </div>
        </div>
    </div>
@endsection
