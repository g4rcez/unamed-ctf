@extends('layout.admin')
@section('challs','active')
@section('titulo', getenv('CTF_NAME', true)." - Challenges")
@section('conteudo')
    @if (Session::has('atualizado'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-info alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>{{ Session::get('atualizado') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12 col-lg-12">
        <div class="espacos"></div>
        <div class="espacos"></div>
        <div class="grid center-block text-center text-capitalize">
            @if($challenges->count() == 0)
                <h2 class="text-center">@lang('challenges.empty')</h2>
                <div class="espacos"></div>
                <h2 class="text-center page-title">
                    <a href="{{route('createChall')}}">
                        @lang('challenges.newChallenge') <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </h2>
                <div class="espacos"></div>
                <div class="espacos"></div>
                <div class="espacos"></div>
            @else
                <h2 class="text-center page-title">
                    <i class="fa fa-flag" aria-hidden="true"></i> @lang("admin.challsTitle")</h2>
                <h4 class="text-center">
                    <a href="{{route('createChall')}}">
                        @lang("admin.challsCreateLink") <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </h4>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <h3 class="text-left">@lang('admin.challsCount'){{$challenges->count()}}</h3>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <h3 class="text-right">@lang('admin.challsPoints'){{$challenges->sum("pontos")}}</h3>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <hr>
                </div>
                <div class="row tc center">
                    <div class="espacos"></div>
                    <div class="espacos"></div>
                    <div class="grid center-block text-center text-capitalize">
                        @foreach($challenges as $challenge)
                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 grid-item mb7 tc center grow"
                                 data-toggle="modal" data-target="#{{md5($challenge->nome)}}">
                                <div class="chall-box" style="background:{{$challenge->category->color}}"
                                     onMouseOver="this.style.background='{{$challenge->category->color}}90'"
                                     onMouseOut="this.style.background='{{$challenge->category->color}}'">
                                    <h3><i class="fa fa-flag" aria-hidden="true"></i> {{$challenge->nome}}</h3>
                                    <h5>
                                        <strong class="white-40"><i class="fa fa-user"></i> {{$challenge->autor}}
                                        </strong>
                                    </h5>
                                    <h4>
                                        <small class="mr2">{{$challenge->category->nome}}</small>
                                        <small class="ml2">{{$challenge->pontos}}</small>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="espacos"></div>
    <div class="espacos"></div>
    @foreach($challenges as $challenge)
        <div id="{{md5($challenge->nome)}}" class="modal fade" role="dialog">
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
                        @if(!empty($maestria['skills']))
                            {{$maestrias->count()}}
                            @lang('challenges.skillsNeeded')
                            <ul>
                                @foreach($maestrias as $maestria)
                                    @foreach($maestria['skills'] as $skills)
                                        @if($skills->pivot->challenges_id == $challenge->id)
                                            <li>{{ $skills->maestria }}</li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        @endisset
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="espacos"></div>
                                    <form class="form-inline"
                                          action="{{url(getenv("ADMIN_ROUTE",true).'/'.getenv('CHALLS_ROUTE', true).'/'.getenv('DELETE_ROUTE', true).'/'.$challenge->id)}}"
                                          method="POST">
                                        {{csrf_field()}}
                                        <a href="{{url(getenv("ADMIN_ROUTE",true).'/'.getenv('CHALLS_ROUTE', true).'/'.getenv('EDIT_ROUTE', true).'/'.$challenge->id)}}"
                                           class="button button-blue">Editar</a>
                                        <input type="submit" class="button button-red" value="Deletar"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button button-black" data-dismiss="modal" value="">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>
        <script>
            $('.grid').masonry({
                itemSelector: '.grid-item',
                columnWidth: 0,
                horizontalOrder: true,
                initLayout: true,
                fitWidth: false,
                resize: true,
                percentPosition: true
            });
        </script>
    @endforeach
@endsection
