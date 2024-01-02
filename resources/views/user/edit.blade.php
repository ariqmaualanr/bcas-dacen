@extends('templates.default')

@php
    $title = "Edit Data Karyawan Data Center";
    $pretitle ="Data Karyawan";
@endphp

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('karyawan.update', $karyawan->id) }}" class="" method="post" 
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class= "form-control 
                    @error('nama')
                        is-invalid
                    @enderror" name="example-text-input"
                placeholder="Tulis Nama" value="{{ old('nama') ?? $karyawan->nama}}">
                    @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control 
                    @error('alamat')
                        is-invalid
                    @enderror" name="example-text-input"
                placeholder="Tulis Alamat" value="{{ old('alamat') ?? $karyawan->alamat}}">
                    @error('alamat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nomer Telfon</label>
                <input type="text" name="phone_number" class="form-control 
                    @error('phone_number')
                        is-invalid
                    @enderror" name="example-text-input"
                placeholder="Tulis Nomer Telfon" value="{{ old('phone_number') ?? $karyawan->phone_number}}">
                    @error('phone_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="photo" 
                class="form-control @error('photo')
                        is-invalid
                    @enderror" 
                    placeholder="Tulis Alamat" value="{{ old('photo')}}">
                    @error('photo')
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