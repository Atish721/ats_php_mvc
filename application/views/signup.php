<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <?php include "components/header.php" ?>
</head>

<body>
    <?php include "components/nav.php"; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h2>Create New Account</h2>
                <form action="<?php echo BASEURL; ?>create_account" method="POST">

                    <div class="form-group">
                        <input type="text" name="fullName" class="form-control" placeholder="Full Name..." value="<?php if (!empty($data['fullName'])) {
                                                                                                                        echo $data['fullName'];
                                                                                                                    } ?>">
                        <div class="error">
                            <?php if (!empty($data['fullNameError'])) {
                                echo $data['fullNameError'];
                            } ?>
                        </div>
                    </div>
                    <!-- Close form-group -->
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email..." value="<?php if (!empty($data['email'])) {
                                                                                                                echo $data['email'];
                                                                                                            } ?>">
                        <div class="error">
                            <?php if (!empty($data['emailError'])) {
                                echo $data['emailError'];
                            } ?>
                        </div>
                    </div>
                    <!-- Close form-group -->
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password..." value="<?php if (!empty($data['password'])) {
                                                                                                                            echo $data['password'];
                                                                                                                        } ?>">
                        <div class="error">
                            <?php if (!empty($data['passwordError'])) {
                                echo $data['passwordError'];
                            } ?>
                        </div>
                    </div>
                    <!-- Close form-group -->
                    <div class="form-group text-center">
                        <input type="submit" name="singupBtn" class="btn btn-primary" value="Submit">
                    </div>

                    <!-- Close form-group -->

                </form>
            </div>
            <!-- Close col-md-5 -->
        </div>
        <!-- Close row -->
    </div>
    <?php include "components/footer.php"; ?>
</body>

</html>