<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <form action="/home/save" method="POST" enctype="multipart/form-data">
                <div class="form-group row mt-4">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>


                <div class="form-group row mt-4">
                    <label for="kategori" class="col-sm-2 col-form-label">kategori</label>
                    <div class="col-sm-6">
                        <select name="kategori" class="form-control" id="exampleFormControlSelect1">
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>

                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>



                <div class="form-group row mt-4">
                    <label for="harga" class="col-sm-2 col-form-label">harga</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" autofocus value="<?= old('harga'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="stok" class="col-sm-2 col-form-label">jumlah stok</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" autofocus value="<?= old('stok'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('stok'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-4">
                        <div class="custom-file">
                            <!-- untuk mngupload dalam bntuk file harus mnggunakan  enctype="multipart/form-data diatas dkt post -->
                            <input type="file" class="custom-file-input  <?= ($validation->hasError('sampul')) ?
                                                                                'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                            <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="sinopsis" class="col-sm-2 col-form-label">sinopsis</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('sinopsis')) ? 'is-invalid' : ''; ?>" id="sinopsis" name="sinopsis" autofocus value="<?= old('sinopsis'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('sinopsis'); ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group row mt-4">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label for="jumlah_stok" class="col-sm-2 col-form-label">Jumlah Stok</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="jumlah_stok" name="jumlah_stok">
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label for="sinopsis" class="col-sm-2 col-form-label">Sinopsis</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="sinopsis" rows="4" name="sinopsis"></textarea>
                        </div>
                    </div> -->

                <div class="form-group row">
                    <div class="col-sm-10 mt-4">
                        <button type="submit" class="btn btn-primary">Tambah</button>
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