<?= $this->extend('layout/sidebar'); ?>



<?= $this->section('content'); ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?> </h1>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img class="img-profile rounded-circle" src="<?= base_url('/template/img/default.jpg'); ?>" width="200px">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name'] ?></h5>
                    <p class="card-text"><?= $user['email'] ?></p>
                    <p class="card-text"><small class="text-muted">Member science <?= date('d F Y', $user['date_created']) ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>



<?= $this->endSection(); ?>