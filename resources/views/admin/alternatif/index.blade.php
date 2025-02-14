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
      <div class="border-bottom d-flex justify-content-end mb-3 pb-2 tile-body">
        <button type="button" class="btn btn-primary btn-add pull-right">
          <i class="fa fa-plus"></i> Tambah Data
        </button>
      </div>
      <div class="tile-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="data-width" width="100%">
            <thead>
              <tr>
                <th style="text-align: center" width="10%">No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th style="text-align: center" width="20%">Aksi</th>
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
          data: "kode",
          class: "text-center",
        },
        {
          data: "nama",
          class: "text-center",
        },
        {
          data: "prodi",
          class: "text-center",
        },
        {
          data: "id",
          class: "text-center",
          orderable: false,
          searchable: false,
          render: function (data, type, row) {
            return (
                '<button type="button" class="btn btn-success btn-edit" data-id="' + data +'"><i class="fa fa-edit"></i> </button>\
                <a class="btn btn-danger btn-hapus" data-id="' + data +'" data-handler="data" href="delete/'+data +'">\
                <i class="fa fa-trash"></i> </a> \
					      <form id="delete-form-' +data +'-data" action="{{ url ($page) }}/delete/'+data+'" method="GET" style="display: none;">\
                </form>'
            );
          },
        },
      ],
    });
  });

  //Button Trigger
  $("body").on("click", ".btn-add", function () {
    window.location.href = "{{route('admin.alternatif.new')}}";
  })

  $("body").on("click", ".btn-edit", function () {
    var Id = $(this).attr("data-id");
    var url = "{{ route('admin.alternatif.edit', ':id') }}".replace(':id', Id);
    window.location.href = url;
  })
</script>
@endsection