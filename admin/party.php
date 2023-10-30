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
      <strong>Party Lists</strong>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Partylists</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
            <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#addPartyListModal"><i class="fa fa-plus"></i> Add Party</button>
            </div>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered">
                    <thead>
                        <th class="hidden"></th>
                        <th>Party Name</th>
                        <th>Description</th>
                        <th>Date Modified</th>
                        <th style="width: 100px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">Tools</th>
                    </thead>
                    <tbody>
                        <?php
                        // Modified to check for query execution success
                        $sql = "SELECT party_id, party_name, party_description, created_at, modified_at FROM party_lists";
                        $query = $conn->query($sql);
                        if ($query) {
                            while ($row = $query->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td class='hidden'></td>
                                    <td style='height:30px'><?php echo $row['party_name']; ?></td>
                                    <td><?php echo $row['party_description']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td style='text-align: center'>
                                       <!-- add delete button here -->
                                       <button class="btn-danger btn-lg delete-party btn-flat" data-partyid="<?php echo $row['party_id']; ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            // Handle query execution error
                            echo "Error: " . $conn->error;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    // Add a click event listener for delete buttons
    document.querySelectorAll('.delete-party').forEach(function (button) {
        button.addEventListener('click', function () {
            // Get the party_id from the data attribute
            var partyId = this.getAttribute('data-partyid');
            
            // Send an AJAX request to delete the party directly
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'process/party_delete.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page after successful deletion
                    window.location.reload();
                }
            };
            xhr.send('party_id=' + partyId);
        });
    });
</script>
    </section>   
  </div>
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/party_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
