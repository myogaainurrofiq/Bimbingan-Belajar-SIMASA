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
    <div class="content-detached content-left">
        <div class="content-body">
            <div class="blog-list-wrapper">
                <div class="row">
                    @foreach ($kelas as $item)
                    <div class="col-md-3 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                <a href="#" class="blog-title-truncate text-body-heading">{{$item->kelas->mapel}}</a>
                                </h4>
                                <div class="media">
                                    <div class="media-body">
                                        <small class="text-muted mr-25">Hari</small>
                                        <small><a href="javascript:void(0);" class="text-body">{{$item->kelas->hari}}</a></small>
                                        <span class="text-muted ml-50 mr-25">|</span>
                                        <small class="text-muted">Jam</small>
                                            <small><a href="javascript:void(0);" class="text-body">{{$item->kelas->jam_mulai}} - {{$item->kelas->jam_selesai}}</a></small>
                                    </div>
                                </div>
                                <div class="my-1 py-25">
                                    <a href="javascript:void(0);">
                                        <div class="badge badge-pill badge-light-info mr-50">{{@$item->kelas->ruangan}}</div>
                                    </a>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#">
                                        <div class="d-flex align-items-center">
                                            <span class="text-body font-weight-bold">Mentor : {{$item->kelas->mentor->name}}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
