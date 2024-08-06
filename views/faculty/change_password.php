<?php
include "sidebar.php";

$message="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $username = $_SESSION["username"];
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check if the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        echo "<script>
                alert('New password and confirm password do not match.');
                window.location.href = 'change_password';
            </script>";
        exit();
    }

    // Validate the new password using a regular expression
    $passwordRegex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/';
    if (!preg_match($passwordRegex, $newPassword)) {
        echo "<script>
                alert('Password must be at least 8 characters long and include at least 1 uppercase letter, 1 lowercase letter, 1 numeric digit, and 1 special character.');
                window.location.href = 'change_password';
            </script>";
        exit();
    }

    $sqlVerify = "SELECT password FROM faculty WHERE username = ?";
    $stmtVerify = $conn->prepare($sqlVerify);
    $stmtVerify->bind_param("s", $username);
    $stmtVerify->execute();
    $stmtVerify->bind_result($storedPassword);

    if ($stmtVerify->fetch() && password_verify($currentPassword, $storedPassword)) {
        // Close the result set
        $stmtVerify->close();

        // Hash the new password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to update the password
        $sqlUpdate = "UPDATE faculty SET password = ? WHERE username = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ss", $hashedNewPassword, $username);

        if ($stmtUpdate->execute()) {
            // Password updated successfully
            echo "<script>
                    alert('Password updated successfully.');
                    window.location.href = 'change_password'; 
                </script>";
            exit();
        } else {
            // Display an error message using a popup
            echo "<script>
                    alert('Error: {$stmtUpdate->error}. Please try again later.');
                </script>";
        }

        // Close the prepared statement
        $stmtUpdate->close();
    } else {
        // Current password is incorrect
        echo "<script>
                alert('Incorrect current password. Please try again.');
            </script>";
    }

    // Close the prepared statement for verification
    $stmtVerify->close();
}
?>

<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card mx-auto">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Change Password</h4>
                  <form class="forms-sample" action="change_password" method="post">
                    <div class="form-group row">
                      <label for="currentPassword" class="col-sm-3 col-form-label">Current Password</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="currentPassword" placeholder="Current Password" name="currentPassword">
                      </div>
                    </div>


                    <div class="form-group row">
                        <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="New Password" name="newPassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirmPassword" class="col-sm-3 col-form-label">Re-Type Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" name="confirmPassword">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light" type="cancel">Cancel</button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- content-wrapper ends -->
<?php 
include 'footer.html';
?>