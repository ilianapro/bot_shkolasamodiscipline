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
                        <form action="{{ route('participants.update', $data['participant']->id) }}" method="post">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                            <div class="form-group">
                                <label for="lastNameInput">Фамилия</label>
                                <input type="text" class="form-control" name="last_name" id="lastNameInput" aria-describedby="lastNameHelp" placeholder="Введите Фамилию" value="{{$data['participant']->last_name}}">
                                <small id="lastNameHelp" class="form-text text-muted">Фамилия участника</small>
                            </div>
                            <div class="form-group">
                                <label for="firstNameInput">Имя</label>
                                <input type="text" class="form-control" name="first_name" id="firstNameInput" aria-describedby="firstNameHelp" placeholder="Введите имя" value="{{$data['participant']->first_name}}">
                                <small id="firstNameHelp" class="form-text text-muted">Имя участника</small>
                            </div>
                            <div class="form-group">
                                <label for="phoneInput">Номер телефона</label>
                                <input type="text" class="form-control" name="phone" id="phoneInput" aria-describedby="phoneHelp" placeholder="Введите номер телефона" value="{{$data['participant']->phone}}">
                                <small id="phoneHelp" class="form-text text-muted">Номер мобильного телефона участника</small>
                            </div>
                            <div class="form-group">
                                    <label for="groupSelect">Группа</label>
                                    <select class="form-control" id="groupSelect" name="group_id">
                                    @foreach ($data['groups'] as $group)
                                        @if ($group->name == $data['participant']->group->name)
                                            <option value="{{ $group->id }}" selected>{{ $group->name }}</option>      
                                        @else
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>      
                                        @endif
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                    <label for="leaderSelect">Лидер?</label>
                                    <select class="form-control" id="leaderSelect" name="leader">
                                            <option value="1" {{ $data['participant']->leader ? "selected" : "" }}>Да</option>      
                                            <option value="0" {{ !$data['participant']->leader ? "selected" : "" }}>Нет</option>      
                                    </select>
                            </div>
                            <div class="form-group">
                                    <label for="activeSelect">Активный</label>
                                    <select class="form-control" id="activeSelect" name="status">
                                            <option value="1" {{ $data['participant']->status ? "selected" : "" }}>Да</option>      
                                            <option value="0" {{ !$data['participant']->status ? "selected" : "" }}>Нет</option>      
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

