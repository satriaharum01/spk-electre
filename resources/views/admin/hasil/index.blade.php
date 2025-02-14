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
      <div class="border-bottom d-flex justify-content-start mb-3 pb-2 tile-body">
        <div class="tile-title mb-0">
        {{$sub_title}}
        </div>  
      </div>
      <div class="tile-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="data-width" width="100%">
            <thead>
              <tr>
                <th style="text-align: center" width="10%">No</th>
                <th>Kode</th>
                <th>Nama Alternatif</th>
                <th>Nilai</th>
                <th>Rank</th>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.hasil.data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, class: 'text-center' },
                    { data: 'kode', name: 'kode', class: 'text-center' },
                    { data: 'nama', name: 'nama', class: 'text-center' },
                    { data: 'total_nilai', name: 'total_nilai', class: 'text-center' },
                    { data: 'rank', name: 'rank', class: 'text-center' }
                ]
            });
  });

</script>
@endsection