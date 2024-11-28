<?php
if (isset($_POST['tambah'])) {
    $servis = $_POST['nama_servis'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // sql = structur query language / DML = data manipulation language
    // select, insert, update, delete
    $insert = mysqli_query($koneksi, "INSERT INTO type_of_service
    (service_name,price,description) VALUES 
    ('$servis','$harga','$deskripsi')");
    header("location:?pg=servis&tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query(
    $koneksi,
    "SELECT * FROM type_of_service WHERE id = '$id'"
);
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $servis = $_POST['nama_servis'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // ubah user kolom apa yang mau di ubah (SET), yang mau di ubah id ke berapa
    $update = mysqli_query($koneksi, "UPDATE type_of_service SET service_name='$servis' WHERE id='$id'");
    header("location:?pg=servis&ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM type_of_service WHERE id='$id'");
    header("location:?pg=servis&hapus=berhasil");
}


?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border border-black border-2 p-3">
                <legend class="float-none w-auto px-3"><?php echo nameOfPage() ?> Servis </legend>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Servis </label>
                        <input type="text"
                            class="form-control"
                            name="nama_servis"
                            placeholder="Masukkan jenis servis"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['service_name'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Harga </label>
                        <input type="text"
                            class="form-control"
                            name="harga"
                            placeholder="Masukkan Harga"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['price'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi</label>
                        <input type="text"
                            class="form-control"
                            name="deskripsi"
                            placeholder="Masukkan nama kategori"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['description'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <button name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>