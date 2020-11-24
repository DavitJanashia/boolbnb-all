@extends('layouts.main-layout')
@section('content')



  <section id="section">

    <div class="container">
      <div class="col-6 mb-5 mt-5">

    <div id="views-chart" class="chart" style="margin-top: 150px; background-color: white;position: relative; height:60vh; width:80vw">

                <canvas id="myChart" > </canvas>

        <div id="chart-prev" style=" cursor:pointer; position: absolute; top:100%;left:0; z-index:3;"><i class="fas fa-chevron-circle-left" style="font-size:30px;"></i> </div>
        <div id="chart-next" style=" cursor:pointer; position: absolute; top:100%; right:0;z-index:3;"><i class="fas fa-chevron-circle-right" style="font-size:30px;"></i> </div>

    </div>

    <div id="message-chart" class="chart" style="background-color: white; position: relative; height:40vh; width:80vw">

                  <canvas id="mymessageChart" ></canvas>

    </div>


  </div>

  </div>

  </section>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

  <script src="{{asset('js/mychart.js')}}" charset="utf-8"></script>


@endsection
