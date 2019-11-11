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
                        <form action="{{ route('reporters.update', $data['reporter']->id) }}" method="post">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <div class="form-group">
                                  <label for="nameInput">ФИО</label>
                                  <input type="text" class="form-control" name="name" id="nameInput" aria-describedby="nameHelp" placeholder="Введите ФИО" value="{{$data['reporter']->name}}">
                                  <small id="nameHelp" class="form-text text-muted">Фамилия, Имя и Отчество участника</small>
                                </div>
                                <div class="form-group">
                                  <label for="phoneInput">Номер телефона</label>
                                  <input type="text" class="form-control" name="phone" id="phoneInput" aria-describedby="phoneHelp" placeholder="Введите номер телефона" value="{{$data['reporter']->phone}}">
                                  <small id="phoneHelp" class="form-text text-muted">Номер мобильного телефона участника</small>
                                </div>
                                <div class="form-group">
                                  <label for="groupSelect">Статус</label>
                                  <select class="form-control" id="groupSelect" name="status">
                                    <option value="1" {{ $data['reporter']->status ? "selected" : "" }}>Активный</option>      
                                    <option value="0" {{ !$data['reporter']->status ? "selected" : "" }}>Неактивный</option>      
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="groupSelect">Группа</label>
                                    <select class="form-control" id="groupSelect" name="group">
                                    @foreach ($data['groups'] as $group)
                                        @if ($group->name == $data['reporter']->group)
                                            <option value="{{ $group->name }}" selected>{{ $group->name }}</option>      
                                        @else
                                            <option value="{{ $group->name }}">{{ $group->name }}</option>      
                                        @endif
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                    <label for="groupSelect">Лидер?</label>
                                    <select class="form-control" id="groupSelect" name="leader">
                                            <option value="1" {{ $data['reporter']->leader ? "selected" : "" }}>Да</option>      
                                            <option value="0" {{ !$data['reporter']->leader ? "selected" : "" }}>Нет</option>      
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

