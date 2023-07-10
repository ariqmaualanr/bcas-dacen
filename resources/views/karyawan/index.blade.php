@extends('templates.default')

@section('content')
<div class="card">
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>Phone Number</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($karyawans as $karyawans)

                          <tr>
                          <td>{{$karyawans->nama}}</td>
                          <td>{{$karyawans->alamat}}</td>
                          <td>{{$karyawans->phone_number}}</td>
                          <td>
                            <a href="#">Edit</a>
                          </td>  
                        </tr>

                          @endforeach


                        
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
@endsection