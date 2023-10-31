<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>
    <br><br>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <strong>Archives Votes</strong>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Votes</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <a href="#permanentdelete" data-toggle="modal" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i> Delete All</a>
                <!--  <a href="#unarchive" style="float:right" data-toggle="modal" class="btn bg-yellow btn-sm btn-flat"><i class="fa fa-archive"></i> Unarchive All</a> -->
              </div>
              <div class="box-header" style="max-width: 400px;">

                <form method="POST" enctype="multipart/form-data">
                  <?php
                  $options = "<option>Select year</option>";
                  $options .= "<option value='all'>All</option>";
                  $years = array();

                  $query_year = "SELECT date_time FROM archive_votes";
                  $exe_query = $conn->query($query_year);

                  if ($exe_query) {
                    while ($row = $exe_query->fetch_assoc()) {
                      $date_time = $row['date_time'];
                      $year = date('Y', strtotime($date_time));


                      if (!in_array($year, $years)) {
                        $years[] = $year;
                        $options .= "<option value='$year'>$year</option>";
                      }
                    }
                  } else {

                    echo "Query failed: " . $conn->error;
                  }


                  ?>
                  <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                    <label style="width: 50%">Select Year:</label>
                    <select name="cat_year" class="form-control">
                      <?php echo $options; ?>
                    </select>
                    <button class="btn btn-success btn-sm btn-flat">Filter <i class="fa fa-filter"></i></button>
                  </div>
                </form>
              </div>

              <hr>

              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Selected</th>
                    <th>Position</th>
                    <th>Candidate</th>
                    <th>Voter</th>
                    <th>Date</th>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($_POST['cat_year'])) {

                      $year_cat = $conn->real_escape_string($_POST['cat_year']);

                      if ($year_cat == 'all') {
                        $sql = "SELECT archive_votes.id, positions.description, candidates.firstname AS canfirst, candidates.lastname AS canlast, voters.firstname AS votfirst, voters.lastname AS votlast, archive_votes.date_time FROM archive_votes LEFT JOIN positions ON positions.id = archive_votes.position_id LEFT JOIN candidates ON candidates.id = archive_votes.candidate_id LEFT JOIN voters ON voters.id = archive_votes.voters_id";
                        $query = $conn->query($sql);
                        if ($query) { // Check if the query was executed successfully
                          while ($row = $query->fetch_assoc()) {
                            echo "
            <tr>
              <td class='hidden'></td>
              <td><input type='checkbox' name='selected_rows[]' value='" . $row['id'] . "'></td>
              <td>" . $row['description'] . "</td>
              <td>" . $row['canfirst'] . ' ' . $row['canlast'] . "</td>
              <td>" . $row['votfirst'] . ' ' . $row['votlast'] . "</td>
              <td>" . $row['date_time'] . "</td>
            </tr>
          ";
                          }
                        } else {
                          echo "Database query error: " . $conn->error;
                        }
                      } else {
                        $year_start = $year_cat . '-01-01';
                        $year_end = $year_cat . '-12-31';

                        $sql = "SELECT archive_votes.id, positions.description, candidates.firstname AS canfirst, candidates.lastname AS canlast, voters.firstname AS votfirst, voters.lastname AS votlast, archive_votes.date_time FROM archive_votes LEFT JOIN positions ON positions.id = archive_votes.position_id LEFT JOIN candidates ON candidates.id = archive_votes.candidate_id LEFT JOIN voters ON voters.id = archive_votes.voters_id WHERE archive_votes.date_time >= '$year_start' AND archive_votes.date_time <= '$year_end'";

                        $query = $conn->query($sql);
                        if ($query) {
                          while ($row = $query->fetch_assoc()) {
                            echo "
            <tr>
              <td class='hidden'></td>
              <td><input type='checkbox' name='selected_rows[]' value='" . $row['id'] . "'></td>
              <td>" . $row['description'] . "</td>
              <td>" . $row['canfirst'] . ' ' . $row['canlast'] . "</td>
              <td>" . $row['votfirst'] . ' ' . $row['votlast'] . "</td>
              <td>" . $row['date_time'] . "</td>
            </tr>
          ";
                          }
                        } else {
                          echo "Database query error: " . $conn->error;
                        }
                      }
                    } else {
                      $sql = "SELECT archive_votes.id, positions.description, candidates.firstname AS canfirst, candidates.lastname AS canlast, voters.firstname AS votfirst, voters.lastname AS votlast, archive_votes.date_time FROM archive_votes LEFT JOIN positions ON positions.id = archive_votes.position_id LEFT JOIN candidates ON candidates.id = archive_votes.candidate_id LEFT JOIN voters ON voters.id = archive_votes.voters_id";
                      $query = $conn->query($sql);
                      if ($query) { // Check if the query was executed successfully
                        while ($row = $query->fetch_assoc()) {
                          echo "
          <tr>
            <td class='hidden'></td>
            <td><input type='checkbox' name='selected_rows[]' value='" . $row['id'] . "'></td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['canfirst'] . ' ' . $row['canlast'] . "</td>
            <td>" . $row['votfirst'] . ' ' . $row['votlast'] . "</td>
            <td>" . $row['date_time'] . "</td>
          </tr>
        ";
                        }
                      } else {
                        echo "Database query error: " . $conn->error;
                      }
                    }
                    ?>
                  </tbody>
                  <div id="deleteConfirmationModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to delete the selected items?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                  <script>
                    $(document).ready(function() {
                      // Display the modal when the "Delete Selection" button is clicked
                      $('#deleteSelectionButton').click(function() {
                        var selectedIds = $('input[type="checkbox"]:checked').map(function() {
                          return $(this).val();
                        }).get();

                        if (selectedIds.length > 0) {
                          $('#deleteConfirmationModal').modal('show');
                          // Set the selected row IDs in a data attribute of the modal
                          $('#deleteConfirmationModal').data('selectedIds', selectedIds);
                        } else {
                          alert('Please select items to delete.');
                        }
                      });

                      // Handle the "Delete" button click within the modal
                      $('#confirmDelete').click(function() {
                        var selectedIds = $('#deleteConfirmationModal').data('selectedIds');
                        $.ajax({
                          url: '../admin/process/delete_selection.php', // Replace with the actual URL for the delete operation
                          method: 'POST',
                          data: {
                            selected_rows: selectedIds
                          },
                          success: function(response) {
                            // Handle the response from the server, e.g., show a success message

                            // Reload the archived_votes.php page
                            location.reload();
                          },
                          error: function(error) {
                            // Handle the error, e.g., show an error message
                            alert('Error: ' + error);
                          }
                        });
                        $('#deleteConfirmationModal').modal('hide');
                      });
                    });
                  </script>



                  <form id="deleteForm" method="post" action="../admin/process/delete_selection.php">
                    <table id="example1" class="table table-bordered">
                    </table>
                    <button id="deleteSelectionButton" type="button" class="btn btn-danger"><i class="fa fa-trash"> </i> Delete Selection</button>
                  </form>

                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/votes_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
</body>

</html>