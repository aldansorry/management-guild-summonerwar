<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('includes/head') ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo base_url(); ?>"><b>Admin</b>LTE</a>
        </div>
        <?php if ($this->session->flashdata('login_message') != null) : ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('login_message') ?>
            </div>
        <?php endif ?>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Email" value="<?php echo set_value('username') ?>">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <?php echo form_error('username', '<span class="text-danger">', '</span>') ?>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <?php echo form_error('password', '<span class="text-danger">', '</span>') ?>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>

            <a href="#">I forgot my password</a><br>
            <a href="register.html" class="text-center">Register a new membership</a>

        </div>
    </div>

    <?php $this->load->view('includes/foot') ?>

    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>

</html>