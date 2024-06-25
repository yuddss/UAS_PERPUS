<?php
include 'koneksi.php';

header("Content-Type: application/json");

$request_method = $_SERVER["REQUEST_METHOD"];
$path_info = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : [];
$id = isset($path_info[0]) ? (int)$path_info[0] : null;

function get_peminjaman() {
    global $koneksi;
    $sql = "SELECT * FROM peminjaman";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($data);
}

function get_peminjaman_by_id($id) {
    global $koneksi;
    $sql = "SELECT * FROM peminjaman WHERE id = $id";
    $result = mysqli_query($koneksi, $sql);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Data tidak ditemukan"]);
        }
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Kesalahan query"]);
    }
}

function insert_peminjaman() {
    global $koneksi;
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data["nim"]) && isset($data["nama"]) && isset($data["namabuku"]) && isset($data["jurusan"]) && isset($data["fakultas"]) && isset($data["penerbit"]) && isset($data["tahun"]) && isset($data["tglpinjam"])) {
        $nim = $data["nim"];
        $nama = $data["nama"];
        $namabuku = $data["namabuku"];
        $jurusan = $data["jurusan"];
        $fakultas = $data["fakultas"];
        $penerbit = $data["penerbit"];
        $tahun = $data["tahun"];
        $tglpinjam = $data["tglpinjam"];
        
        $sql = "INSERT INTO peminjaman (nim, nama, namabuku, jurusan, fakultas, penerbit, tahun, tglpinjam) 
                VALUES ('$nim', '$nama', '$namabuku', '$jurusan', '$fakultas', '$penerbit', '$tahun', '$tglpinjam')";
        if (mysqli_query($koneksi, $sql)) {
            $last_id = mysqli_insert_id($koneksi);
            http_response_code(201);
            echo json_encode(["message" => "Data berhasil ditambahkan", "id" => $last_id]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Gagal menambahkan data", "error" => mysqli_error($koneksi)]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Data tidak lengkap"]);
    }
}

function update_peminjaman($id) {
    global $koneksi;
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data["nim"]) && isset($data["nama"]) && isset($data["namabuku"]) && isset($data["jurusan"]) && isset($data["fakultas"]) && isset($data["penerbit"]) && isset($data["tahun"]) && isset($data["tglpinjam"])) {
        $nim = $data["nim"];
        $nama = $data["nama"];
        $namabuku = $data["namabuku"];
        $jurusan = $data["jurusan"];
        $fakultas = $data["fakultas"];
        $penerbit = $data["penerbit"];
        $tahun = $data["tahun"];
        $tglpinjam = $data["tglpinjam"];
        
        $sql = "UPDATE peminjaman 
                SET nim='$nim', nama='$nama', namabuku='$namabuku', jurusan='$jurusan', fakultas='$fakultas', penerbit='$penerbit', tahun='$tahun', tglpinjam='$tglpinjam' 
                WHERE id=$id";
        if (mysqli_query($koneksi, $sql)) {
            echo json_encode(["message" => "Data berhasil diperbarui"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Gagal memperbarui data", "error" => mysqli_error($koneksi)]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Data tidak lengkap"]);
    }
}

function delete_peminjaman($id) {
    global $koneksi;
    $sql = "DELETE FROM peminjaman WHERE id=$id";
    if (mysqli_query($koneksi, $sql)) {
        echo json_encode(["message" => "Data berhasil dihapus"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Gagal menghapus data", "error" => mysqli_error($koneksi)]);
    }
}

switch ($request_method) {
    case 'GET':
        if ($id) {
            get_peminjaman_by_id($id);
        } else {
            get_peminjaman();
        }
        break;
    case 'POST':
        insert_peminjaman();
        break;
    case 'PUT':
        if ($id) {
            update_peminjaman($id);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID tidak valid"]);
        }
        break;
    case 'DELETE':
        if ($id) {
            delete_peminjaman($id);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID tidak valid"]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Metode Tidak Diizinkan"]);
        break;
}
?>
