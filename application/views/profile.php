<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard</title>
    <?php include "components/header.php" ?>
    <?php linkCSS("assets/css/dataTables.bootstrap4.min.css"); ?>
</head>

<body>
    <?php include "components/nav.php"; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <?php include "components/messages.php"; ?>
                <div class="float-right col-md-12 mb-5">
                    <a class="btn btn-primary float-right" href="<?= BASEURL ?>add-fruit">Add New Fruit</a>
                </div>
                <table id="example" class="table table-hover table-bordered text-center" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quality</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) { ?>

                            <?php foreach ($data as $k => $fruit) { ?>

                                <tr>
                                    <td><?php echo ucwords($fruit['name']); ?></td>
                                    <td><?php echo $fruit['price'] . " pkr"; ?></td>
                                    <td><?php echo ucwords($fruit['quality']); ?></td>
                                    <td class="text-center"><a href="<?php echo BASEURL; ?>edit-fruit/<?php echo $fruit['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?php echo BASEURL; ?>profile/delete/<?php echo $fruit['id']; ?>" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>


                        <?php }
                        } ?>
                    </tbody>

                </table>
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