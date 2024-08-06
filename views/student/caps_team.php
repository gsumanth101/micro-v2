<?php
include('sidebar.php');
$username = $_SESSION['username'];
$sql = "SELECT * FROM caps_teams WHERE mem_regd1='$username' OR mem_regd1='$username' OR mem_regd2='$username' OR mem_regd3='$username' OR mem_regd4='$username' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$team_name = $row['team_name'];
$team_id = $row['team_id'];
$guide_username = $row['guide_username'];

$sql1 = "SELECT * FROM caps_problems WHERE team_id='$team_id'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$problem_statement = isset($row1['problem_statement']) ? $row1['problem_statement'] : "";
$area_research = isset($row1['area_research']) ? $row1['area_research'] : "";
if(mysqli_num_rows($result) == 0){
  
  // Get the section of the user
  $sql2 = "SELECT section FROM student WHERE username='$username'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($result2);
  $section = $row2['section'];

  echo '<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="text-center">
              <img src="..\views\public\images\team.jpeg" alt="Image"></img><br><br>
                             <h6 style="color:red;">Not Registered/ Do it in Next Semester</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>';
include 'footer.html';
  exit();
}
$guide_name = "";
$sql1 = "SELECT name FROM faculty WHERE username='$guide_username'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
?>
      
       <!-- partial -->
       <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title" style="font-size:x-large">Capstone Project</h6><br>
                  <h6><strong>Team Id</strong>:- <?php echo $row["team_id"] ?></h6>
                    <h6><strong>Team Name</strong>:- <?php echo $row["team_name"] ?></h6>
                    <?php
                    if(empty($row['guide_name'])){
                        echo '<h6 style="color:red;"><strong>Guide Name</strong>:- Not chosen yet</h6>';
                    } else {
                        echo '<h6><strong>Guide Name</strong>:- '.$row1['name'].'</h6>';
                    }

                //     if(empty($area_research)){
                //         echo '<h6 style="color:red;"><strong>Area of Research</strong>:- Not chosen yet</h6>';
                //   } else {
                //       echo '<h6><strong>Area of Research</strong>:- '.$area_research.'</h6>';
                //       echo '<h6><strong>Project Title</strong>:- '.$problem_statement .'</h6>';
                //   }
                    ?><br>
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
        
        <!-- content-wrapper ends -->

<?php 
  include 'footer.html';
?>