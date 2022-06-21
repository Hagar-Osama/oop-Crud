<?php include "includes/header.php"?>
<?php include "includes/navbar.php";


$row = $database->findRecord('employees', $_GET['id']);
if (isset($_GET['id']) && is_numeric($_GET['id']) && $row  ) {
    if($database->delete('employees', $row['id'])) {
        $_SESSION['success'] = 'Data Deleted successfully';
        header('location:'.URL.'employees.php');

    }
}



?>



 <div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h2 class="p-3 col text-center mt-5 text-white bg-primary">Delete Employee</h2>

        </div>
    </div>
 </div>

















<?php include "includes/footer.php"?>