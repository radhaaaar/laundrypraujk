<?php
$kategori = mysqli_query($koneksi, "SELECT * FROM type_of_service ORDER BY id DESC");
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border border-black border-2 p-3">
                <legend class="float-none w-auto px-3">Data Jenis Servis</legend>
                <div align="right">
                    <a href="?pg=tambah-servis" class="btn btn-primary">Tambah</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Servis</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($rowKategori = mysqli_fetch_assoc($kategori)):
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowKategori['service_name'] ?></td>
                                    <td><?php echo $rowKategori['price'] ?></td>
                                    <td><?php echo $rowKategori['description'] ?></td>
                                    <td>
                                        <a id="edit-user" data-id="<?php echo $rowKategori['id'] ?>" href="?pg=tambah-servis&edit=<?php echo $rowKategori['id'] ?>"
                                            class="btn btn-success btn-sm">Edit

                                        </a> |
                                        <a
                                            href="?pg=tambah-servis&delete=<?php echo $rowKategori['id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda yakin akan menghapus data ini??')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</div>