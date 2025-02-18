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
      <div class="border-bottom d-flex justify-content-between mb-3 pb-2 tile-body">
        <div class="tile-title mb-0">
        {{$sub_title}}
        </div>  
        <button type="button" class="btn btn-danger btn-back pull-right">
          <i class="fa fa-square-caret-left"></i> Kembali
        </button>
      </div>
      <div class="tile-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="data-width" width="100%">
            <thead>
              <tr>
                <th style="text-align: center" width="10%">No</th>
                <th>Sub Kriteria</th>
                <th>Nilai</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- akhir isi halaman -->
@endsection
@section('custom_script')
<script>
  $(function () {
    let cls;
    table = $("#data-width").DataTable({
      searching: true,
      ajax: '{{ url("$page/json") }}',
      columns: [
        {
          data: "DT_RowIndex",
          name: "DT_RowIndex",
          class: "text-center",
        },
        {
          data: "sub_kriteria",
          class: "text-center",
        },
        {
          data: "nilai",
          class: "text-center",
        },
      ],
    });
  });

  //Button Triger
  $("body").on("click", ".btn-back", function () {
    window.location.href = "{{route('mahasiswa.kriteria')}}";
  })
</script>
@endsection