<?php include "includes/header.php" ?>
<?php include "includes/navbar.php";

$_SESSION['name'] = '';
$_SESSION['email'] = '';
$_SESSION['password'] = '';
$_SESSION['department'] = '';
$_SESSION['success'] = '';
$departments = ['it', 'cs', 'web'];

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $department = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($name)) {
        $_SESSION['name'] = 'please Enter Name';
    } elseif (strlen($name) > 100) {
        $_SESSION['name'] = 'name must be less than 100';
    } elseif (strlen($name) < 6) {
        $_SESSION['name'] = 'name must be greater than 5';
    }

    if (empty($email)) {
        $_SESSION['email'] = 'please enter Email';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email'] = 'please Enter a valid Email';
    }
    $department = strtolower($department);
    if (empty($department)) {
        $_SESSION['department'] = 'please enter Departemnt';
    } elseif (!in_array($department, $departments)) {
        $_SESSION['department'] = 'department Not Found';
    }
    if (empty($password)) {
        $_SESSION['password'] = 'Password must be entered';
    } elseif (strlen($password) > 100) {
        $_SESSION['password'] = 'Password must be less than 100';
    } elseif (strlen($password) < 6) {
        $_SESSION['paswword'] = 'Password must be greater than 5';
    }
    if(! empty($_SESSION['name'] ||$_SESSION['email'] || $_SESSION['password'] || $_SESSION['department'] )) {
        $_SESSION['name'];
        $_SESSION['email'];
        $_SESSION['department'];
        $_SESSION['password'];
    }else {
        $hashedPassword = $database->hashPassword($password);
        $sql = "INSERT INTO employees (`name`, email, `password`, department) VALUES('$name','$email', '$hashedPassword', '$department')";
        $_SESSION['success'] = $database->insert($sql);
    }
}






?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary">Add New Employee</h2>
        </div>
    </div>

    <?php if (! empty($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <span><?= $_SESSION['success'];?></span>
            </div>
            <?php endif;?>



    <form class="row g-3" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <div class="col-md-12">
            <label for="inputNamel4" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="inputEmail4">
                <span style="color: red;">
                    <?php echo $_SESSION['name']; ?>
                </span>
         
        </div>
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="inputEmail4">
            <span style="color: red;">
                    <?php echo $_SESSION['email']; ?>
                </span>
        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword4">
            <span style="color: red;">
                    <?php echo $_SESSION['password']; ?>
                </span>

        </div>
        <div class="col-md-12">
            <label for="inputDepartment4" class="form-label">Department Name</label>
            <input type="text" name="department" class="form-control" id="inputPassword4">
            <span style="color: red;">
                    <?php echo $_SESSION['department']; ?>
                </span>

        </div>

        <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
</div>
















<?php 
unset($_SESSION['error']);
unset($_SESSION['success']);
include "includes/footer.php" ?>