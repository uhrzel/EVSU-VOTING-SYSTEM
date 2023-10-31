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
          <strong>Votes</strong>
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
                <a href="#reset" data-toggle="modal" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</a>
                <a href="#archive_select" style="float:right; margin-right: 10px;" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class="fa fa-archive"></i> Archive All</a>

              </div>
              <div class="box-body table-responsive">
                <form action="../admin/process/archived_select.php" method="post">

                  <table id="example1" class="table table-bordered">
                    <thead>
                      <th class="hidden"></th>
                      <th>Select</th> <!-- Add this checkbox header -->
                      <th>Position</th>
                      <th>Candidate</th>
                      <th>Voter</th>
                      <th>Date</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast, voters.firstname AS votfirst, voters.lastname AS votlast FROM votes LEFT JOIN positions ON positions.id=votes.position_id LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN voters ON voters.id=votes.voters_id ORDER BY positions.priority ASC";
                      $query = $conn->query($sql);
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
                      ?>

                      <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="confirmationModalLabel">Confirmation</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure you want to move the selected items to the archive?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              <button type="button" class="btn btn-primary" id="confirmMoveButton">Move</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                      <script>
                        $(document).ready(function() {
                          $('#moveSelectionButton').click(function() {
                            var selectedIds = $('input[type="checkbox"]:checked').map(function() {
                              return $(this).val();
                            }).get();

                            console.log("Selected IDs: ", selectedIds); // Add this line for debugging


                            if (selectedIds.length > 0) {
                              // Display the confirmation modal
                              $('#confirmationModal').modal('show');
                              $('#confirmationModal').data('selectedIds', selectedIds);
                            } else {
                              alert('Please select items to move.');
                            }
                          });

                          $('#confirmMoveButton').click(function() {
                            var selectedIds = $('#confirmationModal').data('selectedIds');
                            $.ajax({
                              url: '../admin/process/archived_select.php',
                              method: 'POST',
                              data: JSON.stringify({
                                selected_rows: selectedIds
                              }), // Convert to JSON
                              contentType: 'application/json', // Set content type
                              success: function(response) {
                                location.reload();
                              },
                              error: function(xhr, status, error) {
                                console.log('AJAX Error:');
                                console.log('Status: ' + status);
                                console.log('Error: ' + error);
                                console.log(xhr.responseText);
                              }
                            });

                            $('#confirmationModal').modal('hide');
                          });

                        });
                      </script>
                    </tbody>
                  </table>
                  <button id="moveSelectionButton" type="button" class="btn btn-primary"><i class="fa fa-archive"> </i> Move Selection</button>
                </form>
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