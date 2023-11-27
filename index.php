<?php
    //koneksi database
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "db_konveksi";

    $koneksi = mysqli_connect($server, $user, $password, $database) or die("". mysqli_error($koneksi));

    

    //tombol simpan
    if(isset($_POST['bsimpan'])){

        if(isset($_GET['hal']) == "edit"){
            $edit = mysqli_real_query($koneksi,"UPDATE tpesanan SET nama = '$_POST[tcons]', jenis_barang = '$_POST[tjenis]', jumlah = '$_POST[tjumlah]', satuan = '$_POST[tsatuan]', tggl_pesan = '$_POST[tdate]' WHERE id_pesanan = '$_GET[id]' ");
            if($edit){
                echo "<script>
                      alert('Edit Data Sukses!');
                      document.location='index.php';
                    </script>";
            }else{
                echo "<script>
                      alert('Edit Data Gagal!');
                      document.location='index.php';
                    </script>";
            }
        }else{
            $simpan = mysqli_query($koneksi,"INSERT INTO tpesanan (kode_pesanan, nama, jenis_barang, jumlah, satuan, tggl_pesan)
        VALUE ('$_POST[tkode]', '$_POST[tcons]', '$_POST[tjenis]', '$_POST[tjumlah]', '$_POST[tsatuan]', '$_POST[tdate]')");
        if($simpan){
            echo "<script>
                  alert('Simpan Data Sukses!');
                  document.location='index.php';
                </script>";
        }else{
            echo "<script>
                  alert('Simpan Data Gagal!');
                  document.location='index.php';
                </script>";
        }
        }

        
    }
    $vkode = "";
    $vcons = "";
    $vjenis = "";
    $vjumlah = "";
    $vsatuan = "";
    $vdate = "";
    //tombol edit dan hapus
    if(isset($_GET['hal'])){
        if($_GET['hal'] == 'edit'){
            $tampil = mysqli_query($koneksi,"SELECT * FROM tpesanan WHERE id_pesanan = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $vkode = $data['kode_pesanan'];
                $vcons = $data['nama'];
                $vjenis = $data['jenis_barang'];
                $vjumlah = $data['jumlah'];
                $vsatuan = $data['satuan'];
                $vdate = $data['tggl_pesan'];
            }
        }else if($_GET['hal'] == "hapus"){
            $hapus = mysqli_query($koneksi,"DELETE FROM tpesanan WHERE id_pesanan = '$_GET[id]' ");
            if($hapus){
                echo "<script>
                      alert('Hapus Data Sukses!');
                      document.location='index.php';
                    </script>";
            }else{
                echo "<script>
                      alert('Hapus Data Gagal!');
                      document.location='index.php';
                    </script>";
            }
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>My Konveksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="text/javascript" src="jquery.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg  bg-primary">
            <div class="container-fluid text-light">
              <a class="navbar-brand fs-3 ms-5" href="#">KONVEKSI</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse flex-row-reverse p-2 me-5" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="about.php">Tentang kami</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <h2 class="container aria-label ms-7">DASHBOARD</h2>
    <div class="d-grid gap-2 col-md-4 mx-auto">
        <button id="tampil" class="btn btn-primary" type="button">Tampilkan Tabel Input</button>
        <button id="sembunyi" class="btn btn-danger" type="button">Sembunyikan Tabel Input</button>
    </div>
        
    <div class="col-md-7 mt-3 mx-auto" ">
        <div class="card" id="input">
            <div class="card-header bg-primary  text-light">
                Form Input Data Pesanan
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label  class="form-label">Kode Pesanan</label>
                        <input type="text" name="tkode" value="<?= $vkode ?>" class="form-control" placeholder="Masukan Kode Barang">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Nama Pembeli</label>
                        <input type="text" name="tcons" value="<?= $vcons ?>" class="form-control" placeholder="Masukan Nama pembeli">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Barang</label>
                        <select class="form-select" name="tjenis">
                            <option value="<?= $vjenis ?>" ><?= $vjenis ?></option>
                            <option value="Seragam">Seragam</option>
                            <option value="Kaos">Kaos</option>
                            <option value="Jaket">Jacket</option>
                            <option value="Jas">Jas</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label  class="form-label">Jumlah</label>
                                <input type="number" name="tjumlah" value="<?= $vjumlah ?>" class="form-control" placeholder=" Masukan Jumlah Barang">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label  class="form-label">Satuan</label>
                                <select class="form-select" name="tsatuan" >
                                    <option value="<?= $vsatuan ?>"><?= $vsatuan ?></option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Lusin">Lusin</option>
                                    <option value="Group">Group</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label  class="form-label">Tanggal Pembelian</label>
                                <input type="date" name="tdate" value="<?= $vdate ?>" class="form-control">
                            </div>
                        </div>
                        <div class="text-center">
                            <hr>
                            <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                            
                        </div>
                    </div>
                </form>
                </div>
            <div class="card-footer bg-primary">
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#sembunyi").click(function(){$("#input").hide("slow");
            $("#tampil").click(function(){$("#input").show("slow");});});
        });
    </script>
    <div class="col-md-9 mx-auto mt-5">
        <div class="card ">
            <div class="card-header bg-primary  text-light">
                Data Pesanan
            </div>
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" value="<?=@$_POST['tcari']?>" class="form-control" placeholder="Masukan Kata Kunci">
                            <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                            
                        </div>
                    </form>
                </div>
                <table class="table table-info table-hover table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        <th>Nama Pembeli</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah</th>
                        <th>Tggl Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $no = 1;

                    if(isset($_POST['bcari'])){
                        $key = $_POST['tcari'];
                        $q = "SELECT * FROM tpesanan WHERE kode_pesanan like '%$key%' or nama like '%$key%' order by id_pesanan desc ";
                    }else {
                        $q = "SELECT * FROM tpesanan order by id_pesanan desc";
                    }

                    $tampil = mysqli_query($koneksi, $q);
                    while($data = mysqli_fetch_array($tampil)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['kode_pesanan'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['jenis_barang'] ?></td>
                            <td><?= $data['jumlah'] ?> <?= $data['satuan'] ?></td>
                            <td><?= $data['tggl_pesan'] ?></td>
                            <td>
                                <a href="index.php?hal=edit&id=<?=$data['id_pesanan'] ?>" class="btn btn-warning">Edit</a>

                                <a href="index.php?hal=hapus&id=<?=$data['id_pesanan'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Mengapus Data Tersebut?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }?>
                </table>
            </div>
            <div class="card-footer bg-primary">
            </div>
        </div>
    </div>
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>