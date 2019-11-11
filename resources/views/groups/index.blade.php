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
                            <a href="{{ route('groups.create') }}" class="btn btn-success">Создание группы</a><br><br>
                             <div class="table-responsive">                       
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Наименование</th>
                                          <th class="text-center">Кол-во участников<br>(активных)</th>
                                          <th class="text-center">Кол-во участников<br>(неактивных)</th>
                                          <th class="text-center">Статус</th>
                                          <th class="text-center">Updated At</th>
                                          <th class="text-center">Действия</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    @foreach ($data['groups'] as $key => $group)
                                    @php
                                        $groupParticipantsActive = \App\Http\Controllers\groupController::groupParticipantsActive($group->id);
                                        $groupParticipantsInActive = \App\Http\Controllers\groupController::groupParticipantsInActive($group->id);
                                    @endphp
                                        <tr>
                                          <th scope="row">{{ ++$key }}</th>
                                          <td>{{ $group->name }}</td>
                                          <td class="text-center">{{$groupParticipantsActive}}</td>
                                          <td class="text-center">{{$groupParticipantsInActive}}</td>
                                          <td class="text-center"><i class="fas fa-2x fa-{{$group->status ? "check text-success" : "times text-danger" }}"></i></td>
                                          <td class="text-center">{{ $group->updated_at}}</td>
                                          <td class="text-center">
                                              <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-success"><i class="far fa-edit"></i></a>
                                          </td>
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

