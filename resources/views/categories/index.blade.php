@extends('layout.admin')
@section('categories','active')
@section('titulo', getenv("CTF_NAME",true)." - Categorias")
@section('conteudo')
    @if (Session::has('nova'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('nova') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Session::has('deletado'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-warning alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('deletado') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Session::has('atualizado'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-info alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('atualizado') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($categorias->count() == 0)
        <h2 class="text-center">@lang('categories.empty')</h2>
        <div class="espacos"></div>
        <h2 class="text-center page-title">
            <a href="{{route('categoriasCreate')}}">
                @lang('categories.newCategory') <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </h2>
        <div class="espacos"></div>
        <div class="espacos"></div>
        <div class="espacos"></div>
    @else
        <h2 class="page-title text-center">@lang('categories.title')</h2>
        <h2 class="text-center">
            <small><a href="{{route('categoriasViewCreate')}}">
                    <i class="fa fa-plus"></i> @lang('categories.create')
                </a> - @lang("categories.total"): {{$categorias->count()}}
            </small>
        </h2>
        <div class="espacos"></div>
        <div class="espacos"></div>
        <div class="row">
            <div class="container">
                @foreach($categorias as $categoria)
                    <div class="col-md-3 col-lg-3">
                        <div data-toggle="modal" data-target="#{{md5($categoria->nome)}}" class="box-users" style="cursor:pointer;background-color:{{$categoria->color}}">
                            <h3>{{$categoria->nome}}</h3>
                            <ul>
                                <li>@lang('categories.totalFlags')<strong>{{$categoria->challenge()->where('categories_id',$categoria->id)->count()}}</strong></li>
                                <li>@lang('categories.totalPoints')<strong>{{$categoria->challenge()->where('categories_id',$categoria->id)->sum('pontos')}}</strong></li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @foreach($categorias as $categoria)
        <div id="{{md5($categoria->nome)}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$categoria->nome}}</h4>
                    </div>
                    <div class="modal-body">
                        <p class="paragrafos">
                            {{$categoria->descricao}}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{url("/categorias/deletar/$categoria->nome/$categoria->id")}}" method="POST">
                            {{ csrf_field() }}
                            <a href="{{url(getenv('ADMIN_ROUTE', true)."/categorias/editar/$categoria->nome/$categoria->id")}}"
                               class="button button-blue">Editar</a>
                            <input type="submit" class="button button-red" value="Deletar"/>
                            <button type="button" class="button button-black" data-dismiss="modal" value="">Fechar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection