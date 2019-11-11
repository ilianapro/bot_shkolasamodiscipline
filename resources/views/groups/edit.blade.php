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
                        <form action="{{ route('groups.update', $data['group']->id) }}" method="post">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nameInput">Название группы</label>
                                <input type="text" class="form-control" name="name" id="nameInput" aria-describedby="nameHelp" placeholder="Введите название группы" value="{{$data['group']->name}}">
                                <small id="nameHelp" class="form-text text-muted">Название группы</small>
                            </div>
                            <div class="form-group">
                              <label for="activeSelect">Активный</label>
                              <select class="form-control" id="activeSelect" name="status">
                                      <option value="1" {{ $data['group']->status ? "selected" : "" }}>Да</option>      
                                      <option value="0" {{ !$data['group']->status ? "selected" : "" }}>Нет</option>      
                              </select>
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

