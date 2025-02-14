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
      <div class="tile-body">
        @foreach ($fieldTypes as $field => $type)
            @include('models.forms', ['field' => $field, 'type' => $type, 'value' => old($field, $load->$field ?? '')])
        @endforeach
      </div>
      
      <div class="tile-footer">
        <button type="reset" class="btn btn-danger btn-back" data-bs-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
        <div class="float-right">{{env('APP_NAME')}} - {{$title}}</div>
      </div>
    </div>
  </div>
</div>
<!-- akhir isi halaman -->
@endsection
@section('custom_script')
<script>
  function find_data(id){
      $.ajax({
            url: '{{ url("$page") }}/find/'+id,
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) { 
                console.log(dataResult);
                set_value(dataResult);
                console.log('Edit Data :', dataResult);
            }
        });
  }
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
          data: "jumlah",
          className: 'text-center', render: function(data){
              return '<div style="display: flex;flex-wrap: nowrap;align-content: center;justify-content: space-between;" class="px-2"><span>Rp. </span><span>'+number_format(data)+'</span></div>';
          }
        },
        {
          data: "payment_status",
          class: "text-center",render: function(data){
            if(data === 'Paid')
            {
              cls = 'btn-primary';
            }else{
              cls = 'btn-danger';
            }
          return '<button type="button" class="btn '+cls+'">'+data+'</button>'
          }
        },
        {
          data: "payment_method",
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
    kosongkan();
    jQuery("#compose-form").attr("action", "{{ url ($page) }}/save");
    jQuery("#compose .modal-title").html("Tambah {{$title}}");
    jQuery("#compose").modal("toggle");
  });

  $("body").on("click", ".btn-edit", function () {
    var Id = jQuery(this).attr("data-id");
    find_data(Id);

    jQuery("#compose-form").attr("action", '{{ url($page)}}/update/' + Id);
    jQuery("#compose .modal-title").html("Update {{$title}}");
    jQuery("#compose").modal("toggle");
  });

  $("body").on("click", ".btn-simpan", function () {
    Swal.fire("Data Disimpan!", "", "success");
  });

  function kosongkan() {
    jQuery("#compose-form input[name=appointment_id ]").val("");
    jQuery("#compose-form input[name=kode]").val("");
    jQuery("#compose-form input[name=total_amount]").val("");
    jQuery("#compose-form select[name=payment_status]").val("");
    jQuery("#compose-form select[name=payment_method]").val("");
  }
  
  function set_value(value) {
    jQuery("#compose-form input[name=appointment_id ]").val(value.appointment_id);
    jQuery("#compose-form input[name=kode]").val(value.kode);
    jQuery("#compose-form input[name=total_amount]").val(value.total_amount);
    jQuery("#compose-form select[name=payment_status]").val(value.payment_status);
    jQuery("#compose-form select[name=payment_method]").val(value.payment_method);
  }
  
  $("body").on("click", ".btn-pilih", function () {
    var Id = jQuery(this).attr("data-id");
    var kode = jQuery(this).attr("data-kode");
    jQuery("#compose-form input[name=kode]").val(kode);
    jQuery("#compose-form input[name=appointment_id]").val(Id);
    jQuery("#data-modal-appointment").modal("hide");
    jQuery("#compose").modal("toggle");
  });
</script>
@include('template.modal.appointmentjs')
@endsection