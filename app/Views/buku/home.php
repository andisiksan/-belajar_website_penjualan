<?= $this->extend('layout/template'); ?>



<?= $this->section('content'); ?>

<?php if (session()->role_id == 1) : ?>

    <div class="buku container">
        <div class="row">
            <div class="col">
                <h1 class="mt-4">Daftar buku</h1>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-dark" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>


                <a href="/home/create/"><button type="button" class="btn btn-primary">Tambah Buku</button></a>
                <a href="/kategori/index/"><button type="button" class="btn btn-primary">Kategori</button></a>

            </div>
        </div>






        <div class="row">
            <div class="col">



                <table class="table table-responsive-sm table-responsive-md">
                    <thead>

                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">judul</th>
                            <th scope="col">sampul</th>
                            <th scope="col">kategori</th>
                            <th scope="col">stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php $jumlahbuku = 0; ?>
                        <?php foreach ($buku as $b) : ?>
                            <?php $jumlahbuku += $b['stok'] ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $b['judul']; ?></td>
                                <td><img src="<?= base_url(); ?>/img/<?= $b['sampul']; ?>" alt="" class="sampul" width="50px" height="50px"></td>
                                <!-- <td>= $b['kategori'] </td> -->
                                <td><?= $b['nama_kategori'] ?></td>
                                <td><?= $b['stok'] ?></td>
                                <td><?= number_to_currency($b['harga'], 'IDR'); ?></td>

                                <td><a href="/home/detail/<?= $b['id_buku']; ?>" type="button" class="btn btn-success">Detail</a></td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td>jumlah buku</td>
                            <td><?= $jumlahbuku; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

</div>
</div>

<?= $this->endSection(); ?>