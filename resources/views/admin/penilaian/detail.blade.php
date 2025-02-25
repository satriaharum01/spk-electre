@extends('template.master')
@section('content')
<!-- awal isi halaman -->
<div class="app-title">
  <div>
    <h1><i class="bi bi-table"></i> {{$title}}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb side">
    <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
    <li class="breadcrumb-item active"><a href="#">{{$title}}</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-title border-bottom">
      {{$sub_title}}
      </div>
      <form id="compose-form" class="" method="POST" enctype="multipart/form-data" action="{{url($action)}}">
      @csrf
        <div class="tile-body row">
        <div class="col-md-12 col-lg-12">
          <div class="form-group">
              <label class="mb-2">Nama Alternatif</label>
              <input type="text" name="nama" class="form-control mb-2" value="{{$alternatif->nama}}" readonly>
          </div>
        </div>
          @foreach($kriteria as $row)
              @include('models.formsNilai', [
                  'row' => $row, 
                  'selectedValue' => old($row->kode, $load[$row->id] ?? '')
              ])
          @endforeach
        </div>

        <div class="tile-footer">
          <button type="reset" class="btn btn-danger btn-back" data-bs-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary btn-simpan">Simpan</button>
          <div class="pull-right">{{env('APP_NAME')}} - {{$title}}</div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- akhir isi halaman -->
@endsection
@section('custom_script')
<script>
  
  $("body").on("click", ".btn-back", function () {
    window.location.href = "{{route('admin.penilaian')}}";
  })
</script>
@include('template.modal.appointmentjs')
@endsection