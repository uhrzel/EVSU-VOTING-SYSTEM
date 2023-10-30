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
      <strong>Candidates Lists</strong>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Candidates</li>
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
      <!--  <div>
          <button class="btn btn-sm btn-flat" style="background-color: #0044cc; color: #fff;"><a href="candidates.php" style="text-decoration: none; color: #fff;">Candidates</a></button>
          <button class="btn btn-info btn-sm btn-flat"><a href="department_candidates.php" style="color: #fff;">Department Candidates</a></button>
        </div> -->
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              <button class="btn btn-info btn-sm btn-flat" data-toggle="modal" data-target="#importCsvModal"><i class="fa fa-upload"></i> Import CSV</button>
              <a href="party.php" class="btn btn-success btn-sm btn-flat pull-right"><i class="fa fa-users"></i> Partylists</a>
            </div>
            <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered">
            <thead>
                <th class="hidden"></th>
                <th>Position</th>
                <th>Photo</th>
                <th>First Name</th>
                <th>Middle Name</th> <!-- New column for middlename -->
                <th>Last Name</th>
                <th>Partylist</th>
                <th style="width: 100px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">Tools</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT *, candidates.id AS canid FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id LEFT JOIN party_lists ON party_lists.party_id = candidates.party_id ORDER BY positions.priority ASC";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc()){
                    $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                    echo "
                        <tr>
                            <td class='hidden'></td>
                            <td>".$row['description']."</td>
                            <td>
                                <img src='".$image."' width='30px' height='30px'>
                                <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='".$row['canid']."'><span style='color:#337ab7' class='fa fa-edit'></span></a>
                            </td>
                            <td>".$row['firstname']."</td>
                            <td>".$row['middlename']."</td> <!-- Display middlename -->
                            <td>".$row['lastname']."</td>
                            <td>".$row['party_name']."</td>
                            <td style='text-align: center'>
                                <a class='btn-success btn-lg edit btn-flat' data-id='" . $row['canid'] . "'><i class='fa fa-edit'></i></a>
                                <a class='btn-danger btn-lg delete btn-flat' data-id='" . $row['canid'] . "'><i class='fa fa-trash'></i></a>
                            </td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/candidates_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'candidates_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.canid);
      $('#edit_firstname').val(response.firstname);
      $('#edit_middlename').val(response.middlename);
      $('#edit_lastname').val(response.lastname);
      $('#edit_partylist').val(response.party_id);
      $('#posselect').val(response.position_id).html(response.description);      
      $('.fullname').html(response.firstname+' '+response.lastname);
      $('#desc').html(response.platform);
    }
  });
}
</script>
</body>
</html>
