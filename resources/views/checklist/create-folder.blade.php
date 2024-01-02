@extends('templates.default')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Buat Folder Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('checklist.store-folder') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Folder:</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
