<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card mb-3 mt-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $buku['judul']; ?></h5>
                    <p class="card-text"><?= $buku['harga']; ?></p>

                    <a href="/home/edit/<?= $buku['id_buku']; ?>"><button type="button" class="btn btn-warning">Update</button></a>

                    <form action="/home/delete/<?= $buku['id_buku']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <!-- <input type="hidden" name="_method" value="DELETE"> -->
                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin')">Delete</button>
                    </form>




                    <br>
                    <br>
                    <p class="card-text"><small class="text-muted">Dibuat pada <?= $buku['created_at']; ?></small></p>
                    <p class="card-text"><small class="text-muted">Diperbaharui pada <?= $buku['updated_at']; ?></small></p>
                    <a class="btn btn-secondary mb-4" href="/home" role="button">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mb-3 mt-4">
                <img src="<?= base_url(); ?>/img/<?= $buku['sampul']; ?>" alt="card-img">
                <div class="card-body">
                    <h5 class="card-title"><?= $buku['judul']; ?></h5>
                    <p class="card-text"><?= $buku['sinopsis']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>