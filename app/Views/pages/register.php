<?= $this->extend('layouts/template_authenticate') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-sm-center">
        <div class="col-sm-auto">
            <div class="card my-5" style="width: 25rem;">
                <div class="card-body">
                    <img src="<?= base_url() ?>/assets/images/coralis-studio.png" class="card-img-top mb-3" alt="Coralis Studio Logo">
                    <h5 class="card-title mb-3">Register Here</h5>
                    <form method="post" action="<?= base_url() ?>/register/save" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <?= csrf_field() ?>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                            <div class="invalid-feedback">
                                Your Email is required.
                            </div>
                            <?php if (session()->get('validation')) : ?>
                                <div class="text-danger" role="alert">
                                    <p class="p-1"><?= session()->get('validation')->getError('email') ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Mario Haryzal" required name="name">
                            <label for="floatingInput">Name</label>
                            <div class="invalid-feedback">
                                Your Name is required.
                            </div>
                            <?php if (session()->get('validation')) : ?>
                                <div class="text-danger" role="alert">
                                    <p class="p-1"><?= session()->get('validation')->getError('name') ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required oninput="onChangePassword()">
                            <label for="floatingPassword">Password</label>
                            <div class="invalid-feedback">
                                Your Password must have 8 characters.
                            </div>
                            <?php if (session()->get('validation')) : ?>
                                <div class="text-danger" role="alert">
                                    <p class="p-1"><?= session()->get('validation')->getError('password') ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Password" required oninput="onChangePassConfirm()">
                            <label for="floatingPassword">Confirm Password</label>
                            <div class="invalid-feedback">
                                Type Confirm Password correctly.
                            </div>
                        </div>
                        <div class="mb-3">
                            <p>Profile picture</p>
                            <input class="form-control" name="image" type="file" id="formFile" onchange="previewImage()">
                            <?php if (session()->get('validation')) : ?>
                                <div class="text-danger" role="alert">
                                    <p class="p-1"><?= session()->get('validation')->getError('image') ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <img src="<?= base_url() ?>/assets/images/default-images.png" class="img-thumbnail rounded mx-auto d-block" alt="..." id="image-preview" style="width: 25 rem;">
                        </div>
                        <div class="row mb-3">
                            <div class="d-grid gap">
                                <button class="btn btn-primary" type="submit" id="button-submit">Submit</button>
                            </div>
                        </div>

                        <div class="row text-center">
                            <a href="<?= base_url() ?>/login">Back to login</a>
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

            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')

            }, false)
        })
    })()

    const failed = (Element, button) => {
        Element.classList.add("is-invalid");
        button.setAttribute('disabled', '');
    }

    const success = (element, button) => {
        element.classList.remove("is-invalid");
        element.classList.add("is-valid");
        button.removeAttribute('disabled');
    }

    const onChangePassConfirm = () => {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm-password');
        const button = document.getElementById('button-submit')
        if (confirmPassword.value !== password) {
            failed(confirmPassword, button)
        }
        if (confirmPassword.value === password.value) {
            success(confirmPassword, button)
        }

    }

    const onChangePassword = () => {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm-password');
        const button = document.getElementById('button-submit')
        if (confirmPassword.value !== password) {
            failed(confirmPassword, button)
        }
        if (password.value.length < 8) {
            failed(password, button)
        }
        if (password.value.length >= 8) {
            success(password, button)
        }
    }

    function previewImage() {
        const image = document.getElementById('formFile');
        const imagePreview = document.getElementById('image-preview');

        const reader = new FileReader();
        reader.readAsDataURL(image.files[0]);

        reader.onload = function(e) {
            imagePreview.src = e.target.result;
        }

    }
</script>

<?= $this->endSection() ?>