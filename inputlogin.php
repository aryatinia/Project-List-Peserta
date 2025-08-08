<?php
// Definisikan nama JSON, yaitu barang.json
define('FILE_JSON', 'login.json');

/*Prosedur untuk cek file apakah file JSON ada, jika tidak ada. 
maka buat file JSON dengan data kosong */

function cekFileJson() {
    if (!file_exists(FILE_JSON)) {
        file_put_contents(FILE_JSON, json_encode([]));
    }
}

// Fungsi untuk membaca data dari file JSON
function bacaDataJson() {
    /* PHP tidak mengenal tipe data JSON, yang ada tipe data ARRAY, 
    jadi lakukan konversi data JSON ke array dengan perintah "json_decode".
    Setelah dikonversi, kembalikan hasil konversi ke fungsi yang memanggilnya 
    menggunakan perintah -return-*/
    return json_decode(file_get_contents(FILE_JSON), true);
}

// Proses saat form dikirim
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // PANGGIl prosedur file cekFileJson()
    cekFileJson();

    /* Simpan ke variabel Ambil data dari form (name input type) */ 
    $username= $_POST['username'];
    $password= $_POST['password'];
   
    // Panggil fungsi bacaDataJson()
    $data_login = bacaDataJson();

    // Cek apakah username sudah ada
    for($i = 0; $i < count($data_login); $i++) {
    /* perbandingan nilai (=), perbandingan tipe data (==), perbandingan nilai tipe data (===) */ 
        if ($data_login[$i]['username'] === $username) {
            // tampilkan pesan barang sudah ada
        echo "<script>alert('nama dengan Kode: $username sudah ada!');</script>";
            //  setelah tombol OK diklik pd pesan, alihkan halaman ke indexlogin.html
        echo "<script>window.location.href = 'indexlogin.html';</script>";
        exit;
        }

    }
    //menambahkan data baru ke dalam array
 $data_login [] = [
            'username'  => $username,
            'password'  => $password
            
 ];

 /*konversi data array pada "$data_login" ke JSON dengan perintah "json_encode". 
 hasil konversi temoatkan kr file JSON dengan perintah "file_put_contents".
 format output JSON agar lebih mudah dibaca oleh manusia dengan perintah
 "JSON_PRETTY_PRINT".
 */

 file_put_contents(FILE_JSON, json_encode($data_login, JSON_PRETTY_PRINT));
 //tampilkan pesan data berhasil ditambah
 echo "<script>alert('data berhasil ditambahkan!');</script>";
 //setelah tombol OK diklik pd pesen, alihkan halaman ke indexlogin.html
 echo"<script>window.location.href = 'viewlistpeserta.php'</script>";

}
?>