<?= $this->extend('layouts/template_authenticate') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-sm-center">
        <div class="col-sm-auto">
            <div class="card my-5" style="width: 25rem;">
                <div class="card-body">
                    <img src="<?= base_url() ?>/assets/images/coralis-studio.png" class="card-img-top mb-3" alt="Coralis Studio Logo">
                    <?= session()->getFlashdata('message') ?>
                    <h5 class="card-title mb-3">Type Email here</h5>
                    <form method="post" action="<?= base_url() ?>/submit-forget-password" class="needs-validation" novalidate>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                            <label for="email">Email address</label>
                            <div class="invalid-feedback">
                                Your Email is required.
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="d-grid gap">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="d-grid gap">
                                <a class="btn btn-success" href="<?= base_url() ?>">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- script for validation -->
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            console.log(form)
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<?= $this->endSection() ?>