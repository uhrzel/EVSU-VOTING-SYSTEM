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
      <h1><strong>Students Lists</strong></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
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
            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            <button class="btn btn-info btn-sm btn-flat" data-toggle="modal" data-target="#importCsvModal"><i class="fa fa-upload"></i> Import CSV</button>
          </div>
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Student ID</th>
                  <th>Full Name</th>
                  <th>Course</th>
                  <th>Department</th>
                  <th>Year/Section</th>
                  <th>Date Modified</th>
                  <th style="width: 100px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">Tools</th>
                </thead>
                <tbody>
                <?php
                // Fetch data from voters table with department_id
                $sql = "SELECT voters.*, departments.name AS department_name FROM voters LEFT JOIN departments ON voters.department_id = departments.department_id";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                    echo "
                        <tr>
                            <td style='height:30px'>" . $row['studentid'] . "</td>
                            <td>" . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . "</td>
                            <td>" . $row['course'] . "</td>
                            <td>" . $row['department_name'] . "</td>
                            <td>" . $row['year'] . "</td>
                            <td>" . $row['date'] . "</td>
                            <td class='button'>
                                <a class='btn-success btn-lg edit btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i></a>
                                <a class='btn-danger btn-lg delete btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i></a>
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
  <?php include 'includes/voters_modal.php'; ?>
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
    url: 'voters_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_studentid').val(response.studentid);
      $('#edit_firstname').val(response.firstname);
      $('#edit_middlename').val(response.middlename);
      $('#edit_lastname').val(response.lastname);
      $('#edit_course').val(response.course);
      $('#edit_year').val(response.year);
      $('#edit_password').val(response.password);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
