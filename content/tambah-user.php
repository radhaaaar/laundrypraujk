<?php
// $queryUser = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC");
if (isset($_POST['tambah'])) {
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $password = ($_POST['password']);
    $idLevel = $_POST['id_level'];


    // sql = structur query language / DML = data manipulation language
    // select, insert, update, delete
    $insert = mysqli_query($koneksi, "INSERT INTO user 
    (name, email, password, id_level) VALUES 
    ('$nama','$email','$password','$idLevel')");
    header("location:?pg=user&tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query(
    $koneksi,
    "SELECT * FROM user WHERE id = '$id'"
);
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    if ($_POST['password']) {
        $password = ($_POST['password']);
    } else {
        $password = $rowEdit['password'];
    }
    // $password = ($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];

    // ubah user kolom apa yang mau di ubah (SET), yang mau di ubah id ke berapa
    $update = mysqli_query($koneksi, "UPDATE user SET name='$nama', 
    email='$email', password='$password' WHERE id='$id'");
    header("location:?pg=user&ubah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");
    header("location:?pg=user&hapus=berhasil");
}
$queryKategori = mysqli_query($koneksi, "SELECT * FROM user LEFT JOIN level ON user.id_level=level.id");

$queryLevel = mysqli_query($koneksi, "SELECT * FROM level");
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border border-black border-2 p-3">
                <legend class="float-none w-auto px-3"><?php echo nameOfPage() ?> User</legend>


                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama </label>
                        <input type="text"
                            class="form-control"
                            name="nama"
                            placeholder="Masukkan nama anda"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['name'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email </label>
                        <input type="email"
                            class="form-control"
                            name="email"
                            placeholder="Masukkan email anda"
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Level </label>
                        <select name="id_level" id="" class="form-control">
                            <option value="">Pilih Kategori</option>
                            <!-- option yang datanya di ambil dri tbl kategori -->
                            <?php while ($rowKategori = mysqli_fetch_assoc($queryLevel)): ?>
                                <option <?php echo isset($_GET['edit']) ? ($rowKategori['id'] == $rowEdit['id_level'] ? 'selected' : '') : '' ?> value="<?php echo $rowKategori['id'] ?>"><?php echo $rowKategori['level_name'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password </label>
                        <input type="password"
                            class="form-control"
                            name="password"
                            placeholder="Masukkan password anda">
                        <div class="mb-3">
                            <button name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                </form>

            </fieldset>
        </div>
    </div>
</div>