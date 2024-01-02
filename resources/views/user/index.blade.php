@extends('templates.default')

@php
    $title = "Semua Data User";
    $pretitle ="Data User";
@endphp

@section('content')

<div class="row">
  <div class="col-ms-6">
    <form action="/user">    
      <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Search..." name="search" value="{{
      request('search') }}">
      <button class="btn btn-outline-secondary" type="submit">Search</button>
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
                          <th>Email</th>
                          
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($users as $users)

                        <tr>
                          <td>{{$users->id }}</td>
                          <td>{{$users->name}}</td>
                          <td>{{$users->email}}</td>
                          <td>
                            <a href="{{ route ('user.edit', $users->id) }}" class="btn btn-sml">Edit</a>
                            <form action="{{ route('user.destroy', $users->id)}}" method="post">
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
      </div>
      
@endsection