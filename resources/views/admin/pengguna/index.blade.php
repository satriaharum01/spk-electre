@extends('template.master')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-primary btn-add pull-right" data-toggle="modal" data-target="#compose"><i class="mdi mdi-plus"></i> Tambah Data</button>
        <h3 class="card-title">{{$title}}</h3>
        <div class="table-responsive pt-5">
          <table class="display table table-bordered table-hover" id="data-width" width="100%">
            <thead class="text-center">
              <tr>
                <th width="7%">No</th>
                <th width="20%">Nama Pengguna</th>
                <th width="25%">Email</th>
                <th>Hak Akses</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom_script')

<script>
    $(function() {
        table = $('#data-width').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: '{{url("$page/json")}}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    className: 'text-center'
                },
                {
                    data: 'email',
                    className: 'text-center'
                },
                {
                    data: 'level',
                    className: 'text-center'
                },
                {
                    data: 'id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<button type="button" class="btn btn-success btn-edit" data-id="' + data + '"><i class="fa fa-edit"></i> </button>\
                        <a class="btn btn-danger btn-hapus" data-id="' + data + '" data-handler="pengguna" href="<?= url($page.'/delete') ?>/' + data + '">\
                        <i class="fa fa-trash"></i> </a> \
					              <form id="delete-form-' + data + '-pengguna" action="<?= url($page.'/delete') ?>/' + data + '" \
                        method="GET" style="display: none;"> \
                        </form>'
                    }
                },
            ]
        });

    });


  //Button Trigger
  $("body").on("click", ".btn-add", function () {
    window.location.href = "{{route('admin.pengguna.new')}}";
  })

  $("body").on("click", ".btn-edit", function () {
    var Id = $(this).attr("data-id");
    var url = "{{ route('admin.pengguna.edit', ':id') }}".replace(':id', Id);
    window.location.href = url;
  })
</script>
@endSection