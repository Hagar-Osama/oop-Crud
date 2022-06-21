<?php include "includes/header.php" ?>
<?php include "includes/navbar.php";

$_SESSION['error'] = '';
$_SESSION['success'] = '';
$departments = ['it', 'cs', 'web'];
$row = $database->findRecord('employees', $_GET['id']);
if (isset($_GET['id']) && is_numeric($_GET['id']) && $row  ) {
    if (isset($_POST['update'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $department = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($name)) {
            $_SESSION['error'] = 'please Enter Name';
        } elseif (strlen($name) > 100) {
            $_SESSION['error'] = 'name must be less than 100';
        } elseif (strlen($name) < 6) {
            $_SESSION['error'] = 'name must be greater than 5';
        }

        if (empty($email)) {
            $_SESSION['email'] = 'please enter Email';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'please Enter a valid Email';
        }
        $department = strtolower($department);
        if (empty($department)) {
            $_SESSION['error'] = 'please enter Departemnt';
        } elseif (!in_array($department, $departments)) {
            $_SESSION['error'] = 'department Not Found';
        }
        if (empty($password)) {
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = $database->hashPassword($password);
        } else {
            $password = $row['password'];
        }
        // if (! empty($password)) {
        //     $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //     if (strlen($password) >= 6) {
        //         $password = $database->hashPassword($password);
        //     } else {
        //         $_SESSION['error'] = 'Password must be greater than 5';
        //     }

        // } else {
        //     $password = $row['password'];
        // }
        if (!empty($_SESSION['error'])) {
          $_SESSION['error'];
        } else {
            $sql = "UPDATE employees SET `name` = '$name', email = '$email', `password` = '$password',
            department = '$department' WHERE `id` = '$row[id]'";
            $_SESSION['success'] = $database->update($sql);
        }
    }
}













?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary"> Edit Employee</h2>

        </div>
    </div>
    <?php if (!empty($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <span><?= $_SESSION['success']; ?></span>
        </div>
    <?php endif; ?>
    <?php if (! empty($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <span><?= $_SESSION['error'];?></span>
            </div>
            <?php endif;?>

    <form class="row g-3" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="col-md-12">
            <label for="inputNamel4" class="form-label">Name</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" id="inputEmail4">
          
        </div>
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control" id="inputEmail4">
         
        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword4">
           

        </div>
        <div class="col-md-12">
            <label for="inputDepartment4" class="form-label">Department Name</label>
            <input type="text" name="department" value="<?php echo $row['department']; ?>" class="form-control" id="inputPassword4">
        

        </div>

        <div class="col-12">
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>




















<?php unset($_SESSION['error']);
unset($_SESSION['success']); ?>
<?php include "includes/footer.php" ?>