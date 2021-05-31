<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <?php include "components/header.php"; ?>
</head>

<body>
    <?php include "components/nav.php"; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <h2>Add Fruit Form</h2>
                <form action="<?php echo BASEURL; ?>fruit-insert" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Fruit Name..." value="<?php if ($data['name']) {
                                                                                                                    echo $data['name'];
                                                                                                                } ?>">
                        <div class="error">
                            <?php if ($data['nameError']) {
                                echo $data['nameError'];
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" name="price" class="form-control" placeholder="Fruit Price..." value="<?php if ($data['price']) {
                                                                                                                        echo $data['price'];
                                                                                                                    } ?>">
                        <div class="error">
                            <?php if ($data['priceError']) {
                                echo $data['priceError'];
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <select name="quality" class="form-control" value="<?php if ($data['quality']) {
                                                                                echo $data['quality'];
                                                                            } ?>">
                            <option value="">Select Quality</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                            <option value="e">E</option>
                        </select>
                        <div class="error">
                            <?php if ($data['qualityError']) {
                                echo $data['qualityError'];
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                    </div>

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