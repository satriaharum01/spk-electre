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
        <h3 class="card-title">{{$sub_title}}</h3>
      </div>
      <div class="tile-body">
        <form class="" method="POST" enctype="multipart/form-data" action="{{url($action)}}">
          @csrf
          <div class="card-body row">
            <div class="col-md-6 col-lg-3">
              <div class="form-group text-center">
                <label class="form-label">Foto</label>
                <div id="preview" class="my-2">
                  <a href="{{ asset('assets/img/faces/'.$load->faces) }}" data-lightbox="gallery">
                    <img src="{{ asset('assets/img/faces/'.$load->faces) }}" alt="Foto"
                      style="width: 100px; height: auto; margin: 5px;">
                  </a>
                </div>
                <input type="file" name="photos" id="photos" required onchange="previewImages()" accept="image/*">
                <button type="button" onclick="resetForm()" class="btn btn-danger btn-reset" hidden><i
                    class="fa fa-refresh"></i></button>

              </div>
            </div>
            <div class="col-md-6 col-lg-9 row">
              @foreach ($fieldTypes as $field => $type)
              @include('models.formProfile', ['field' => $field, 'type' => $type, 'value' => old($field, $load->$field ??
              '')])
              @endforeach
            </div>
          </div>

          <div class="tile-footer d-flex justify-content-between">
            <div>
            <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
            </div>
            <div class="float-right">{{env('APP_NAME')}} - {{$title}}</div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  function previewImages() {
    let preview = document.getElementById('preview'); // Tempat menampilkan preview
    let files = document.getElementById('photos').files; // File yang dipilih

    preview.innerHTML = ''; // Mengosongkan preview sebelumnya

    if (files) {
      Array.from(files).forEach(file => {
        let reader = new FileReader(); // Membaca file sebagai URL data
        reader.onload = function (e) {
          let img = document.createElement('img'); // Membuat elemen gambar
          img.src = e.target.result; // Menetapkan sumber gambar
          img.style.width = '100px'; // Ukuran gambar
          img.style.height = 'auto';
          img.style.margin = '5px';
          preview.appendChild(img); // Menambahkan gambar ke preview
        }
        reader.readAsDataURL(file); // Membaca file sebagai URL
      });
      $('.btn-reset').prop('hidden', false);
    }
  }

  // Fungsi untuk mereset formulir dan menghapus preview
  function resetForm() {
    let input = document.getElementById('photos'); // Input file
    let preview = document.getElementById('preview'); // Tempat preview

    input.value = ''; // Mengosongkan input file
    preview.innerHTML = '<a href="{{ asset('assets / img / faces / '.$load->faces) }}" data-lightbox="gallery">\
                                      <img src="{{ asset('assets / img / faces / '.$load->faces) }}"  alt="Foto" style="width: 100px; height: auto; margin: 5px;">\
                                    </a>'; // Mengosongkan preview

    $('.btn-reset').prop('hidden', true);
  }
</script>
@endsection