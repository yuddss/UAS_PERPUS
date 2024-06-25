<?php
include 'koneksi.php';  // Menginclude file koneksi

$nim        = "";
$nama       = "";
$namabuku    = "";
$fakultas   = "";
$jurusan    = "";
$penerbit   = "";
$tahun      = "";
$tglpinjam  = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from peminjaman where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id          = $_GET['id'];
    $sql1        = "select * from peminjaman where id = '$id'";
    $q1          = mysqli_query($koneksi, $sql1);
    $r1          = mysqli_fetch_array($q1);
    $nim         = $r1['nim'];
    $nama        = $r1['nama'];
    $namabuku     = $r1['namabuku'];
    $jurusan     = $r1['jurusan'];
    $fakultas    = $r1['fakultas'];
    $penerbit    = $r1['penerbit'];
    $tahun       = $r1['tahun'];
    $tglpinjam   = $r1['tglpinjam'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { // untuk create
    $nim         = $_POST['nim'];
    $nama        = $_POST['nama'];
    $namabuku    = $_POST['namabuku'];
    $jurusan     = $_POST['jurusan'];
    $fakultas    = $_POST['fakultas'];
    $penerbit    = $_POST['penerbit'];
    $tahun       = $_POST['tahun'];
    $tglpinjam   = $_POST['tglpinjam'];

    if ($nim && $nama && $namabuku && $jurusan && $fakultas && $penerbit && $tahun && $tglpinjam) {
        if ($op == 'edit') { // untuk update
            $sql1       = "update peminjaman set nim = '$nim',nama='$nama',namabuku = '$namabuku',jurusan = '$jurusan',fakultas = '$fakultas',penerbit = '$penerbit',tahun = '$tahun', tglpinjam = '$tglpinjam' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { // untuk insert
            $sql1   = "insert into peminjaman(nim,nama,namabuku,jurusan,fakultas,penerbit,tahun,tglpinjam) values ('$nim','$nama','$namabuku','$jurusan','$fakultas','$penerbit','$tahun','$tglpinjam')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1600px;
        }

        .card {
            margin-top: 10px;
        }

        body {
            background-image: url('images/background.jpg'); /* Path ke gambar background */
            background-size: cover; /* Agar gambar menutupi seluruh halaman */
            background-repeat: no-repeat; /* Agar gambar tidak berulang */
            background-position: center center; /* Posisi gambar di tengah */
            background-attachment: fixed; /* Agar background tetap saat scrolling */
        }
       
        .table th, .table td {
            white-space: nowrap; /* Agar teks tidak terpotong secara vertikal */
            overflow: hidden;
            text-overflow: ellipsis; /* Tambahkan elipsis jika teks terlalu panjang */
            max-width: 300px; /* Atur lebar maksimum untuk kolom pada layar kecil */
        }
        }
        
    </style>
       <script>
        document.addEventListener('DOMContentLoaded', function () {
            var numberInputs = document.querySelectorAll('input[type="number"]');
            numberInputs.forEach(function (input) {
                input.addEventListener('input', function (event) {
                    var value = input.value;
                    input.value = value.replace(/[^0-9]/g, '');
                });
            });

            <?php if ($sukses): ?>
            $('#successModal').modal('show');
            <?php endif; ?>

            <?php if ($error): ?>
            $('#errorModal').modal('show');
            <?php endif; ?>
        });
    </script>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                INPUT DATA PEMINJAMANAN BUKU
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:2;url=index.php"); //2 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:2;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="number" pattern="[0-9]*" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="fakultas" id="fakultas">
                                <option value="">- Pilih Fakultas -</option>
                                <option value="Teknik" <?php if ($fakultas == "Teknik") echo "selected" ?>>Teknik</option>
                                <option value="Ilmu Keperawatan" <?php if ($fakultas == "Ilmu Keperawatan") echo "selected" ?>>Ilmu Keperawatan</option>
                                <option value="Tarbiyah Dan Ilmu Keguruan" <?php if ($fakultas == "Tarbiyah Dan Ilmu Keguruan") echo "selected" ?>>Tarbiyah Dan Ilmu Keguruan</option>
                                <option value="Ekonomi Dan Bisnis Islam" <?php if ($fakultas == "Ekonomi Dan Bisnis Islam") echo "selected" ?>>Ekonomi Dan Bisnis Islam</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jurusan" id="jurusan">
                                <option value="">- Pilih Jurusan -</option>
                                <option value="Informatika" <?php if ($jurusan == "Informatika") echo "selected" ?>>Informatika</option>
                                <option value="Elektro" <?php if ($jurusan == "Elektro") echo "selected" ?>>Elektro</option>
                                <option value="Keperawatan" <?php if ($jurusan == "Keperawatan") echo "selected" ?>>Keperawatan</option>
                                <option value="Akuntasi" <?php if ($jurusan == "Akuntasi") echo "selected" ?>>Akuntasi</option>
                                <option value="Bisnis Digital" <?php if ($jurusan == "Bisnis Digital") echo "selected" ?>>Bisnis Digital</option>
                                <option value="Ekonomi Syariah" <?php if ($jurusan == "Ekonomi Syariah") echo "selected" ?>>Ekonomi Syariah</option>
                                <option value="Perbankan Syariah" <?php if ($jurusan == "Perbankan Syariah") echo "selected" ?>>Perbankan Syariah</option>
                                <option value="Pendidikan Agama Islam" <?php if ($jurusan == "Pendidikan Agama Islam") echo "selected" ?>>Pendidikan Agama Islam</option>
                                <option value="Pendidikan Islam Anak Usia Dini" <?php if ($jurusan == "Pendidikan Islam Anak Usia Dini") echo "selected" ?>>Pendidikan Islam Anak Usia Dini</option>
                                <option value="Manajemen Pendidikan Islam" <?php if ($jurusan == "Manajemen Pendidikan Islam") echo "selected" ?>>Manajemen Pendidikan Islam</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="namabuku" class="col-sm-2 col-form-label">Nama Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namabuku" name="namabuku" value="<?php echo $namabuku ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $penerbit ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                        <div class="col-sm-10">
                            <input type="number" pattern="[0-9]*" class="form-control" id="tahun" name="tahun" value="<?php echo $tahun ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tglpinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm-10">
                            <input type="date" pattern="[0-9]*" class="form-control" id="tglpinjam" name="tglpinjam" value="<?php echo $tglpinjam ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                DATA MAHASISWA YANG MEMINJAM BUKU
            </div>
            <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px;">Nim</th>
                        <th scope="col" style="width: 150px;">Nama</th>
                        <th scope="col" style="width: 200px;">Fakultas</th>
                        <th scope="col" style="width: 250px;">Jurusan</th>
                        <th scope="col" style="width: 150px;">Buku</th>
                        <th scope="col" style="width: 150px;">Penerbit</th>
                        <th scope="col" style="width: 80px;">Tahun</th>
                        <th scope="col" style="width: 120px;">Tanggal Pinjam</th>
                        <th scope="col" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php
                        $sql2   = "SELECT id, nim, nama, fakultas, jurusan, namabuku, penerbit, tahun, DATE_FORMAT(tglpinjam, '%d %M %Y') as tglpinjam FROM peminjaman ORDER BY id DESC";
                        $q2     = mysqli_query($koneksi, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nim        = $r2['nim'];
                            $nama       = $r2['nama'];
                            $fakultas   = $r2['fakultas'];
                            $jurusan    = $r2['jurusan'];
                            $namabuku   = $r2['namabuku'];
                            $penerbit   = $r2['penerbit'];
                            $tahun      = $r2['tahun'];
                            $tglpinjam  = $r2['tglpinjam'];
                        ?>
                            <tr>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $fakultas ?></td>
                                <td scope="row"><?php echo $jurusan ?></td>
                                <td scope="row"><?php echo $namabuku ?></td>
                                <td scope="row"><?php echo $penerbit ?></td>
                                <td scope="row"><?php echo $tahun ?></td>
                                <td scope="row"><?php echo $tglpinjam ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>