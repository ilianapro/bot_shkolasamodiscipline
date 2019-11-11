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
                                          <th>ФИО</th>
                                          <th>Имя пользователя</th>
                                          <th>Номер телефона</th>
                                          <th>Статус</th>
                                          <th>Группа</th>
                                          <th>Updated At</th>
                                          <th>Действия</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    @foreach ($data['reporters'] as $key => $reporter)
                                        <tr>
                                          <th scope="row">{{ ++$key }}</th>
                                          <td>{{ $reporter->leader ? "⭐" : ""}}</td>
                                          <td>{{ $reporter->user_id}}</td>
                                          <td>{{ $reporter->name}}</td>
                                          <td>{{ $reporter->username}}</td>
                                          <td>{{ $reporter->phone}}</td>
                                          <td class="text-center"><i class="fas fa-2x fa-{{$reporter->status ? "check text-success" : "times text-danger" }}"></i></td>
                                          <td>{{ $reporter->group}}</td>
                                          <td>{{ $reporter->updated_at}}</td>
                                          <td><a href="{{ route('reporters.edit', $reporter->id) }}" class="btn btn-success"><i class="far fa-edit"></i></a></td>
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

