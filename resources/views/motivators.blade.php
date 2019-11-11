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
                                          <th>Текст мотивации</th>
                                          <th>Имя</th>
                                          <th>Updated At</th>
                                          <th>Действия</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    @foreach ($data['motivators'] as $key => $motivator)
                                        <tr>
                                          <th scope="row">{{ ++$key }}</th>
                                          <td>{{ $motivator->motivation}}</td>
                                          <td>{{ $motivator->participant}}</td>
                                          <td>{{ $motivator->updated_at}}</td>
                                          <td><a href="{{ route('motivators.edit', $motivator->id) }}" class="btn btn-success"><i class="far fa-edit"></i></a></td>
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

