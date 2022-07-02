<?= $this->extend('layouts/template_dashboard') ?>

<?= $this->section('content') ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="card mb-3 p-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url() ?>/assets/images/<?= $image_profile ?>" class="img-fluid rounded-start" alt="Profile Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0"><?= $email ?></li>
                        <li class="list-group-item px-0"><?= $name ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>


<?= $this->endSection() ?>