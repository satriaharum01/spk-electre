<?php
use App\Http\helpers\Formula;

?>


<div class="col-md-6 col-lg-6">
    <div class="form-group">
    <label class="mb-2">{{ $row->kode }}</label>
    <select name="kriteria[{{ $row->id }}][nilai]" id="{{ $row->kode }}" class="form-control mb-2">
        <option value="0" selected disabled>-- Pilih {{ $row->nama_kriteria }} --</option>
        
        @foreach($row->subKriteria as $dow)
            <option value="{{ $dow->nilai }}" 
                {{ $selectedValue == $dow->nilai ? 'selected' : '' }}>
                {{ $dow->sub_kriteria }}
            </option>
        @endforeach
    </select>
    </div>
</div>