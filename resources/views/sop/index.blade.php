@extends('templates.default')

@php
    $title = "Semua Data SOP Data Center";
    $pretitle ="Data SOP";
@endphp

@push('page-action')
    <a href="./sop/create" class="btn btn-primary">Tambah Data</a>
@endpush

@section('content')

<div class="row">
    <div class="col-ms-6">
        <form action="/sop">    
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
                    <th>Dokumen</th>
                    <th>Aksi</th>
                    <th class="w-1"></th>
                </tr>
            </thead>
            <tbody>
            @php $no = $sop->firstItem(); @endphp <!-- Inisialisasi nomor urut -->
            @foreach ($sop as $item)
            <tr>
                <td>{{ $no++ }}</td> <!-- Tampilkan nomor urut dan tambahkan 1 untuk setiap baris -->
                <td>{{ $item->nama }}</td>
                <td>
                        <a href="{{ route('download.pdf', ['filename' => $item->pdf]) }}" download="{{ $item->pdf }}">{{ $item->pdf }}</a>
                    </td>                
                    <td>
                        <a href="{{ route ('sop.edit', $item->id) }}" class="btn btn-sml">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('sop.destroy', $item->id)}}" method="post">
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
            Showing {{ $sop->firstItem() }} to {{ $sop->lastItem() }} of {{ $sop->total() }} entries
        </p>
        {{ $sop->links() }}
    </div>
</div>

@endsection

<script>
    function resetSearch() {
        // Reset nilai isian pencarian ke kosong
        document.querySelector('input[name="search"]').value = '';
        // Submit formulir pencarian
        document.querySelector('form[action="/sop"]').submit();
    }
</script>
