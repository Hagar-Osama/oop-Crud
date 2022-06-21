<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary">All Employee</h2>
            <?php if (! empty($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <span><?= $_SESSION['success'];?></span>
            </div>
            <?php endif;?>

        </div>
    </div>
<?php if(count($database->readData('employees')))   :  ?>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Department Name</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
        <?php foreach($database->readData('employees') as $row) : ?>

            <tr>
                <th scope="row"><?= $i++;?></th>
                <td><?php echo strtoupper($row['name']);?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo strtoupper($row['department']);?></td>
                <td>
                <a href="<?= URL;?>edit.php?id=<?= $row['id'];?>" class="btn btn-warning">Edit</a>
                <a href="<?= URL;?>delete.php?id=<?=$row['id'];?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach;?>
           
            </tr>
        </tbody>
    </table>
</div>
<?php else : ?>
    <div class="col-sm-12">
        <h3 class="alert alert-danger mt-5 text-center">No Data Found</h3>
    </div>
    <?php endif;?>

















<?php unset($_SESSION['success']);?>
<?php include "includes/footer.php" ?>