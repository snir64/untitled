<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

</head>
<body>
    <div >
        <div >
            <div >
                <h2 class="text-center">PHP CRUD for thr first time </h2>
                <div >
                    <div >
                        <h2>Users</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New User</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // select all users
                    $data = "SELECT * FROM users";
                    if($users = mysqli_query($conn, $data)){
                        if(mysqli_num_rows($users) > 0){
                            echo "<table class='table table-bordered table-striped'>
                                        <thead>
                                          <tr>
                                            <th>#</th>
                                            <th>full Name</th>
                                            <th>Email</th>
 
                                          </tr>
                                        </thead>
                                        <tbody>";
                            while($user = mysqli_fetch_array($users)) {
                                echo "<tr>
                                                <td>" . $user['id'] . "</td>
                                                <td>" . $user['full_name'] . "</td>
                                                <td>" . $user['email'] . "</td>
                                                
                                                <td>
                                                  <a href='read.php?id=". $user['id'] ."' title='View User' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                                                  <a href='edit.php?id=". $user['id'] ."' title='Edit User' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                                                  <a href='delete.php?id=". $user['id'] ."' title='Delete User' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
                                                </td>
                                              </tr>";
                            }
                            echo "</tbody>
                                    </table>";
                            mysqli_free_result($users);
                        } else{
                            echo "<p class='lead'><em>No records found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>