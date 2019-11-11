@extends('layouts.admin')

@section('content')
          <!-- Page Header-->
          <header class="page-header">
                <div class="container-fluid">
                  <h2 class="no-margin-bottom">{{ $data['title'] }} </h2>
                </div>
              </header>
              <!-- Dashboard Counts Section-->
              <!-- Client Section-->
              <section class="client">
                <div class="container-fluid">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="card">
                          <div class="card-body">
                        <form action="{{ route('motivators.update', $data['motivator']->id) }}" method="post">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                            <div class="form-group">
                                <label for="motivation">Текст мотивации</label>
                                <textarea class="form-control" id="motivation" rows="5" name="motivation">{{ $data['motivator']->motivation }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nameInput">ФИО</label>
                                <input type="text" class="form-control" name="participant" id="nameInput" aria-describedby="nameHelp" placeholder="Введите имя" value="{{$data['motivator']->participant}}">
                                <small id="nameHelp" class="form-text text-muted">Имя участника</small>
                            </div>
                            <button type="submit" class="btn btn-success">Обновить</button>
                        </form>
                        </div>
                      </div>
                      </div>
                    </div>
                </div>
              </section>
@endsection

