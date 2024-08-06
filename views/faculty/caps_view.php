<?php
include('sidebar.php');

if (isset($_SESSION["username"])) {
    $team = $_GET['team'];
    $username = $_SESSION["username"];
    $mentorName = $userData['name'];

    $sql = "SELECT * FROM caps_teams WHERE team_id = '$team'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $team_name = $row['team_name'];
    $mentor_name = $row['guide_name'];
    $team_id = $row['team_id'];

    if (mysqli_num_rows($result) == 0) {
        echo '
        <div class="text-center"><br><br>
          <img src="dist\img\cartoon.jpeg" class="card-img-top" alt="Team Member" style="width: 300px; height: 400px;">
        <h6 class="text" style="color:red">You are not Registered</h6>
      </div><br><br><br><br>';
        include('footer.html');
        exit();
    }
    $team = "SELECT * FROM caps_teams WHERE team_id = '$team_id'";
    $team_result = $conn->query($team);
    $team_row = mysqli_fetch_assoc($team_result);
    $team_name = $team_row['team_name'];

    $ps = "SELECT * FROM caps_problems WHERE team_id = '$team_id'";
    $team_ps = $conn->query($ps);
    $team_ps_row = mysqli_fetch_assoc($team_ps);
    $area_research = $team_ps_row['area_research'];
    $project_title = $team_ps_row['problem_statement'];
}
?>

       <!-- partial -->
       <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title" style="font-size:x-large">Capstone Project Team</h6><br>
                  <h6><strong>Team Id</strong>:- <?php echo $row["team_id"] ?></h6>
                    <h6><strong>Team Name</strong>:- <?php echo $row["team_name"] ?></h6><br>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead >
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Regd No.
                          </th>
                          <th>
                            Role
                          </th>
                        </tr>
                      </thead>
                      <tbody style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">
                    <tr>
                      <?php if(!empty($row["mem_name1"])): ?>
                      <tr>
                        <td>1</td>
                        <td><?php echo $row["mem_name1"] ?></td>
                        <td><?php echo $row["mem_regd1"] ?></td>
                        <td>Team Lead</td>
                      </tr>
                      <?php endif; ?>

                      <?php if(!empty($row["mem_name2"])): ?>
                      <tr>
                        <td>2</td>
                        <td><?php echo $row["mem_name2"] ?></td>
                        <td><?php echo $row["mem_regd2"] ?></td>
                        <td>Member</td>
                      </tr>
                      <?php endif; ?>

                      <?php if(!empty($row["mem_name3"])): ?>
                      <tr>
                        <td>3</td>
                        <td><?php echo $row["mem_name3"] ?></td>
                        <td><?php echo $row["mem_regd3"] ?></td>
                        <td>Member</td>
                      </tr>
                      <?php endif; ?>

                      <?php if(!empty($row["mem_name4"])): ?>
                      <tr>
                        <td>4</td>
                        <td><?php echo $row["mem_name4"] ?></td>
                        <td><?php echo $row["mem_regd4"] ?></td>
                        <td>Member</td>
                      </tr>
                      <?php endif; ?>
                  </table>
                    </table>
                  </div>
                </div>
              </div>
            </div>


 
          </div>
        </div>