@extends('layouts.backend.app')

@section('title')
    Detail Calon Siswa
@endsection

@section('content')
<style>
  .hidden {
    display: none
  }
</style>
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2>Form Pendaftaran Savaana Courses</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
              <div class="alert alert-danger {{@$murid->berkas->kartu_keluarga == NULL ? 'hidden' : ''}}" role="alert">
                    <div class="alert-body">
                        <strong>Info:</strong> Data Calon Murid Belum Lengkap !
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action=" {{route('data-murid.update',$murid->id)}} " method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h4>Data Murid</h4> <br>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value=" {{$murid->name}} " placeholder="Nama Lengkap" disabled />
                                        @error('name')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value=" {{$murid->email}}" placeholder="Email Address" disabled />
                                        @error('email')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">NIS</label>
                                        <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" value=" {{$murid->muridDetail->nis}} " />
                                        @error('nis')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">NP</label>
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value=" {{$murid->muridDetail->nisn}} " />
                                        @error('nisn')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Tempat Lahir</label>
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value=" {{$murid->muridDetail->tempat_lahir}} " disabled/>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Tanggal Lahir</label>
                                        <input type="text" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value=" {{$murid->muridDetail->tgl_lahir}} " disabled/>
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">No Telp</label>
                                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value=" {{$murid->muridDetail->telp}} "disabled/>
                                        @error('telp')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">No WhatsApp</label>
                                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value=" {{$murid->muridDetail->whatsapp}} " disabled/>
                                        @error('whatsapp')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Agama</label>
                                        <select name="agama" class="form-control @error('agama') is-invalid @enderror" disabled>
                                            <option value="">-- Pilih --</option>
                                            <option value="Islam" {{$murid->muridDetail->agama == 'Islam' ? 'selected' : ''}}>Islam</option>
                                            <option value="Kristen Katolik" {{$murid->muridDetail->agama == 'Kristen Katolik' ? 'selected' : ''}}>Kristen Katolik</option>
                                            <option value="Kristen Protestan" {{$murid->muridDetail->agama == 'Kristen Protestan' ? 'selected' : ''}}>Kristen Protestan</option>
                                            <option value="Hindu" {{$murid->muridDetail->agama == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                                            <option value="Budha" {{$murid->muridDetail->agama == 'Budha' ? 'selected' : ''}}>Budha</option>
                                            <option value="Konghucu" {{$murid->muridDetail->agama == 'Konghucu' ? 'selected' : ''}}>Konghucu</option>
                                        </select>
                                        @error('agama')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Asal Sekolah</label>
                                        <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" name="asal_sekolah" value=" {{$murid->muridDetail->asal_sekolah}} " disabled/>
                                        @error('asal_sekolah')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="basicInput">Alamat Lengkap</label>
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="30" rows="3" disabled> {{$murid->muridDetail->alamat}}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div> <br>
                     
                            <button class="btn btn-primary" type="submit" {{@$murid->berkas->kartu_keluarga == NULL && @$murid->berkas != null  ? 'enabled' : ''}} >Terima Murid</button>
                            <a href="{{route('data-murid.index')}}" class="btn btn-warning">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
