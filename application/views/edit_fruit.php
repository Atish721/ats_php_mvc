<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// print_r($data); die;
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Fruit</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>

<body>
    <?php include "components/nav.php"; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <h2>Update Fruit Form</h2>
                <form action="<?php echo BASEURL; ?>profile/updateFruit" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Fruit Name..." value="<?php echo $data->name; ?>">
                        <div class="error">
                            <?php if ($nameError) { echo $nameError;
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" name="price" class="form-control" placeholder="Fruit Price..." value="<?php echo $data->price; ?>">
                        <div class="error">
                            <?php if ($priceError) { echo $priceError;
                            } ?>
                        </div>
                        <input type="hidden" name="hiddenId" value="<?php echo $data->id; ?>">
                    </div>

                    <div class="form-group">
                        <select name="quality" class="form-control" value="<?php echo $data->quality; ?>">
                            <option value="">Select Quality</option>
                            <option <?php if (isset($data->quality) && $data->quality == 'a') { echo "selected='selected'";
                                    } ?> value="a">A</option>
                            <option <?php if (isset($data->quality) && $data->quality == 'b') { echo "selected='selected'";
                                    } ?> value="b">B</option>
                            <option <?php if (isset($data->quality) && $data->quality == 'c') { echo "selected='selected'";
                                    } ?> value="c">C</option>
                        </select>
                        <div class="error">
                            <?php if ($qualityError) { echo $qualityError;
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Update Fruit" class="btn btn-primary float-right">
                    </div>

                </form>
            </div>
            <!-- Close col-md-5 -->
        </div>
        <!-- Close row -->
    </div>
    <?php include "components/footer.php"; ?>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    <?php linkJS('assets/js/jquery.dataTables.min.js'); ?>
    <?php linkJS('assets/js/dataTables.bootstrap4.min.js'); ?>

</body>

</html>