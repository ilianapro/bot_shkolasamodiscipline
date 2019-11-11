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
                             <div class="table-responsive">                       
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Лидер</th>
                                          <th>Telegram ID</th>
                                          <th>Фамилия</th>
                                          <th>Имя</th>
                                          <th>Имя пользователя</th>
                                          <th>Номер телефона</th>
                                          <th>Группа</th>
                                          <th>Updated At</th>
                                          <th>Действия</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    @foreach ($data['participants'] as $key => $participant)
                                        <tr>
                                          <th scope="row">{{ ++$key }}</th>
                                          <td>{{ $participant->leader ? "⭐" : ""}}</td>
                                          <td>{{ $participant->user_id}}</td>
                                          <td>{{ $participant->last_name}}</td>
                                          <td>{{ $participant->first_name}}</td>
                                          <td>{{ $participant->username}}</td>
                                          <td>{{ $participant->phone}}</td>
                                          <td>{{ $participant->group->name}}</td>
                                          <td>{{ $participant->updated_at}}</td>
                                          <td><a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-success"><i class="far fa-edit"></i></a></td>
                                        </tr>
                                    @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                        </div>
                      </div>
                      </div>
                    </div>
                </div>
              </section>
@endsection

