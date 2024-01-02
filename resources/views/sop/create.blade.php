@extends('templates.default')

@php
    $title = "Tambah Data SOP Data Center";
    $pretitle ="Data SOP";
@endphp

@section('content')

<div class="card">
        <div class="card-body">
            <form action="{{ route('sop.store')}}" class="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" 
                    class= "form-control 
                    @error('nama')
                        is-invalid
                    @enderror" 
                    placeholder="Tulis Nama" value="{{ old('nama')}}">
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
            </div>
           
            <div class="mb-3">
                <label class="form-label">PDF</label>
                <input type="file" name="pdf" 
                class="form-control @error('pdf')
                        is-invalid
                    @enderror" 
                    placeholder="Tulis Alamat" value="{{ old('pdf')}}">
                    @error('pdf')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
            </div>

            <div class="mb-3">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
            </form>
        </div>    
    </div>

@endsection