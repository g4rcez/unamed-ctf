@extends('layout.user')
@section('challs','active')
@section('titulo',getenv('CTF_NAME',true).' - Challenges')
@section('conteudo')
    <script type="text/javascript" src="{{asset('assets/js/bootstrap-show-password.min.js')}}"></script>
    @if (Session::has('flagCaptured'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @lang("challenges.newFlag")<strong>{{ Session::get('flagCaptured') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Session::has('jaCapturado'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-info alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @lang("challenges.flagCaptured")<strong>{{ Session::get('jaCapturado') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Session::has('naoCerto'))
        <div class="row">
            <div class="container">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @lang("challenges.wrong") <strong>
                            @if(Session::get('naoCerto') != 'null')
                                @lang("challenges.wrong")<strong>{{ Session::get('naoCerto') }}</strong>
                            @endif
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($challenges->count() === 0)
        <h2 class="text-center">
            @lang('challenges.empty')
            <div class="espacos"></div>
            <img class="img-responsive" width="30%" src="http://cdn.onlinewebfonts.com/svg/img_2555.png"
                 style="margin: auto;"/>
        </h2>
    @else
        <div class="col-md-12 col-lg-12">
            <h2 class="text-center page-title">
                <i class="fa fa-flag" aria-hidden="true"></i> Capture the Flags</h2>
            <div class="espacos"></div>
            <h4 class="text-center">
                {{Auth::user()->nickname}}: {{$pontos->sum('pontos')}} pontos -
                <a data-toggle="collapse" data-target="#submitFlag">Submeter Flag</a> -
                <a data-toggle="collapse" data-target="#pesquisar">Pesquisar</a>
                <div class="espacos"></div>
                <div class='collapse' id="submitFlag">
                    <div class="espacos"></div>
                    <form class="form-inline" action="{{url(getenv('CHALLS_ROUTE',true)."/submit")}}" method="POST">
                        {{csrf_field()}}
                        <input id="flag" class="form-control input" type="text" name="flag"
                               value="{{ old('flag') }}" required autofocus placeholder="Flag...">
                        @if ($errors->has('flag'))
                            <span class="help-block">
          <strong>{{ $errors->first('flag') }}</strong>
        </span>
                        @endif
                        <input type="submit" class="button button-black" value="Capture"/>
                    </form>
                </div>
                <div class='collapse' id="pesquisar">
                    <div class="espacos"></div>
                    <div class="tc">Exibir somente challenges de:</div>
                    <div class="espacos"></div>
                    @foreach($categories as $category)
                        <a href="{{url(getenv('CHALLS_ROUTE', true).'/search/'.$category->id)}}"
                           class="mr2 ml2 mb2">{{$category->nome}}</a>
                    @endforeach<br/>
                    <a class="mt3" href="{{url(getenv('CHALLS_ROUTE',true))}}">Exibir todos</a>
                </div>
            </h4>
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
                <div class="espacos"></div>
                <div class="espacos"></div>
                <div class="espacos"></div>
                <div class="grid center-block text-center text-capitalize">
                    @foreach($challenges as $challenge)
                        <div class="col-md-3 col-lg-3 grid-item" data-toggle="modal"
                             data-target="#{{md5($challenge->nome)}}">
                            <div class="chall-box grow" style="background:{{$challenge->category->color}}"
                                 onMouseOver="this.style.background='{{$challenge->category->color}}80'"
                                 onMouseOut="this.style.background='{{$challenge->category->color}}'">
                                <h3>
                                    <i class="fa fa-flag" aria-hidden="true"></i> {{$challenge->nome}}</h3>
                                <h5>
                                    <strong class="white-40"><i class="fa fa-user"></i> {{$challenge->autor}}
                                    </strong>
                                </h5>
                                <h4>
                                    <small class="mr2">{{$challenge->category->nome}}</small>
                                    <small class="ml2">{{$challenge->pontos}}</small>
                                </h4>
                                <small style="margin:65%;" class="text-right white-40">
                                    @if($pontos->where('nome',$challenge->nome)->count() > 0)
                                        <i class="fa fa-flag" aria-hidden="true"></i> Já Resolvido
                                    @endif
                                </small>
                            </div>
                            <div class="espacos"></div>
                        </div>
                    @endforeach
                </div>
                @endif
                @foreach($challenges as $challenge)
                    <div id="{{md5($challenge->nome)}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{$challenge->nome}}</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="paragrafos">{{str_replace_array('\n', '<br/>', $challenge->description)}}</p>
                                    <div class="espacos"></div>
                                    @if($challenge->skills()->get() != [])
                                        @lang('challenges.skillsNeeded')
                                        <ul>
                                            @foreach($challenge->skills()->get() as $maestria)
                                                <li>{{ $maestria->name }}</li>
                                            @endforeach
                                        </ul>
                                    @endisset
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <form class="form-inline"
                                                      action="{{url(getenv('CHALLS_ROUTE', true)."/submitFlag")}}"
                                                      method="POST">
                                                    {{csrf_field()}}
                                                    <label for="flag" class="control-label">Flag: </label>
                                                    <div class="input-group">
                                                        <input type="hidden" name="nome" value="{{$challenge->nome}}"/>
                                                        <input id="flag" class="form-control input"
                                                               name="flag"
                                                               value="{{ old('flag') }}" required autofocus
                                                               placeholder="{{getenv('CTF_NAME', true).'{hello_world}'}}"
                                                               size=40>
                                                        @if ($errors->has('flag'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('flag') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <input type="submit" class="button button-black" value="Capture"/>
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
            </div>
        </div>
        @endforeach
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
@endsection
