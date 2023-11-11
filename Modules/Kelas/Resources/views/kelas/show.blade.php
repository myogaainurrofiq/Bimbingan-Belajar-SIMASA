@extends('layouts.backend.app')

@section('title')
   Detail Kelas
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
                        <div class="float-start">
                            <h4>Detail Kelas</h4>
                        </div>
                        <div class="float-end">
                           <a type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="false" data-target="#addMurid"> Tambah Murid</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Mata Pelajaran</label>
                                    <input type="text" class="form-control" value="{{$kelas->mapel}}"  readonly/>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="basicInput">Mentor</label>
                                    <input type="text" class="form-control" value="{{$kelas->mentor->name}}"  readonly/>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="basicInput">Hari</label>
                                        <input type="text" class="form-control" value="{{$kelas->hari}}"  readonly/>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="basicInput">Jam Mulai</label>
                                    <input type="text" class="form-control" value="{{$kelas->jam_mulai}}"  readonly/>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="basicInput">Jam Selesai</label>
                                    <input type="text" class="form-control" value="{{$kelas->jam_selesai}}"  readonly/>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="basicInput">Ruangan</label>
                                    <input type="text" class="form-control" value="{{$kelas->ruangan}}"  readonly/>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="basicInput">Deskripsi</label>
                                    <textarea name="desc" class="form-control" rows="3" readonly>{{$kelas->desc}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Data Murid</h4>
                            </div>
                            <div class="card-datatable">
                                <table class="dt-responsive table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th>Mentor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelasAll as $key => $item)
                                            <tr>
                                                <td></td>
                                                <td>{{$key+1}}</td>
                                                <td>{{$item->murid->name}}</td>
                                                <td>{{$item->murid->email}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>{{$item->murid->status}}</td>
                                                <td>{{$item->kelas->mentor->name}}</td>
                                                <td>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ url('backend-kelas/delete-murid', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                    </form>
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

        <div class="disabled-backdrop-ex">
          <!-- Modal -->
          <div class="modal fade text-left modal-primary" id="addMurid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel4">Tambah Murid | Kelas {{$kelas->mapel}} </h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <form action=" {{url('backend-kelas/tambah-murid')}} " method="post">
                          @csrf
                          <div class="col-12">
                              <div class="form-group">
                                    <input type="text" name="kelas_id" value="{{$kelas->id}}" hidden>
                                  <select name="murid_id" class="select2 form-control @error('murid_id') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($murid as $item)
                                      <option value=" {{$item->id}} "> {{$item->name}} </option>
                                    @endforeach
                                  </select>
                                  @error('murid_id')
                                      <div class="invalid-feedback">
                                      <strong>{{ $message }}</strong>
                                      </div>
                                  @enderror
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Tambah</button>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
      @if (count($errors) > 0)
          $('#addMurd').modal('show');
      @endif
    </script>
@endsection
