# UAS-API-PERPUSTAKAAN
Script PHP digunakan untuk membuat aplikasi manajemen peminjaman buku dengan menggunakan HTML. Bahasa yang digunakan adalah PHP, dengan beberapa library dan fungsi bawaan PHP seperti mysqli untuk interaksi dengan database MySQL.

**Berikut adalah komponen-komponen utama dalam script ini:**
- Server-Side Scripting
- PHP Native Functions
- HTML
- SQL Query
  
## Menjalankan API menggunakan Postman
**Untuk mengambil seluruh data**
- Method: GET
- URL : http://localhost/API-PERPUSTAKAAN/api.php


**Untuk mengambil data dengan ID**
- Method: GET
- URL : http://localhost/API-PERPUSTAKAAN/api.php/4


**Untuk menambahkan data** 
- Method: POST
- URL : http://localhost/API-PERPUSTAKAAN/api.php
- Body JSON:
   ```
   {
        "nim": "ISI SENDIRI",
        "nama": "ISI SENDIRI",
        "namabuku": "ISI SENDIRI",
        "fakultas": "Teknik",
        "jurusan": "Informatika",
        "penerbit": "ISI SENDIRI",
        "tahun": "ISI SENDIRI",
        "tglpinjam": "2024-06-23"
    }
   
**Untuk memperbarui/mengubah data dengan ID**
- Method: PUT
- URL : http://localhost/API-PERPUSTAKAAN/api.php/4
- Body JSON:
   ```
   {
        "nim": "2222105241",
        "nama": "Yudo Putra Hutagalung",
        "namabuku": "Cara Memperbesar Jempol",
        "fakultas": "Teknik",
        "jurusan": "Teknik Informatika",
        "penerbit": "Gramedia",
        "tahun": "2019",
        "tglpinjam": "2020-06-01"
    }

**Untuk menghapus data peminjaman dengan ID**
- Method: DELETE
- URL : http://localhost/API-PERPUSTAKAAN/api.php/1


## Menjalankan WEB Sistem Perpustakaan (TAMBAHAN)
URL : http://localhost/API-PERPUSTAKAAN/index.php

## Fitur Web:
- Form Input: Untuk menambahkan atau mengubah data peminjaman buku.
- Tabel Data: Untuk menampilkan data peminjaman buku beserta aksi untuk mengedit dan menghapus data.
- Validasi Input: Pengecekan agar data yang dimasukkan lengkap sebelum disubmit ke database.
- Feedback Pengguna: Menampilkan pesan sukses atau pesan error setelah operasi CRUD.


