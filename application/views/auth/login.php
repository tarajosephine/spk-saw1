<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">
                    <div class="card-header text-center bg-primary">
                        <a href="index.html">
                            <span><img src="<?= base_url(); ?>assets/images/sayaka.jpeg" alt=""
                                    height="100"></span>
                        </a>
                    </div>

                    <div class="card-body p-3">
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold">Login</h4>
                            <p class="text-muted mb-4">
                                <!-- <span><img src="<?= base_url(); ?>assets/images/" alt="" height="40"></span> -->
                            </p>
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                        <form method="POST" action="<?= base_url() ?>auth">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    placeholder="Masukan username anda" autofocus>
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="mb-3">
                                <a href="<?= base_url('auth/forgotPassword') ?>"
                                    class="text-muted float-end"><small>Forgot your password?</small></a>
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Masukan Password anda">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Masuk Aplikasi </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
