<?php
include("sidebar.php");
$username = $_SESSION['username'];


if ($conn) {


    // Corrected SQL query for caps_teams without placeholders
    $sql_caps_teams = "SELECT * FROM caps_teams WHERE mem_regd1='$username' OR mem_regd2='$username' OR mem_regd3='$username' OR mem_regd4='$username'";
    $stmt_caps_teams = $conn->prepare($sql_caps_teams);
    
    // Check if prepare succeeded
    if ($stmt_caps_teams) {
        $stmt_caps_teams->execute();
        $result_caps_teams = $stmt_caps_teams->get_result();
    } else {
        die("Prepare statement failed: " . htmlspecialchars($conn->error));
    }
} else {
    die("Database connection failed: " . htmlspecialchars($conn->connect_error));
}
?>

<!-- HTML Content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Hello, <em><?php echo htmlspecialchars($userData['name']); ?></em></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0" style="font-size:x-large">Dashboard</p><br>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Event</th>
                                        <th>Status</th>
                                        <th>Credits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; // Initialize the counter outside the loops

                                    if ($result_caps_teams && $result_caps_teams->num_rows > 0) :
                                        while ($row = $result_caps_teams->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>Capstone Project</td>
                                                <td><div class="badge badge-warning"><?php echo htmlspecialchars('Ongoing'); ?></div></td>
                                                <td><?php echo '10'; ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endwhile;
                                        else:
                                            echo "<tr><td colspan='4'>No records found</td></tr>";
                                        
                                    endif;

                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include 'footer.html'; ?>
</div>
