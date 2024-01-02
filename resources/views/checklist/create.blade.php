@extends('templates.default')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Checklist Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('checklist.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Checklist:</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pdf" class="form-label">File PDF:</label>
                    <input type="file" name="pdf" class="form-control" accept=".pdf" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
