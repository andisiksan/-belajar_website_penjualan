<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card mb-3 mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $keranjang['judul']; ?></h5>
                    <p class="card-text"><?= $keranjang['harga']; ?></p>






                    <br>
                    <br>
                    <p class="card-text"><small class="text-muted">Dibuat pada <?= $keranjang['created_at']; ?></small></p>
                    <p class="card-text"><small class="text-muted">Diperbaharui pada <?= $keranjang['updated_at']; ?></small></p>
                    <a class="btn btn-secondary mb-4" href="/home" role="button">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mb-3 mt-4">
                <img src="<?= base_url(); ?>/img/<?= $keranjang['sampul']; ?>" alt="card-img">
                <div class="card-body">
                    <h5 class="card-title"><?= $keranjang['judul']; ?></h5>
                    <p class="card-text"><?= $keranjang['sinopsis']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>