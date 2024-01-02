@extends('templates.default')

@section('content')
<div class="page-body">
          <div class="container-xl">
            
            <div class="row row-deck row-cards">
              
            <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">About</h3>
                    <div class="img-responsive img-responsive-5x9 card-img-top" style="background-image: url(./static/photos/group_1.png)"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3" >
                <div class="card">
                  <!-- Photo -->
                  <div class="img-responsive img-responsive-21x9 card-img-top" style="background-image: url(./static/photos/sop-doc.jpg)"></div>
                  <div class="card-body" >
                    <h3 class="card-title">Sop Data Center</h3>
                    <p class="text-secondary">Berisikan dokumen terkait seluruh sop pekerjaan di Data Center BCA Syariah.</p>
                  </div>
                </div>
              </div>
             
              <div class="col-md-6 col-lg-3" >
                <div class="card">
                  <!-- Photo -->
                  <div class="img-responsive img-responsive-21x9 card-img-top" style="background-image: url(./static/photos/user-iconcrop.jpg)"></div>
                  <div class="card-body" >
                    <h3 class="card-title">Karyawan Data Center</h3>
                    <p class="text-secondary">Data-data karyawan khususnya yang berada di Data Center.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 rounded" ></span>
                    <h3 class="m-0 mb-1"><a href="#">{{ Auth::user()->name }}</a></h3>
                    <div class="text-secondary">{{ Auth::user()->email }}</div>
                    <div class="mt-3">
                      <span class="badge bg-green-lt">Admin</span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 21h-6a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v.5"></path>
                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                        <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                        <path d="M22 22l-5 -5"></path>
                        <path d="M17 22l5 -5"></path>
                      </svg>
                      Logout</a>
                  </div>
                </div>
              </div>
              
                              
              </div>
              <br>

              <!-- <div class="card-body">
                    <div id="carousel-captions" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item">
                          <img class="d-block w-100" alt="" src="./static/photos/coffee-on-a-table-with-other-items.jpg">
                          <div class="carousel-caption-background d-none d-md-block"></div>
                          <div class="carousel-caption d-none d-md-block">
                            <h3>Slide label</h3>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" alt="" src="./static/photos/young-entrepreneur-working-from-a-modern-cafe-2.jpg">
                          <div class="carousel-caption-background d-none d-md-block"></div>
                          <div class="carousel-caption d-none d-md-block">
                            <h3>Slide label</h3>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" alt="" src="./static/photos/soft-photo-of-woman-on-the-bed-with-the-book-and-cup-of-coffee-in-hands.jpg">
                          <div class="carousel-caption-background d-none d-md-block"></div>
                          <div class="carousel-caption d-none d-md-block">
                            <h3>Slide label</h3>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                          </div>
                        </div>
                        <div class="carousel-item active">
                          <img class="d-block w-100" alt="" src="./static/photos/fairy-lights-at-the-beach-in-bulgaria.jpg">
                          <div class="carousel-caption-background d-none d-md-block"></div>
                          <div class="carousel-caption d-none d-md-block">
                            <h3>Slide label</h3>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" alt="" src="./static/photos/woman-working-on-laptop-at-home-office.jpg">
                          <div class="carousel-caption-background d-none d-md-block"></div>
                          <div class="carousel-caption d-none d-md-block">
                            <h3>Slide label</h3>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel-captions" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel-captions" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </a>
                    </div> -->
                  </div>
              
@endsection