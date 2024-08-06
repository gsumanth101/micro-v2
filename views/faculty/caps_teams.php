<?php
include("sidebar.php");

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $mentorName = $userData['name'];

    $sql = "SELECT * FROM caps_teams where guide_username = '$username'";
    $result = $conn->query($sql);

$serial_number_start = 1;

}
?>

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Capstone Teams</h4>
            <p class="card-description">
              <code>Internal Teams</code>
            </p>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Team Id
                    </th>
                    <th>
                      Progress
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                while ($result && $row = $result->fetch_assoc()) {

             echo    " <tr>
                      <td>
                        $serial_number_start
                      </td>
                      <td>";
               echo   "<a>
                          <p class=''>" . $row['team_name'] . "</p>
                          <small>Team ID: " . $row['team_id'] . "</small>
                      </a>
                      </td>";
                   echo  '<td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                              </div>
                          </div>
                          <small>
                              0% Complete
                          </small>
                      </td>';
                  echo  '<td class="project-state">
                          <span class="badge badge-success">Success</span>
                      </td>';
                echo '<td class="project-actions text-right">
                    <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href=\'caps_view?team=' . $row['team_id'] . '\'">
                        <i class="fas fa-folder"></i>
                        View
                    </button>



                </td>

                  </tr>';
                  $serial_number_start++;
                }
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

  <?php
  include 'footer.html';
  ?>