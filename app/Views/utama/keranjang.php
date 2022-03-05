<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-dark" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>

                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">judul</th>
                        <th scope="col">sampul</th>
                        <th scope="col">stok</th>
                        <th scope="col">jumlah beli</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php $jumlah = 0; ?>

                    <?php foreach ($keranjang as $k) : ?>
                        <?php $jumlah += $k['harga']; ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $k['judul']; ?></td>
                            <td><img src="<?= base_url(); ?>/img/<?= $k['sampul']; ?>" alt="" class="sampul" width="50px" height="50px"></td>
                            <!-- <td>= $b['kategori'] </td> -->
                            <td><?= $k['stok'] -= $k['jumlah_beli']; ?></td>
                            <td><?= $k['jumlah_beli'] ?></td>
                            <td><?= number_to_currency($k['harga'], 'IDR'); ?></td>
                            <td>

                                <form action="/utama/cancel/<?= $k['id_keranjang']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_keranjang" value="<?= $k['id_keranjang']; ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin')">Cancel</button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    <hr>
                    <tr>
                        <td colspan="5"> jumlah bayar</td>
                        <td> <?= number_to_currency($jumlah, 'IDR'); ?> </td>
                    </tr>

                    <!-- diskon30% diatas pembelian 500000-->

                    <?php $diskon = 0.7; ?>

                    <?php if ($jumlah > 500000) {
                        $total = $jumlah * $diskon;
                    } else {
                        $total = $jumlah;
                    } ?>




                    <br>
                    <tr>
                        <td colspan="5"> total bayar </td>
                        <td> <?= number_to_currency($total, 'IDR'); ?> </td>
                    </tr>



                </tbody>
            </table>



        </div>
    </div>
</div>





<?= $this->endSection(); ?>