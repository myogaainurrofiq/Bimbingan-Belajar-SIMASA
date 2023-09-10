@extends('layouts.backend.app')

@section('title')
   Tambah Kelas
@endsection

@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2> Kelas</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header header-bottom">
                        <h4>Tambah Kelas</h4>
                    </div>
                    <div class="card-body">
                        <form action=" {{route('backend-kelas.store')}} " method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Mata Pelajaran</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('mapel') is-invalid @enderror" name="mapel" value=" {{old('mapel')}} " placeholder="Mata Pelajaran" required />
                                        @error('mapel')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Mentor</label>  <span class="text-danger">*</span>
                                        <select name="mentor_id" class="form-control" required>
                                            <option value="">-- Pilih Mentor --</option>
                                            @foreach ($mentor as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('mentor_id')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="basicInput">Hari</label>  <span class="text-danger">*</span>
                                         <select name="hari" class="form-control" required>
                                            <option value="">-- Pilih Hari --</option>
                                            <option value="Senin">Hari Senin</option>
                                            <option value="Selasa">Hari Selasa</option>
                                            <option value="Rabu">Hari Rabu</option>
                                            <option value="Kamis">Hari Kamis</option>
                                            <option value="Jumat">Hari Jumat</option>
                                        </select>
                                        @error('hari')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="basicInput">Jam Mulai</label>  <span class="text-danger">*</span>
                                        <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" name="jam_mulai" required/>
                                        @error('jam_mulai')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="basicInput">Jam Selesai</label>  <span class="text-danger">*</span>
                                        <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" name="jam_selesai" required/>
                                        @error('jam_selesai')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="basicInput">Ruangan</label>  <span class="text-danger">*</span>
                                        <input type="text" class="form-control @error('ruangan') is-invalid @enderror" name="ruangan" required/>
                                        @error('ruangan')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Deskripsi</label>  <span class="text-danger">*</span>
                                        <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" rows="3" required></textarea>
                                        @error('desc')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div

                            </div>
                            <button class="btn btn-primary" type="submit">Tambah</button>
                            <a href="{{url('backend-kelas')}}" class="btn btn-warning">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
