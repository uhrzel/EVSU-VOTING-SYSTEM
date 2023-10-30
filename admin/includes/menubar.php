<style>
  .main-sidebar {
    background-image: url('includes/images/sidebar.png');
    background-size: cover; /* Adjust to 'contain' or 'auto' as needed */
    background-position: center; /* Adjust the position as needed */
  }
</style>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class=""><a href="rank.php"><i class="fa fa-trophy"></i> <span>Standing</span></a></li>
      <li class=""><a href="votes.php"><i class="glyphicon glyphicon-lock"></i> <span>Votes</span></a></li>
      <li class="header">MANAGE</li>
      <li class=""><a href="voters.php"><i class="fa fa-users"></i> <span>Students</span></a></li>
      <li class=""><a href="positions.php"><i class="fa fa-tasks"></i> <span>Positions</span></a></li>
      <li class=""><a href="candidates.php"><i class="fa fa-black-tie"></i> <span>Candidates</span></a></li>
      <li class="header">SETTINGS</li>
      <!-- <li class=""><a href="ballot.php"><i class="fa fa-file-text"></i> <span>Ballot Position</span></a></li> -->
      <li class=""><a href="#config" data-toggle="modal"><i class="fa fa-cog"></i> <span>Election Title</span></a></li>
      <li class=""><a href="archived_votes.php"><i class="fa fa-archive"></i> <span>Archived Votes</span></a></li>
      <li class=""><a href="voting_status.php"><i class="fa fa-file-text"></i> <span>Status</span></a></li>
      
      <?php
        // Check if the user is a super admin (user_role = 2) to display the "Accounts" menu item
        if ($user['user_role'] == 2) {
          echo '<li class=""><a href="accounts.php"><i class="fa fa-user"></i> <span>Accounts</span></a></li>';
        }
      ?>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>
