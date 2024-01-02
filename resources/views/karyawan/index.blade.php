@extends('templates.default')

@php
    $title = "Semua Data Karyawan Data Center";
    $pretitle = "Data Karyawan";
@endphp

@push('page-action')
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah Data</a>
@endpush

@section('content')

<div class="row">
    <div class="col-ms-6">
        <form action="/karyawan">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
                <button class="btn btn-outline-secondary" type="button" onclick="resetSearch()">Reset</button> <!-- Tombol Reset -->
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Alamat</th>
                    <th>Phone Number</th>
                    <th>Aksi</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
            @php $no = $karyawans->firstItem(); @endphp <!-- Inisialisasi nomor urut -->
                @foreach ($karyawans as $item)
                <tr>
                    <td>{{ $no++ }}</td> <!-- Tampilkan nomor urut dan tambahkan 1 untuk setiap baris -->
                    <td>{{ $item->nama }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->photo) }}" height="150px" alt="">
                    </td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->phone_number }}</td>
                    <td>
                        <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-sml">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('karyawan.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Hapus" class="btn btn-danger btn-sml">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex align-items-center">
    <p class="m-0 text-secondary">
            Showing {{ $karyawans->firstItem() }} to {{ $karyawans->lastItem() }} of {{ $karyawans->total() }} entries
        </p>
        {{ $karyawans->links() }} <!-- Menampilkan tautan-tautan paginasi -->
    </div>
</div>
<script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Ambil elemen dropdown dan tombol yang membukanya
                    var dropdown = document.querySelector('.nav-item.active .dropdown-menu');
                    var dropdownToggle = document.querySelector('.nav-item.active .dropdown-toggle');

                    // Tambahkan kelas 'show' ke dropdown dan tombol ketika dokumen dimuat
                    if (dropdown && dropdownToggle) {
                        dropdown.classList.add('show');
                        dropdownToggle.setAttribute('aria-expanded', 'true');
                    }
                });
        </script>

@endsection

<script>
    function resetSearch() {
        // Reset nilai isian pencarian ke kosong
        document.querySelector('input[name="search"]').value = '';
        // Submit formulir pencarian
        document.querySelector('form[action="/karyawan"]').submit();
    }
</script>
