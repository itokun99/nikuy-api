@extends('web.layout.container')

@push('style')
    <link rel="stylesheet" href="/404/assets/css/bd-coming-soon.css">
@endpush

@section('content')
    @include('slidebar')
    <!-- <main class="my-auto"> -->
    <div class="container" style="background:transparent;margin-top:100px">
        <h1 class="page-title">Coming Soon</h1>
        <!-- <p class="page-description">Lorem ipsum dolor sit amet consectetur adipisicing elit sed eiu sit amet consectetur
                        </p> -->
        <!-- <p>Stay connected</p>
                        <nav class="footer-social-links">
                            <a href="#!" class="social-link"><i class="mdi mdi-facebook-box"></i></a>
                            <a href="#!" class="social-link"><i class="mdi mdi-twitter"></i></a>
                            <a href="#!" class="social-link"><i class="mdi mdi-google"></i></a>
                            <a href="#!" class="social-link"><i class="mdi mdi-slack"></i></a>
                            <a href="#!" class="social-link"><i class="mdi mdi-skype"></i></a>
                        </nav> -->
    </div>
    <!-- </main> -->
@endsection
