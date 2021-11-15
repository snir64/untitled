<?php
require_once "config.php";

$full_name  = $email = "";
$full_name_error =  $email_error = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

        $fullName = trim($_POST["full_name"]);
        if (empty($fullName)) {
            $full_name_error = "Full Name is required.";
        } elseif (!filter_var($fullName , FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $first_name_error = "First Name is invalid.";
        } else {
            $fullName = $fullName;
        }




        $email = trim($_POST["email"]);
        if (empty($email)) {
            $email_error = "Email is required.";
        } elseif (!filter_var($firstName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $email_error = "Please enter a valid email.";
        } else {
            $email = $email;
        }


    if (empty($full_name_error_err)  &&
        empty($email_error)  ) {

          $sql = "UPDATE `users` SET `full_name`= '$fullName', `email`= '$email' WHERE id='$id'";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
              echo "Something went wrong. ";
          }

    }

    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE ID = '$id'");

        if ($user = mysqli_fetch_assoc($query)) {
            $fullName   = $user["full_name"];
            $email       = $user["email"];

        } else {
            echo "Something went wrong.";
            header("location: edit.php");
            exit();
        }
        mysqli_close($conn);
    }  else {
        echo "Something went wrong. Please try again later.";
        header("location: edit.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>

</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update User</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group <?php echo (!empty($first_name_error)) ? 'has-error' : ''; ?>">
                            <label>Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo $fullName; ?>">
                            <span class="help-block"><?php echo $full_name_error;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($email_error)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_error;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>