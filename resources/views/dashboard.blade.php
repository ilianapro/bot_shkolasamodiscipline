@extends('layouts.admin')

@section('content')
          <!-- Page Header-->
          <header class="page-header">
                <div class="container-fluid">
                  <h2 class="no-margin-bottom">Главная</h2>
                </div>
              </header>
              <!-- Dashboard Counts Section-->
              <section class="dashboard-counts no-padding-bottom">
                <div class="container-fluid">
                  <div class="row bg-white has-shadow">
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                      <div class="item d-flex align-items-center">
                        <div class="icon bg-violet"><i class="icon-user"></i></div>
                        <div class="title"><span>Участники</span>
                          <div class="progress">
                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                          </div>
                        </div>
                        <div class="number"><strong>{{ $data['participantsAll'] }}</strong></div>
                      </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                      <div class="item d-flex align-items-center">
                        <div class="icon bg-red"><i class="icon-padnote"></i></div>
                        <div class="title"><span>Активные</span>
                          <div class="progress">
                            <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                          </div>
                        </div>
                        <div class="number"><strong>{{ $data['participantsActive'] }}</strong></div>
                      </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                      <div class="item d-flex align-items-center">
                        <div class="icon bg-green"><i class="icon-bill"></i></div>
                        <div class="title"><span>Неактивные</span>
                          <div class="progress">
                            <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                          </div>
                        </div>
                        <div class="number"><strong>{{ $data['participantsInActive'] }}</strong></div>
                      </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                      <div class="item d-flex align-items-center">
                        <div class="icon bg-orange"><i class="icon-check"></i></div>
                        <div class="title"><span>Мотивашки</span>
                          <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                          </div>
                        </div>
                        <div class="number"><strong>{{ $data['motivators']->count() }}</strong></div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- Client Section-->
              <section class="client">
                <div class="container-fluid">
                  <div class="row">
                    <!-- Work Amount  -->
                    <div class="col-lg-4">
                      <div class="work-amount card">
                        <div class="card-body">
                          <h3>Отчет 1</h3><small>статистика сдавших утренний отчет<br>{{ env('REPORT1_FROM') }}:00 - {{ env('REPORT1_TO') }}:00</small>
                          <div class="chart text-center">
                            <canvas id="report-chart1"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Client Profile -->
                    <div class="col-lg-4">
                      <div class="work-amount card">
                        <div class="card-body">
                          <h3>Отчет 2</h3><small>Статистика сдающих отчет 2<br>{{ env('REPORT2_FROM') }}:00 - {{ env('REPORT2_TO') }}:00</small>
                          <div class="chart text-center">
                              <canvas id="report-chart2"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Total Overdue             -->
                    <div class="col-lg-4">
                      <div class="work-amount card">
                        <div class="card-body">
                          <h3>Отчет 3</h3><small>статика пользователей сдавших последний отчет<br>{{ env('REPORT3_FROM') }}:00 - {{ env('REPORT3_TO') }}:00</small>
                          <div class="chart text-center">
                              <canvas id="report-chart3"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
@endsection

@section('jscript')
    <!-- Dashboard C H A R T S -->
    <script>
            /* Report Chart 1 */
            var ctx = document.getElementById('report-chart1').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Сдавшие', 'Несдавшие'],
                    datasets: [{
                        label: 'Отчет 1',
                        backgroundColor: ['#ff8000', '#003c7c'],
                        data: [{{ $data['report1'] }}, {{ $data['participantsActive'] }}]
                    }]
                },
                options: {
                  animation: {animateScale: true}
                }
            });
            /* Report Chart 2 */
            var ctx = document.getElementById('report-chart2').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Сдавшие', 'Несдавшие'],
                    datasets: [{
                        label: 'Отчет 1',
                        backgroundColor: ['#ff8000', '#003c7c'],
                        data: [{{ $data['report2'] }}, {{ $data['participantsActive'] }}]
                    }]
                },
                options: {
                  animation: {animateScale: true}
                }
            });
            /* Report Chart 3 */
            var ctx = document.getElementById('report-chart3').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Сдавшие', 'Несдавшие'],
                    datasets: [{
                        label: 'Отчет 1',
                        backgroundColor: ['#ff8000', '#003c7c'],
                        data: [{{ $data['report3'] }}, {{ $data['participantsActive'] }}]
                    }]
                },
                options: {
                  animation: {animateScale: true}
                }
            });
          </script>
@endsection