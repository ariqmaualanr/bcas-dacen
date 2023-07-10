@extends('templates.default')

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="/karyawan" class="" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" name="example-text-input"
                placeholder="Tulis Nama">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" name="example-text-input"
                placeholder="Tulis Alamat">
            </div>
            <div class="mb-3">
                <label class="form-label">Nomer Telfon</label>
                <input type="text" name="phone_number" class="form-control" name="example-text-input"
                placeholder="Tulis Nomer Telfon">
            </div>

            <div class="mb-3">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
            </form>
        </div>    
    </div>

@endsection