<?= $this->extend('layouts/template_authenticate') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-sm-center">
        <div class="col-sm-auto">
            <div class="card my-5" style="width: 25rem;">
                <div class="card-body">
                    <img src="<?= base_url() ?>/assets/images/coralis-studio.png" class="card-img-top mb-3" alt="Coralis Studio Logo">
                    <h5 class="card-title mb-3">Type New Password here!</h5>
                    <form method="post" action="<?= base_url() ?>/update-password/save">
                        <?= csrf_field() ?>
                        <div class="form-floating mb-3">
                            <input type="text" value="<?= $email ?>" hidden name="email">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required oninput="onChangePassword()">
                            <label for="floatingPassword">New Password</label>
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
                        <div class="row mb-3">
                            <div class="d-grid gap">
                                <button class="btn btn-primary" type="submit" id="button-submit">Submit</button>
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
        if (confirmPassword.value === password.value && confirmPassword.value.length > 7) {
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
</script>

<?= $this->endSection() ?>