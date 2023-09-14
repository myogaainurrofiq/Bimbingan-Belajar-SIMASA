@extends('layouts.backend.app')

@section('title')
    Data Kelas
@endsection

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <div class="alert-body">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        </div>
    @endif

    <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2> Data Kelas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <section>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <div class="float-start">
                                        <h4>Data Kelas</h4>
                                    </div>
                                </div>
                                <div class="card-datatable">
                                    <table class="dt-responsive table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>No</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Ruangan</th>
                                                <th>Mentor</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kelas as $key => $item)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$item->mapel}}</td>
                                                    <td>{{$item->hari}}</td>
                                                    <td>{{$item->jam_mulai}} - {{$item->jam_selesai}}</td>
                                                    <td>{{$item->ruangan}}</td>
                                                    <td>{{$item->mentor->name}}</td>
                                                    <td>
                                                        <a href="{{route('guru-kelas.show', $item->id)}}" class="btn btn-success btn-sm">Murid</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
  </div>
@endsection
