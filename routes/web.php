<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/**
 * ===================================
 * ROUTE CLIENT
 * ===================================
 */

// home
Route::get('/', 'Client\RouteController@homepage');

// profile
Route::get('/profile/business/add', 'Client\RouteController@business_add');
Route::get('/profile/business/{id}', 'Client\RouteController@business');
Route::get('/profile/business', 'Client\RouteController@business');
Route::get('/profile', 'Client\RouteController@profile');

// event
Route::get('/event', 'Client\RouteController@event');

// course
Route::get('/course/{id}/{pillarId}/{courseId}', 'Client\RouteController@course_detail');
Route::get('/course/{id}/{pillarId}', 'Client\RouteController@course_detail');
Route::get('/course/{id}', 'Client\RouteController@course_detail');
Route::get('/course', 'Client\RouteController@course');

// forum
Route::get('/forum', 'Client\RouteController@forum');

// community
Route::get('/community', 'Client\RouteController@community');

// membership
Route::get('/membership/upgrade/{id}', 'Client\RouteController@membership_upgrade');
Route::get('/membership', 'Client\RouteController@membership');

Route::get('/transaction/{id}', 'Client\RouteController@main');
Route::get('/transaction', 'Client\RouteController@main');


// Route::get('/event', 'EventController@index');
// //coursekelas user
// Route::get('/course', 'KelasController@course_kelas');
// Route::get('/course/{id_kelas}', 'KelasController@course_separator');
// Route::get('/course/{id_kelas}/sub/{id_kursus}', 'KelasController@kursus_separator');
// Route::get('/gemtwo', function () {
//     return view('gemtwo');
// });

// //ratting
// Route::get('/rating/{id_kelas}', 'KelasController@rating_saparator');
// Route::post('/rating/{id_kelas}', 'KelasController@rating_store');

// Route::get('/forum', function () {
//     return view('comming_soon');
// });

// Route::get('/community', function () {
//     return view('comming_soon');
// });

// Route::get('/user', 'UserController@user');
// Route::get('/profile', 'UserController@user');
// Route::post('/update-user', 'UserController@update_user');
// Route::post('/user/photo', 'UserController@photo');

// Route::get('/membership', 'PaketMemberController@membership');
// Route::get('/membership/upgrade/{id_paketmember}', 'PaketMemberController@upgrade_membership');
// Route::post('/membership/upgrade/{id_paketmember}', 'PaketMemberController@confirm_membership');

// Route::get('/app', function () {
//     return redirect('/');
// });
// Route::get('/home', function () {
//     return redirect('/');
// });

// Route::get('/kelas', function () {
//     return view('kelas');
// });

// Route::get('/daftar/{id}', 'EventController@show');

// Route::get('/daftar_event', function () {
//     return view('daftar_event');
// });

// Route::get('/konfirmasi', function () {
//     return view('konfirmasi');
// });

// Route::get('/akun_bisnis', 'UserPreneurController@UserPreneur');
// Route::get('/profile/bisnis', 'UserPreneurController@UserPreneur');
// Route::post('/akun_bisnis/{id}', 'UserPreneurController@update_preneur');
// // Route::get('akun_bisnis{id}','UserPreneurController@edit_preneur');
// Route::post('/akun_bisnis', 'UserPreneurController@store_preneur');

// Route::get('/event/daftar/{id_event}', 'EventController@daftar_event');
// Route::post('/event/daftar/{id_event}', 'EventController@daftar');

// Route::get('/transaksi', 'TransaksiController@user_transaksi');



/**
 * ===================================
 * ROUTE ADMIN
 * ===================================
 */

// Control
Route::get('/admin/login', 'Admin\AuthController@login_page')->name('admin_login_page');
Route::post('/admin/login', 'Admin\AuthController@login');
Route::get('/admin/logout', 'Admin\AuthController@logout');
Route::prefix('admin')->middleware(['admin.auth'])->group(function () {
    // Dashboard
    Route::get('/', 'Admin\DashboardController@index_page')->name('admin_dashboard_page');
    Route::get('/dashboard', function () {
        return redirect('/admin');
    });

    // Member
    Route::get('/member/tambah', 'Admin\MemberController@add_page')->name('admin_tambah_member_page');
    Route::post('/member/tambah', 'Admin\MemberController@add');
    Route::get('/member/edit/{id}', 'Admin\MemberController@edit_page')->name('admin_edit_member_page');
    Route::post('/member/edit/{id}', 'Admin\MemberController@edit');
    Route::get('/member/delete/{id}', 'Admin\MemberController@delete');
    Route::get('/member/{id}', 'Admin\MemberController@detail_page')->name('admin_detail_member_page');
    Route::get('admin/member/export', 'Admin\MemberController@export');
    Route::get('/member', 'Admin\MemberController@index_page')->name('admin_member_page');

    // Bisnis
    Route::get('/bisnis/{id}', 'Admin\BisnisMemberController@detail_page')->name('admin_detail_bisnis_page');
    Route::get('/bisnis', 'Admin\BisnisMemberController@index_page')->name('admin_bisnis_page');

    // Membership
    Route::get('/paket/tambah', 'Admin\PaketMemberController@add_page')->name('admin_tambah_paket_page');
    Route::post('/paket/tambah', 'Admin\PaketMemberController@add');
    Route::get('/paket/edit/{id}', 'Admin\PaketMemberController@edit_page')->name('admin_edit_paket_page');
    Route::post('/paket/edit/{id}', 'Admin\PaketMemberController@edit');
    Route::get('/paket/delete/{id}', 'Admin\PaketMemberController@delete');
    Route::get('/paket/{id}', 'Admin\PaketMemberController@detail_page')->name('admin_detail_paket_page');
    Route::get('/paket', 'Admin\PaketMemberController@index_page')->name('admin_paket_page');

    // Kelas
    Route::get('/kelas/tambah', 'Admin\KelasController@add_page')->name('admin_tambah_kelas_page');
    Route::post('/kelas/tambah', 'Admin\KelasController@add');
    Route::get('/kelas/edit/{id}', 'Admin\KelasController@edit_page')->name('admin_edit_kelas_page');
    Route::post('/kelas/edit/{id}', 'Admin\KelasController@edit');
    Route::get('/kelas/delete/{id}', 'Admin\KelasController@delete');
    Route::get('/kelas/{id}', 'Admin\KelasController@detail_page')->name('admin_detail_kelas_page');
    Route::get('/kelas', 'Admin\KelasController@index_page')->name('admin_kelas_page');

    // Pilar
    Route::get('/pilar/tambah', 'Admin\PilarController@add_page');
    Route::post('/pilar/tambah', 'Admin\PilarController@add');
    Route::get('/pilar/edit/{id}', 'Admin\PilarController@edit_page');
    Route::post('/pilar/edit/{id}', 'Admin\PilarController@edit');
    Route::get('/pilar/delete/{id}', 'Admin\PilarController@delete');
    Route::get('/pilar/{id}', 'Admin\PilarController@detail_page');
    Route::get('/pilar', 'Admin\PilarController@index_page');

    // Pembagian Kelas
    Route::get('/pembagian-kelas/tambah', 'Admin\PaketKelasController@add_page');
    Route::post('/pembagian-kelas/tambah', 'Admin\PaketKelasController@add');
    Route::get('/pembagian-kelas/edit/{id}', 'Admin\PaketKelasController@edit_page');
    Route::post('/pembagian-kelas/edit/{id}', 'Admin\PaketKelasController@edit');
    Route::get('/pembagian-kelas/delete/{id}', 'Admin\PaketKelasController@delete');
    Route::get('/pembagian-kelas', 'Admin\PaketKelasController@index_page');

    // Kursus
    Route::get('/kursus/edit/{id}', 'Admin\KursusController@edit_page')->name('admin_edit_kursus_page');
    Route::post('/kursus/edit/{id}', 'Admin\KursusController@edit');
    Route::get('/kursus/tambah', 'Admin\KursusController@add_page')->name('admin_tambah_kursus_page');
    Route::post('/kursus/tambah', 'Admin\KursusController@add');
    Route::get('/kursus/delete/{id}', 'Admin\KursusController@delete');
    Route::get('/kursus/{id}', 'Admin\KursusController@detail_page')->name('admin_detail_kursus_page');
    Route::get('/kursus', 'Admin\KursusController@index_page')->name('admin_kursus_page');

    // Kursus File
    Route::get('/file-kursus/tambah', 'Admin\FileKursusController@add_page');
    Route::post('/file-kursus/tambah', 'Admin\FileKursusController@add');
    Route::get('/file-kursus/edit/{id}', 'Admin\FileKursusController@edit_page');
    Route::post('/file-kursus/edit/{id}', 'Admin\FileKursusController@edit');
    Route::get('/file-kursus/delete/{id}', 'Admin\FileKursusController@delete');
    Route::get('/file-kursus/download/{id}', 'Admin\FileKursusController@download');
    Route::get('/file-kursus', 'Admin\FileKursusController@index_page');

    // event
    Route::get('/event/tambah', 'Admin\EventController@add_page');
    Route::post('/event/tambah', 'Admin\EventController@add');
    Route::get('/event/edit/{id}', 'Admin\EventController@edit_page');
    Route::post('/event/edit/{id}', 'Admin\EventController@edit');
    Route::get('/event/delete/{id}', 'Admin\EventController@delete');
    Route::get('/event/export/{id}', 'Admin\EventController@export_event');
    Route::get('/event/export', 'Admin\EventController@export_event');
    Route::get('/event/{id}', 'Admin\EventController@detail_page');
    Route::get('/event', 'Admin\EventController@index_page');

    // Transaksi
    Route::post('/transaksi/delete/{id}', 'Admin\TransaksiController@delete');
    Route::post('/transaksi/konfirmasi/{id}', 'Admin\TransaksiController@confirmed');
    Route::post('/transaksi/tolak/{id}', 'Admin\TransaksiController@rejected');
    Route::get('/transaksi/{id}', 'Admin\TransaksiController@detail_page');
    Route::get('/transaksi', 'Admin\TransaksiController@index_page');

    // Slider
    Route::post('/banner/tambah', 'Admin\BannerController@add');
    Route::post('/banner/edit/{id}', 'Admin\BannerController@edit');
    Route::get('/banner/delete/{id}', 'Admin\BannerController@delete');
    Route::get('/banner', 'Admin\BannerController@index_page');


    Route::post('/banner-kelas/tambah', 'Admin\BannerKelasController@add');
    Route::get('/banner-kelas/edit/{id}', 'Admin\BannerKelasController@edit_page');
    Route::post('/banner-kelas/edit/{id}', 'Admin\BannerKelasController@edit');
    Route::post('/banner-kelas/delete/{id}', 'Admin\BannerKelasController@delete');
    Route::post('/banner-kelas/{banner_id}/kursus/edit/{id}', 'Admin\BannerKelasKursusController@edit');
    Route::post('/banner-kelas/{banner_id}/kursus/tambah', 'Admin\BannerKelasKursusController@add');
    Route::get('/banner-kelas/{banner_id}/kursus/delete/{id}', 'Admin\BannerKelasKursusController@delete');

    //administrator
    Route::get('/administrator/tambah', 'Admin\AdministratorController@add_page');
    Route::post('/administrator/tambah', 'Admin\AdministratorController@add');
    Route::get('/administrator/edit/{id}', 'Admin\AdministratorController@edit_page');
    Route::post('/administrator/edit/{id}', 'Admin\AdministratorController@edit');
    Route::get('/administrator/delete/{id}', 'Admin\AdministratorController@delete');
    Route::get('/administrator/{id}', 'Admin\AdministratorController@detail_page');
    Route::get('/administrator', 'Admin\AdministratorController@index_page');

    // rating
    Route::get('/rating/{id}', 'Admin\RatingController@detail_page');
    Route::get('/rating', 'Admin\RatingController@index_page');

    // data provinsi
    Route::post('/data-provinsi/tambah', 'Admin\ProvinsiController@add');
    Route::post('/data-provinsi/edit/{id}', 'Admin\ProvinsiController@edit');
    Route::get('/data-provinsi/delete/{id}', 'Admin\ProvinsiController@delete');
    Route::get('/data-provinsi', 'Admin\ProvinsiController@index_page');

    // sosial media
    Route::post('/sosial-media/edit/{id}', 'Admin\SosmedController@edit');
    Route::post('/sosial-media/tambah', 'Admin\SosmedController@add');
    Route::get('/sosial-media/delete/{id}', 'Admin\SosmedController@delete');
    Route::get('/sosial-media', 'Admin\SosmedController@index_page');

    // pesan
    Route::get('/pesan/delete/{id}', 'Admin\PesanController@delete');
    Route::get('/pesan/{id}', 'Admin\PesanController@detail_page');
    Route::get('/pesan', 'Admin\PesanController@index_page');

    // masa berlaku paket
    Route::post('/masa-berlaku/tambah', 'Admin\MasaBerlakuPaketController@add');
    Route::get('/masa-berlaku/delete/{id}', 'Admin\MasaBerlakuPaketController@delete');
    Route::post('/masa-berlaku/edit/{id}', 'Admin\MasaBerlakuPaketController@edit');
    Route::get('/masa-berlaku', 'Admin\MasaBerlakuPaketController@index_page');

    // riwayat admin
    Route::get('/riwayat-admin/{id}', 'Admin\RiwayatAdminController@detail_page');
    Route::get('/riwayat-admin', 'Admin\RiwayatAdminController@index_page');

    //riwayat member
    Route::get('/riwayat-member/{id}', 'Admin\RiwayatController@detail_page');
    Route::get('/riwayat-member', 'Admin\RiwayatController@index_page');

    // profile admin
    Route::get('/profile', 'Admin\ProfileController@index_page');
    Route::post('/profile', 'Admin\ProfileController@edit');

    // tambah daftar bank
    Route::get('/bank/tambah', 'Admin\BankController@add_page');
    Route::post('/bank/tambah', 'Admin\BankController@add');
    Route::get('/bank/edit/{id}', 'Admin\BankController@edit_page');
    Route::post('/bank/edit/{id}', 'Admin\BankController@edit');
    Route::get('/bank/delete/{id}', 'Admin\BankController@delete');
    Route::get('/bank/{id}', 'Admin\BankController@detail_page');
    Route::get('/bank', 'Admin\BankController@index_page');

    // tambah metode pembayaran
    Route::get('/metode-pembayaran/tambah', 'Admin\MetodePembayaranController@add_page');
    Route::post('/metode-pembayaran/tambah', 'Admin\MetodePembayaranController@add');
    Route::get('/metode-pembayaran/edit/{id}', 'Admin\MetodePembayaranController@edit_page');
    Route::post('/metode-pembayaran/edit/{id}', 'Admin\MetodePembayaranController@edit');
    Route::get('/metode-pembayaran/delete/{id}', 'Admin\MetodePembayaranController@delete');
    Route::get('/metode-pembayaran/{id}', 'Admin\MetodePembayaranController@detail_page');
    Route::get('/metode-pembayaran', 'Admin\MetodePembayaranController@index_page');
});
