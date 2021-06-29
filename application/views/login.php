<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php include "components/header.php"; ?>
</head>

<body>
    <?php include "components/nav.php"; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php $this->flash('accountCreated', 'alert alert-success') ?>
                <h2>User Login</h2>
                <form action="<?php echo BASEURL; ?>user-login" method="POST">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email..." value="<?php if (!empty($email)) {
                                                                                                                echo $email;
                                                                                                            } ?>">
                        <div class="error">
                            <?php if (!empty($emailError)) {
                                echo $emailError;
                            } ?>
                        </div>
                    </div>
                    <!-- Close form-group -->
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password..." value="<?php if (!empty($password)) {
                                                                                                                            echo $password;
                                                                                                                        } ?>">
                        <div class="error">
                            <?php if (!empty($passwordError)) {
                                echo $passwordError;
                            } ?>
                        </div>
                    </div>
                    <!-- Close form-group -->
                    <div class="form-group">
                        <input type="submit" name="lginBtn" class="btn btn-primary float-right" value="Login">
                    </div>
                    <!-- Close form-group -->

                </form>
            </div>
            <!-- Close col-md-5 -->
        </div>
        <!-- Close row -->
    </div>
    <!-- Close container -->

    <?php include "components/footer.php"; ?>
</body>

</html>