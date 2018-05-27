@extends('layout.user')
@section('titulo', getenv('CTF_NAME').'- Timeline')
@section('timeline', 'active')
@section('conteudo')
    <div class="container">
        <div class="row">
            <h2 class="text-center page-title">
                Timeline
            </h2>
            <ul class="list pl0 mt0 measure center">
                @foreach($challenges as $challenge)
                    @php
                        $firstBlood = "";
                        if($challenge['firstBlood']) $firstBlood = "First Blood"
                    @endphp
                    <li class="flex items-center lh-copy pa4 bb b--black-10 bg-dark-blue-gray mb3">
                        <img class="w2 h6 w3-ns h3-ns br-100" src="{{$challenge['users']->avatar}}"/>
                        <div class="pl3 flex-auto">
                            <span class="f2 db white">{{$challenge['challenge']}}</span>
                            <span class="f3 db">{{$challenge['users']->nickname}}
                                @isset($challenge['team'])
                                    - <strong>{{$challenge['team']['nome']}}
                                        <span class="bg-black-20 pa1">{{$challenge['team']['tag']}}</span>
                                    </strong>
                                @endisset
                            </span>
                            @if($firstBlood != "")
                                <span class="material-red f4 db tc center"><i class="fa fa-bolt"></i> {{$firstBlood}} <i
                                            class="fa fa-bolt"></i></span>
                            @endif
                        </div>
                        <div>
                            <span class="f4 hover-dark-gray">{{$challenge['resolved_at']}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
