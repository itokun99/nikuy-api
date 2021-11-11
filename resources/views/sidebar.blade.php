<div class="sidebar">
            <div class="class-title">
                <h2>{{$kelas->nama_kelas}}</h2>

                <!-- <div class="sidebar-progress-wrapper">
                    <div class="sidebar-progress-header">
                        <div class="sidebar-progress-label">Progress</div>
                        <div class="sidebar-progress-value">0%</div>
                    </div>
                    <div class="sidebar-progress-bar-body">
                        <div class="sidebar-progress-bar">
                            <div class="sidebar-progress-bar-value"></div>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- <div class="content-title">
                <h2>Konten Kelas #Nomor</h2>
            </div> -->

            @foreach($kursus as $key => $kursuss)
            <div class='pilar-dropdown'>
                <a class='btn btn-dropdown turunin1 cs-btn-dropdownpilar{{str_replace(" ","",$kursuss[0]->id_pilar)}}' href='#' id='pilar{{str_replace(" ","",$kursuss[0]->id_pilar)}}' role='button' data-toggle='dropdown'
                    aria-haspopup='true' aria-expanded='false'>
                    {{$key}} <img src='/assets/img/Collapse Arrow Down.png'>
                </a>
                
                <div class='drop-menu naikin1 cs-drop-menupilar{{str_replace(" ","",$kursuss[0]->id_pilar)}}' aria-labelledby='#pilar{{str_replace(" ","",$kursuss[0]->id_pilar)}}'>

                    @foreach($kursuss as $course)

                    @if($course->id_paket <= \Auth::user()->id_paket)
                    <a class='drop-item tampil1' href='/course/{{$kelas->id_kelas}}/sub/{{$course->id_kursus}}'>
                    @else
                    <a class='drop-item tampil1' href='/membership' class='btn mt-auto btn-mulai-slick' data-fancybox data-src='#pesanUpgrade'
                                    href='javascript:;'>
                    @endif
                        <img src='/assets/img/Circled Play.png'>
                        <div class='drop-text'>
                            <p class='drop-item-title'>{{$key}}</p>
                            <p class='drop-item-desc'>{{$course->nama_kursus}}</p>
                        </div>

                    </a>

                    @endforeach

                </div>
            </div>

            @endforeach

            <div class="rating">
                <a class="btn tombol-rating" href="/rating/{{$kelas->id_kelas}}">Rating dan Komentar</a>
            </div>
        </div>
