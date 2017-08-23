@extends('layout.user')
@section('perfil','active')
@section('titulo',"UnameCTF - Bem vindo ".$usuario->nickname)
@section('conteudo')
    <script src="{!!asset('/js/exporting.js')!!}"></script>
    <script src='{!!asset('/js/highcharts.src.js')!!}'></script>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <header>
                    <h2><i class="fa fa-newspaper-o" aria-hidden="true"></i> Painel do {!! $usuario->nickname !!}</h2>
                    <div class="espacos"></div>
                </header>
                <section class="row">
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xs-12">
                        <div class="card">
                            <img class="card-img-top"
                                 src="https://ae01.alicdn.com/kf/HTB1NEkPPFXXXXcfXXXXq6xXFXXXD/BROSHOO-2PCS-LOT-Car-styling-Waterproof-Reflection-Vinyl-Sticker-Anonymous-Mask-Sexy-Man-Strange-Smiley-Head.jpg"
                                 class="img-responsive">
                            <div class="card-block">
                                <figure class="profile">
                                    <img src="https://ae01.alicdn.com/kf/HTB1NEkPPFXXXXcfXXXXq6xXFXXXD/BROSHOO-2PCS-LOT-Car-styling-Waterproof-Reflection-Vinyl-Sticker-Anonymous-Mask-Sexy-Man-Strange-Smiley-Head.jpg"
                                         class="profile-avatar" alt="avatar for user">
                                </figure>
                                <h4 class="card-title mt-3">{!! $usuario->nickname !!}</h4>
                                <div class="card-text" style="color:#fff">
                                    @for($i=0; $i<10; $i++)
                                        <span class="sticker sticker-blue" style="font-size:1em; margin-bottom: 5px;">#Forense</span>
                                    @endfor
                                </div>
                            </div>
                            <div class="card-footer">
                                Nome do Time: Time
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-9 col-lg-9 col-xs-12">
                        <h2>Estátisticas <i class="fa fa-bar-chart" aria-hidden="true"></i></h2>
                        <div class="row">
                            <div id="container1"></div>
                        </div>
                </section>
                {{-- Grafico 1 --}}
                <script>
                    Highcharts.chart('container1', {
                        chart: {
                            backgroundColor: '#121212',
                            type: 'bar',
                        },
                        title: {
                            style: { "color": "#fff" },
                            text: 'Histório de Flags',
                        },
                        xAxis: {
                            categories: ['Forense', 'Reverse', 'WebXploitation', 'Criptografia  '],
                            title: {
                                style: { "color": "#fff" },
                                text: null,
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Flags',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' flags'
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: false
                                }
                            }
                        },
                        credits: {
                            enabled: true
                        },
                        series: [{
                            name: "{!! $usuario->nickname !!}",
                            data: [10, 14, 11, 21]
                        }]
                    });
                </script>
                </section>
            </div>
        </div>
    </div>
@endsection
