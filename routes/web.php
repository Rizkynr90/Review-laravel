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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('user', function () {
        return view('users.index');
    });
});

Route::get('relasi-1', function(){
    $mahasiswa = App\Models\Mahasiswa::where('nim', '=', '1015015072')->first();
    return $mahasiswa->wali->nama;
});

Route::get('relasi-2', function(){
    $mahasiswa = App\Models\Mahasiswa::where('nim', '=', '1015015072')->first();
    return $mahasiswa->dosen->nama;
});

Route::get('relasi-3', function(){
    $dosen = App\Models\Dosen::where('nama', '=', 'Yulianto')->first();
    foreach ($dosen->mahasiswa as $temp) {
        echo '<li> Nama : ' . $temp->nama . '<strong>'. $temp->nim. '</strong></li>';
    }
});

Route::get('relasi-4', function () {
    # Bila kita ingin melihat hobi saya
    $novay = App\Models\Mahasiswa::where('nama', '=', 'Noviyanto Rachmadi')->first();

    # Tampilkan seluruh hobi si novay
    foreach ($novay->hobi as $temp) {
        echo '<li>' . $temp->hobi . '</li>';
    }
});

Route::get('relasi-5', function () {
    # Temukan hobi Mandi Hujan
    $mandi_hujan = App\Models\Hobi::where('hobi', '=', 'Mandi Hujan')->first();

    # Tampilkan semua mahasiswa yang punya hobi mandi hujan
    foreach ($mandi_hujan->mahasiswa as $temp) {
        echo '<li> Nama : ' . $temp->nama . ' <strong>' . $temp->nim . '</strong></li>';
    }

});

Route::get('eloquent', function () {
    # Ambil semua data mahasiswa (lengkap dengan semua relasi yang ada)
    $mahasiswa = App\Models\Mahasiswa::with('wali', 'dosen', 'hobi')->get();

    # Kirim variabel ke View
    return view('eloquent', compact('mahasiswa'));
});