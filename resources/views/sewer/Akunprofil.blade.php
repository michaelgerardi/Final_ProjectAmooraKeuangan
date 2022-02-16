<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun</title>
    <link rel="stylesheet" href="{{asset('assets/css/akunprofil.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="main-body">
        
              <!-- Breadcrumb -->
              <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Akun</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> {{$data_akun->nama}}</li>
                  <li class="breadcrumb-item"><a href="/login">Logout</a></li>
                </ol>
              </nav>
              <!-- /Breadcrumb -->
        
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="/storage/imgprofil/{{$data_akun->image}}" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                          <h4> {{$data_akun->nama}} </h4>
                          <p class="text-secondary mb-1"> {{$data_akun->nip}}</p>
                          <p class="text-muted font-size-sm"> {{$data_akun->posisi}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                      <br>
                      <center>
                        <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($data_akun->nip, 'QRCODE')}}" alt="barcode" style="width: 250px; margin-bottom: 20px;" />
                      </center>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$data_akun->nama}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$data_akun->tgl_lahir}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">No Handphone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$data_akun->no_hp}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Jenis Kelamin</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$data_akun->jenis_kelamin}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Alamat</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$data_akun->alamat}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-2">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#updateModalProfil">
                           Edit
                        </button>
                        <div class="modal fade" id="updateModalProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                        
                      </div>
                      <div class="modal-body">
                      <form action="{{route('edit_akun')}}" method="POST" enctype='multipart/form-data'>
{{csrf_field()}}
                        <input name="id" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data_akun->id_sewer}}">

                                <div class="form-group">
                                  <label for="exampleInputEmail1">Full Name</label>
                                  <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data_akun->nama}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Tanggal Lahir</label>
                                  <input name="tgl_lahir" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data_akun->tgl_lahir}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">No Hp</label>
                                  <input name="no_hp"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data_akun->no_hp}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                  <select name="jenis_kelamin"class="form-control" id="exampleFormControlSelect1">
                                    <option value="Laki - laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Alamat</label>
                                  <textarea name="alamat"class="form-control" id="exampleFormControlTextarea1" rows="3">{{$data_akun->alamat}}</textarea>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Upload Foto Profil</label>
                                  <input name="image"type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$data_akun->image}}">
                                </div>
                            </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                      </div>
                      </div>
                      </div>
                      </div>
                        </div>
                      </div>
                    </div>
                  </div>
       
                    <div class="card mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Data Gaji Karyawan</h4>
                                <div id="accordion4" class="according accordion-s3 gradiant-bg">
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link" data-toggle="collapse" href="#accordion41">Gaji Harian</a>
                                        </div>
                                        <div id="accordion41" class="collapse show" data-parent="#accordion4">
                                            <div class="card-body">
                                                <table class="w3-table-all w3-card-4">
                                                  <tr>
                                                    <th>Jenis Gaji</th>
                                                    <th>Tanggal Gaji</th>
                                                    <th>Nominal Gaji</th>
                                                  </tr>
                                                  @foreach ($data_harian as $harian)
                                                  <tr>
                                                    <td>{{$harian->jenis_gaji}}</td>
                                                    <td>{{$harian->tgl_gaji}}</td>
                                                    <td>@currency($harian->gaji)</td>
                                                  </tr>
                                                  @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="collapsed card-link" data-toggle="collapse" href="#accordion42">Gaji Borongan</a>
                                        </div>
                                        <div id="accordion42" class="collapse" data-parent="#accordion4">
                                            <div class="card-body">
                                              <table class="w3-table-all w3-card-4">
                                                <tr>
                                                  <th>Jenis Gaji</th>
                                                  <th>Tanggal Gaji</th>
                                                  <th>Nominal Gaji</th>
                                                </tr>
                                                @foreach ($data_borongan as $borongan)
                                                <tr>
                                                  <td>{{$borongan->jenis_gaji}}</td>
                                                  <td>{{$borongan->tgl_gaji}}</td>
                                                  <td>@currency($borongan->gaji)</td>
                                                </tr>
                                                @endforeach
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                      <div class="card-header">
                                          <a class="collapsed card-link" data-toggle="collapse" href="#accordion43">Total Gaji</a>
                                      </div>
                                      <div id="accordion43" class="collapse" data-parent="#accordion4">
                                          <div class="card-body">
                                            <table class="w3-table-all w3-card-4">
                                              <tr>
                                                <th>Tanggal Gaji</th>
                                                <th>Total Gaji</th>
                                              </tr>
                                              @foreach ($total_gaji as $total)
                                              <tr>
                                                <td>{{$total->tgl_gaji}}</td>
                                                <td>@currency($total->totalgaji)</td>
                                              </tr>
                                              @endforeach
                                            </table>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
    
            </div>
        </div>
        <script src="{{asset('assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
        <!-- bootstrap 4 js -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>
        <!-- others plugins -->
        <script src="{{asset('assets/js/plugins.js')}}"></script>
        <script src="{{asset('assets/js/scripts.js')}}"></script>
</body>
</html>