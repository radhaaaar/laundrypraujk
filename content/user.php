<?php
$user = mysqli_query($koneksi, "SELECT user.*, level.level_name FROM user LEFT JOIN level ON user.id_level=level.id ");
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border border-black border-2 p-3">
                <legend class="float-none w-auto px-3">Data User</legend>
                <div align="right">
                    <a href="?pg=tambah-user" class="btn btn-primary">Tambah</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover mt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>level</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($rowUser = mysqli_fetch_assoc($user)):
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $rowUser['level_name'] ?></td>
                                    <td><?php echo $rowUser['name'] ?></td>
                                    <td><?php echo $rowUser['email'] ?></td>

                                    <td>
                                        <a id="edit-user" data-id="<?php echo $rowUser['id'] ?>" href="?pg=tambah-user&edit=<?php echo $rowUser['id'] ?>"
                                            class="btn btn-success btn-sm">Edit

                                        </a> |
                                        <a
                                            href="?pg=tambah-user&delete=<?php echo $rowUser['id'] ?>"
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