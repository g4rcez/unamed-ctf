@extends('layout.user')
@section('title', 'UnameCTF - ScoreBoard')
@section('score', 'active')
@section('conteudo')
  <script src="{!!asset('assets/js/exporting.js')!!}"></script>
  <script src='{!!asset('assets/js/highcharts.src.js')!!}'></script>
  <div class="container">
    <div class="row">
      <header>
        <h2 class="page-title"><i class="fa fa-users" aria-hidden="true"></i>
          {{ $equipe->nome or 'Nome da Equipe'}}</h2>
      </header>
      <div class="espacos"></div>
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="row">
              <div id="container"></div>
          </div>
          <script>
              Highcharts.chart('container', {
                colors: ['#224a8c'],
                  chart: {
                    backgroundColor: {
                       linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                       stops: [
                          [0, '#121212'],
                          [1, '#000']
                       ]
                    },
                      plotBorderColor: '#fff',
                      type: 'bar',
                      shadow: true,
                  },
                  title: {
                    style: {
                      color: '#fff',
                      fontSize: '20px'
                    },
                    text: 'Quadro da Equipe',
                  },
                  xAxis: {
                    gridLineColor: '#707073',
                    labels: {
                			style: {
                				color: '#E0E0E3'
                			}
                		},
                    @php $categories = ['Misc', 'Reverse', 'WebXploitation','Criptografia', 'Forense', 'Network'] @endphp
                      categories: [ @foreach ($categories as $category) {!! "'".$category."'," !!} @endforeach ],
                      lineColor: '#707073',
                  		minorGridLineColor: '#505053',
                  		tickColor: '#707073',
                  		title: {
                  			style: {
                  				color: '#A0A0A3'
                  			}
                  		}
                  },
                  yAxis: {
                      min: 0,
                      title: {
                          text: 'Flags',
                          align: 'center'
                      },
                      gridLineColor: '#707073',
                  		labels: {
                  			style: {
                  				color: '#E0E0E3'
                  			}
                  		},
                  		lineColor: '#707073',
                  		minorGridLineColor: '#505053',
                  		tickColor: '#707073',
                  		tickWidth: 0,
                  		title: {
                        text: 'Total de Flags do time',
                  			style: {
                  				color: '#fff'
                  			}
                  		}
                  },
                  tooltip: {
                      valueSuffix: ' Flags',
                  		style: {
                  			color: '#121212'
                  		}
                  },
                  plotOptions: {
                      bar: {
                          dataLabels: {
                              enabled: true
                          }
                      }
                  },
                  credits: {
                      enabled: false
                  },
                  series: [{
                    name: "{!! $equipe->nome or '#N/A' !!}",
                    @php
                      $points = ['79', '80', '50','70', '99', '90']
                    @endphp
                    data: [@foreach ($points as $point) {!! $point.',' !!} @endforeach],
                  }]
              });
          </script>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-6">
          <h2>Membros da Equipe</h2>
          <div class="espacos"></div>
          <div class="row">
            @for ($i=0; $i < 5; $i++)
            <div class="col-md-12 col-lg-12">
              <img src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png" width="64px" style="float:left;background:#aaa;margin-right:10px">
              <h4>Membro: {{$i}}</h4>
              <h4>Pontos: {{rand(0,300)}}</h4>
              <div class="espacos"></div>
            </div>
            @endfor
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <h2>Dados da Equipe</h2>
          <div class="espacos"></div>
          <h3>- Classificação:
            <strong>{{ $equipe->ranking or '#N/A'}}</strong>
          </h3>
          <h3>- Tag:
            <strong>{{ $equipe->tag or '#TAG'}}</strong>
          </h3>
          <h3>- Total de Flags:
            <strong>{{ $equipe->flags or '#FLAG'}}</strong>
          </h3>
        </div>
      </div>
    </div>
  </div>
@endsection
