@extends('admin.layout.authcontainer')

@section('title')
    Login - ELITES Admin
@stop

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col">
                                                <img src="/assets/img/LogoHitam.png" width="85%">
                                            </div>
                                            <div class="col" style="padding:10px;">
                                                <h1 class="h4 text-gray-900 mb-4">Administrator</h1>
                                            </div>
                                        </div>
                                    </div>
                                    @include('admin.component.alert')
                                    <form class="user" method="post" action="/admin/login">
                                        @csrf
                                        <div class="form-group">
                                            <input name="email" required type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" required type="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>

                                        <input type="submit" value="LOGIN" class="btn btn-warning btn-user btn-block"
                                            style="font-weight: bold; font-size:20px; letter-spacing:5px;">
                                        <hr>
                                        <input type="hidden" name="hak_akses" value="Administrator">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
