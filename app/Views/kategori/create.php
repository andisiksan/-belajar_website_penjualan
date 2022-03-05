<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <form action="/kategori/save" method="POST" enctype="multipart/form-data">
                <div class="form-group row mt-4">
                    <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_kategori')) ? 'is-invalid' : ''; ?>" id="nama_kategori" name="nama_kategori" autofocus value="<?= old('nama_kategori'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_kategori'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <label for="sampul_kategori" class="col-sm-2 col-form-label">Sampul kategori</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-4">
                        <div class="custom-file">
                            <!-- untuk mngupload dalam bntuk file harus mnggunakan  enctype="multipart/form-data diatas dkt post -->
                            <input type="file" class="custom-file-input  <?= ($validation->hasError('sampul_kategori')) ?
                                                                                'is-invalid' : ''; ?>" id="sampul_kategori" name="sampul_kategori" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('sampul_kategori'); ?>
                            </div>
                            <label class="custom-file-label" for="customFile">Pilih Gambar</label>
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