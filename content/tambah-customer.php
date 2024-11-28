<?php
if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama_anggota'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    // sql = structur query language / DML = data manipulation language
    // select, insert, update, delete
    $insert = mysqli_query($koneksi, "INSERT INTO customer 
    (customer_name, phone, adress) VALUES 
    ('$nama','$telepon','$alamat')");
    header("location:?pg=customer&tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query(
    $koneksi,
    "SELECT * FROM customer WHERE id = '$id'"
);
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama   = $_POST['nama_anggota'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];


    // ubah user kolom apa yang mau di ubah (SET), yang mau di ubah id ke berapa
    $update = mysqli_query($koneksi, "UPDATE customer SET customer_name='$nama', 
    phone='$telepon',
    adress='$alamat' WHERE id='$id'");
    header("location:?pg=customer&ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM customer WHERE id='$id'");
    header("location:?pg=customer&hapus=berhasil");
}


?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border border-black border-2 p-3">
                <legend class="float-none w-auto px-3"><?php echo nameOfPage() ?> Customer</legend>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama </label>
                        <input type="text"
                            class="form-control"
                            name="nama_anggota"
                            placeholder="Masukkan nama anda"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['customer_name'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Telepon </label>
                        <input type="number"
                            class="form-control"
                            name="telepon"
                            placeholder="Masukkan telepon anda"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat</label>
                        <input type="alamat"
                            class="form-control"
                            name="alamat"
                            placeholder="Masukkan email anda"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['adress'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <button name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>