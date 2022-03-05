<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <h1 class="mt-4 col-6">form Edit Buku</h1>
        <div class="col">
            <form action="/home/update/<?= $buku['id_buku']; ?>" method="POST" enctype="multipart/form-data">

                <?= csrf_field(); ?>
                <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">

                <!-- nama sampul lama -->
                <input type="hidden" name="sampulLama" value="<?= $buku['sampul']; ?>">

                <div class="form-group row mt-4">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= $buku['judul']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>




                <div class="form-group row mt-4">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-6">
                        <select name="kategori" class="form-control" id="exampleFormControlSelect1">
                            <?php foreach ($kategori as $k) : ?>
                                <option <?= $buku['id_kategori'] == $k['id_kategori'] ? 'selected' : ''; ?> value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>










                <div class="form-group row mt-4">
                    <label for="harga" class="col-sm-2 col-form-label">harga</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" autofocus value="<?= $buku['harga']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="stok" class="col-sm-2 col-form-label">jumlah stok</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" autofocus value="<?= $buku['stok']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('stok'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="sampul" class="col-sm-2 col-form-label">sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $buku['sampul']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-4">
                        <div class="custom-file">
                            <!-- untuk mngupload dalam bntuk file harus mnggunakan  enctype="multipart/form-data diatas dkt post -->
                            <input type="file" class="custom-file-input  <?= ($validation->hasError('sampul')) ?
                                                                                'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                            <label class="custom-file-label" for="customFile"><?= $buku['sampul']; ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="sinopsis" class="col-sm-2 col-form-label">sinopsis</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('sinopsis')) ? 'is-invalid' : ''; ?>" id="sinopsis" name="sinopsis" autofocus value="<?= $buku['sinopsis']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('sinopsis'); ?>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10 mt-4">
                        <button type="submit" class="btn btn-primary">Perbaharui</button>
                    </div>
                </div>
            </form>

            <br>
            <br>
            <a class="btn btn-secondary" href="/home" role="button">Kembali ke Halaman Utama</a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>