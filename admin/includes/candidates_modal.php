<!-- Description -->
<div class="modal fade" id="platform">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
      </div>
      <div class="modal-body">
        <p id="desc"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Add -->

<div class="modal fade" id="addnew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Add New Candidate</b></h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal" method="POST" action="candidates_add.php" enctype="multipart/form-data">

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Please Select a Voter</label>
            <div class="col-sm-9">
              <div class="input-group">
                <select class="form-control" id="name" name="fullname" required>
                  <option value="">Select a Voter</option>
                  <?php
                  // Replace with your database connection code
                  $db = new mysqli("localhost", "root", "", "evsuvotes");

                  if ($db->connect_error) {
                    die("Connection failed: " . $db->connect_error);
                  }

                  $sql = "SELECT firstname, middlename, lastname FROM voters";
                  $result = $db->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row["firstname"] . ' ' . $row["middlename"] . ' ' . $row["lastname"] . '">' . $row["firstname"] . ' ' . $row["middlename"] . ' ' . $row["lastname"] . '</option>';
                    }
                  }

                  $db->close();
                  ?>
                </select>
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" id="search" name="search" placeholder="Search" oninput="filterOptions()">
              </div>
            </div>
          </div>

          <script>
            function filterOptions() {
              var input = document.getElementById("search").value.toLowerCase();
              var select = document.getElementById("name");
              var options = select.getElementsByTagName("option");

              for (var i = 0; i < options.length; i++) {
                var optionText = options[i].text.toLowerCase();
                if (optionText.includes(input)) {
                  options[i].style.display = "block";
                } else {
                  options[i].style.display = "none";
                }
              }
            }
          </script>


          <style>
            .custom-input {
              width: 418px;
              margin-left: 150px;

            }
          </style>
          <script>
            var nameSelect = document.getElementById("name");
            var inputFields = document.getElementById("inputFields");

            // JavaScript to handle the display of input fields based on the selected option
            nameSelect.addEventListener("change", function() {
              var selectedOption = this.value;

              if (selectedOption === "show") {
                // Show all input fields when "Show All Names" is selected
                inputFields.style.display = "block";
              } else {
                // Hide all input fields when "Hide All Names" or any other option is selected
                inputFields.style.display = "none";
              }
            });
          </script>

          <div class="form-group">
            <label for="partylist" class="col-sm-3 control-label">Party</label>

            <div class="col-sm-9">
              <select class="form-control" id="partylist" name="partylist" required>
                <option value="" selected>- Select -</option>
                <?php
                $sql = "SELECT * FROM party_lists";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                  echo "
                              <option value='" . $row['party_id'] . "'>" . $row['party_name'] . "</option>
                            ";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="position" class="col-sm-3 control-label">Position</label>

            <div class="col-sm-9">
              <select class="form-control" id="position" name="position" required>
                <option value="" selected>- Select -</option>
                <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                  echo "
                              <option value='" . $row['id'] . "'>" . $row['description'] . "</option>
                            ";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="photo" class="col-sm-3 control-label">Photo</label>

            <div class="col-sm-9">
              <input type="file" id="photo" name="photo">
            </div>
          </div>
          <!-- <div class="form-group">
                    <label for="platform" class="col-sm-3 control-label">Platform</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="platform" name="platform" rows="7"></textarea>
                    </div>
                </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
        </form>
      </div>
    </div>
  </div>
  <script>
    // Function to capitalize the first letter of a string
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
    // Attach event listeners to the input fields
    document.querySelectorAll('input').forEach(function(input) {
      {
        input.addEventListener('input', function() {
          this.value = capitalizeFirstLetter(this.value);
        });
      }
    });
  </script>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Edit Voter</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="process/candidates_edit.php">
          <input type="hidden" class="id" name="id">
          <div class="form-group">
            <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_middlename" class="col-sm-3 control-label">Middlename</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_middlename" name="middlename" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_partylist" class="col-sm-3 control-label">Party</label>

            <div class="col-sm-9">
              <select class="form-control" id="edit_partylist" name="partylist" required>
                <option value="" selected>- Select -</option>
                <?php
                $sql = "SELECT * FROM party_lists";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                  echo "
                              <option value='" . $row['party_id'] . "'>" . $row['party_name'] . "</option>
                            ";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_position" class="col-sm-3 control-label">Position</label>

            <div class="col-sm-9">
              <select class="form-control" id="edit_position" name="position" required>
                <option value="" selected id="posselect"></option>
                <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                  echo "
                              <option value='" . $row['id'] . "'>" . $row['description'] . "</option>
                            ";
                }
                ?>
              </select>
            </div>
          </div>
          <!-- <div class="form-group">
                    <label for="edit_platform" class="col-sm-3 control-label">Platform</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="edit_platform" name="platform" rows="7"></textarea>
                    </div>
                </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Deleting...</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="process/candidates_delete.php">
          <input type="hidden" class="id" name="id">
          <div class="text-center">
            <p>DELETE CANDIDATE</p>
            <h2 class="bold fullname"></h2>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="process/candidates_photo.php" enctype="multipart/form-data">
          <input type="hidden" class="id" name="id">
          <div class="form-group">
            <label for="photo" class="col-sm-3 control-label">Photo</label>

            <div class="col-sm-9">
              <input type="file" id="photo" name="photo" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Import CSV Modal -->
<div class="modal fade" id="importCsvModal" tabindex="-1" role="dialog" aria-labelledby="importCsvModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="importCsvModalLabel">Import CSV</h4>
      </div>
      <form action="process_csv_candidates.php" method="post" id="importCsvForm" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="csvFile">Choose CSV File:</label>
            <input type="file" class="form-control" id="csvFile" name="csvFile" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>