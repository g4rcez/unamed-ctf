@extends('layout.admin')
@section('home','active')
@section('titulo', "Administrador")
@section('conteudo')
  <script src="{!!asset('assets/js/exporting.js')!!}"></script>
  <script src='{!!asset('assets/js/highcharts.src.js')!!}'></script>
<h1>
  @lang('admin.titleIndex')
</h1>

<div class="row">
  <div class="col-lg-3 ">
    <div class="box" style="background-color:#114e3a">
      <h2 class="text-left" style="float:left;"><strong>{{rand(0, 9999)}}</strong></h2>
      <i class="fa fa-users text-right" aria-hidden="true" style="opacity:0.7;margin-left:60px;font-size:5em"></i>
      <h4>@lang('admin.totalUsers')</h4>
    </div>
  </div>
  <div class="col-lg-3 ">
    <div class="box" style="background-color:#313159">
      <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
      <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
      <h4>@lang('admin.challsTotal')</h4>
    </div>
  </div>
  <div class="col-lg-3 ">
    <div class="box" style="background-color:#224d19">
      <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
      <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
      <h4>@lang('admin.teamTotal')</h4>
    </div>
  </div>
  <div class="col-lg-3 ">
    <div class="box" style="background-color:#611c1c">
      <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
      <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
      <h4>@lang('admin.flagTotal')</h4>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 col-lg-8">
    <h2>Estátisticas <i class="fa fa-bar-chart" aria-hidden="true"></i></h2>
    <div class="col-lg-4 col-md-4">
      <div class="box" style="background-color:#611c1c">
        <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
        <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
        <h4>@lang('admin.flagTotal')</h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="box" style="background-color:#611c1c">
        <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
        <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
        <h4>@lang('admin.flagTotal')</h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="box" style="background-color:#611c1c">
        <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
        <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
        <h4>@lang('admin.flagTotal')</h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="box" style="background-color:#611c1c">
        <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
        <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
        <h4>@lang('admin.flagTotal')</h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="box" style="background-color:#611c1c">
        <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
        <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
        <h4>@lang('admin.flagTotal')</h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="box" style="background-color:#611c1c">
        <h2 style="float:left"><strong>{{rand(0, 999)}}</strong></h2>
        <i class="fa fa-users" aria-hidden="true" style="opacity:0.7;margin-left:20px;font-size:5em"></i>
        <h4>@lang('admin.flagTotal')</h4>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-lg-4">
    <h2>Estátisticas <i class="fa fa-bar-chart" aria-hidden="true"></i></h2>
        <div id="container"></div>
    <script>
        Highcharts.chart('container', {
            chart: {
                backgroundColor: '#09090920',
                type: 'pie',
                shadow: true,
            },
            title: {
                style: { "color": "#fff" },
                text: 'Histório de Flags',
            },
            xAxis: {
                categories: ['Forense', 'Reverse', 'WebXploitation', 'Criptografia  '],
                style: { "color": "#fff" },
                title: {
                    style: { "color": "#fff" },
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
                enabled: false
            },
            series: [{
                name: "Wtf",
                data: [10, 14, 11, 21]
            }]
        });
    </script>
  </div>
  <div class="row">
    <h2>Foda pra <small>caralho</small></h2>
  </div>
</div>
@endsection
