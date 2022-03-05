<?= $this->extend('layout/template'); ?>



<?= $this->section('content'); ?>

<div class="buku container">
    <div class="row">
        <div class="col">
            <h1 class="mt-4">Daftar kategori</h1>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-dark" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <a href="/kategori/create/"><button type="button" class="btn btn-primary">Tambah Kategori</button></a>
            <a href="/home/"><button type="button" class="btn btn-secondary">kembali</button></a>
        </div>
    </div>
    <table class="table">
        <thead>

            <tr>
                <th scope="col">No</th>
                <th scope="col">judul</th>
                <th scope="col">sampul</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($kategori as $k) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $k['nama_kategori']; ?></td>
                    <td><img src="<?= base_url(); ?>/img/<?= $k['sampul_kategori']; ?>" alt="" class="sampul" width="50px"></td>

                    <!-- aksi -->
                    <td>
                        <form action="/kategori/delete/<?= $k['id_kategori']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <!-- <input type="hidden" name="_method" value="DELETE"> -->
                            <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin')">Delete</button>
                        </form>
                    </td>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</div>

<?= $this->endSection(); ?>