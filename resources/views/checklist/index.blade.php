@extends('templates.default')

@php
    $title = "Semua Data Checklist";
    $pretitle = "Data Checklist";
@endphp

@push('page-action')
    <a href="{{ route('checklist.create') }}" class="btn btn-primary">Tambah Checklist</a>
    <a href="{{ route('checklist.create-folder') }}" class="btn btn-success">Tambah Folder Baru</a>
@endpush
@section('content')

<div class="row">
    <div class="col-ms-6">
        <form action="{{ url('/checklist') }}">    
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
                <button class="btn btn-outline-secondary" type="button" onclick="resetSearch()">Reset</button>
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
            @php $no = 1; @endphp
            @foreach ($checklists as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    <a href="{{ route('download.pdf', ['filename' => $item->pdf]) }}" download="{{ $item->pdf }}">
                        {{ $item->pdf }}
                    </a>
                </td>                
                <td>
                    <a href="{{ route('checklist.edit', $item->id) }}" class="btn btn-sml">Edit</a>
                </td>
                <td>
                    <form action="{{ route('checklist.destroy', $item->id)}}" method="post">
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
            Showing {{ $checklists->firstItem() }} to {{ $checklists->lastItem() }} of {{ $checklists->total() }} entries
        </p>
        {{ $checklists->links() }}
    </div>
</div>

@endsection

<script>
    function resetSearch() {
        document.querySelector('input[name="search"]').value = '';
        document.querySelector('form[action="/checklist"]').submit();
    }
</script>
