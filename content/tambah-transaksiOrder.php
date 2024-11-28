<?php
if (isset($_POST['simpan'])) {
    $no_peminjaman   = $_POST['order_code'];
    $id_customer   = $_POST['id_customer'];
    $tgl_peminjaman   = $_POST['order_date'];
    $status   = $_POST['order_status'];



    
    // sql = structur query languages / DML = data manipulation language
    // select, insert, update, delete
    $insert = mysqli_query($koneksi, "INSERT INTO trans_order (order_code, id_customer, order_date, order_status) VALUES
    ('$no_peminjaman','$id_customer', '$tgl_peminjaman',  '$status')");
    // $id_customer = mysqli_insert_id($koneksi);
    // foreach ($id_order as $key => $order) {
    //     $id_customer = $_POST['id_customer'][$key];
    //     $insertDetail = mysqli_query($koneksi, "INSERT INTO trans_order_detail (id_order, id_buku) VALUES ('$id_peminjaman', '$id_buku')");
    // }
    header("location:?pg=transaksi&tambah=berhasil");
}



$queryCustomer = mysqli_query($koneksi, "SELECT * FROM customer");
$queryUser = mysqli_query($koneksi, "SELECT * FROM user");
$queryServis = mysqli_query($koneksi, "SELECT * FROM type_of_service");

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query(
    $koneksi,
    "SELECT * FROM user WHERE id = '$id'"
);
$rowUser = mysqli_fetch_assoc($editUser);

// membuat order code
$queryKodeTransaksi = mysqli_query($koneksi, "SELECT MAX(id) AS id_customer FROM trans_order");
$rowTransaksi = mysqli_fetch_assoc($queryKodeTransaksi);
$id_customer = $rowTransaksi['id_customer'];
$id_customer++;
$kode_transaksi = "LDR/" . date('dmy') . "/" . sprintf("%03s", $id_customer);

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border border-black border-2 p-3">
                <legend class="float-none w-auto px-3"><?php echo nameOfPage() ?> Order </legend>
                <form action="" method="post">
                    <div>
                        <label for="">Kode Transaksi</label>
                        <input class="form-control" name="order_code" value="<?php echo isset($_GET['detail']) ? $rowTransaksi['oder_code'] : $kode_transaksi ?>" id="" type="text" class="">
                    </div>
                    <label for="" class="form-label">Nama Customer</label>
                    <select name="id_customer" id="" class="form-control">
                        <option value="">Pilih Customer</option>
                        <!-- option yang datanya di ambil dri tbl kategori -->
                        <?php while ($row = mysqli_fetch_assoc($queryCustomer)): ?>
                            <option <?php echo isset($_GET['edit']) ? ($row['id'] == $rowUser['id_customer'] ? 'selected' : '') : '' ?> value="<?php echo $row['id'] ?>"><?php echo $row['customer_name'] ?></option>
                        <?php endwhile ?>
                    </select>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Order</label>
                        <input type="date"
                            class="form-control"
                            name="order_date"
                            placeholder="Masukkan nama kategori"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_buku'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Batas Waktu </label>
                        <input type="date"
                            class="form-control"
                            name="penerbit"
                            placeholder="Masukkan Penerbit"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['penerbit'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Petugas </label>
                        <select name="id_kategori" id="" class="form-control">
                            <option value="">Pilih Petugas</option>
                            <!-- option yang datanya di ambil dri tbl kategori -->
                            <?php while ($rowUser = mysqli_fetch_assoc($queryUser)): ?>
                                <option <?php echo isset($_GET['edit']) ? ($rowKategori['id'] == $rowEdit['id_kategori'] ? 'selected' : '') : '' ?> value="<?php echo $rowKategori['id'] ?>"><?php echo $rowUser['name'] ?></option>
                            <?php endwhile ?>
                        </select>
                        <!-- <input type="text"
                            class="form-control"
                            name="tahun_terbit"
                            placeholder="Masukkan Tahun Terbit"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['tahun_terbit'] : '' ?>"> -->
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jenis Service</label>
                        <select name="id_kategori" id="" class="form-control">
                            <option value="">Jenis Servis</option>
                            <!-- option yang datanya di ambil dri tbl kategori -->
                            <?php while ($rowServis = mysqli_fetch_assoc($queryServis)): ?>
                                <option <?php echo isset($_GET['edit']) ? ($rowKategori['id'] == $rowServis['id_kategori'] ? 'selected' : '') : '' ?> value="<?php echo $rowKategori['id'] ?>"><?php echo $rowServis['service_name'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>






<?php
