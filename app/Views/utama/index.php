<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-dark" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>
    <div class="col">

        <div class="form-group row mt-4">
            <label for="kategori" class="col-sm-2 col-form-label">kategori</label>
            <div class="col-sm-6">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Pilih kategori
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <?php foreach ($kategori as $k) : ?>
                            <form action="" method="POST">
                                <button type="submit" class="dropdown-item">
                                    <input type="hidden" name="kategorikeyword" value="<?= $k['id_kategori']; ?>">
                                    <?= $k['nama_kategori']; ?>
                                </button>
                            </form>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <?php foreach ($buku as $b) : ?>
                <div class=" col-sm-12 col-md-6 col-lg-3">
                    <div class="col-xl-12 col-md-12 mb-4">
                        <form action="/utama/savekeranjang" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_buku" value="<?= $b['id_buku']; ?>">
                            <input type="hidden" name="id_user" value="2">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="card border-left shadow h-100 py-2">
                                <div class="card-body">
                                    <img class="card-img-top" src="<?= base_url(); ?>/img/<?= $b['sampul']; ?>" class="sampul" max-width="50px" alt="Card image cap" id="gambar">
                                    <h5 class="card-title"><?= $b['judul']; ?></h5>
                                    <p class="card-text"><?= number_to_currency($b['harga'], 'IDR'); ?></p>
                                    <p class="card-text"><?= $b['sinopsis']; ?></p>
                                    <p class="card-text">Stok <?= $b['stok']; ?></p>



                                    <p><select class="form-select" aria-label="Disabled select example" name="jumlah_beli">

                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select></p>




                                    <button type="submit" class="btn btn-primary">tambah ke keranjang</button>







                                    <!-- <a class="btn btn-success" href="#" role="button">chekout</a> -->

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>







    </div>
</div>

<?= $this->endSection(); ?>