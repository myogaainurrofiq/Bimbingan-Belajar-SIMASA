@extends('layouts.backend.app')

@section('title')
    Data Buku
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
                    <h2> Data Buku</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-detached content-left">
        <div class="content-body">

            <div class="blog-list-wrapper">

                <div class="row">
                    @foreach ($book as $books)
                    <div class="col-md-4 col-12">
                        <div class="card">
                            <a href="#">
                                <img class="card-img-top img-fluid" src="{{asset('storage/images/thumbnail/' .$books->thumbnail)}}" alt="Cover Buku" style="max-height: 200px; max-weidth:100px; min-height:200px" />
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#" class="blog-title-truncate text-body-heading">{{$books->name}}</a>
                                </h4>
                                <div class="media">
                                    <div class="media-body">
                                        <small class="text-muted mr-25">Penulis</small>
                                        <small><a href="javascript:void(0);" class="text-body">{{$books->author->name}}</a></small>
                                        <span class="text-muted ml-50 mr-25">|</span>
                                        <small class="text-muted">Terbit</small>
                                            <small><a href="javascript:void(0);" class="text-body">{{$books->publication_year}}</a></small>
                                    </div>
                                </div>
                                <div class="my-1 py-25">
                                    <a href="javascript:void(0);">
                                        <div class="badge badge-pill badge-light-info mr-50">{{$books->category->name}}</div>
                                    </a>
                                </div>
                                <p class="card-text blog-content-truncate">
                                    {{$books->description}}
                                </p>
                                <hr />
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#">
                                        <div class="d-flex align-items-center">
                                            <span class="text-body font-weight-bold">{{$books->publisher->name}}</span>
                                        </div>
                                    </a>
                                    {{$books->stock}} Buku
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
