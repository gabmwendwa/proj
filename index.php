<?php
require_once '/var/www/html/project/core/init.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Project | Home</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'template/navbar.php' ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Project</span>
    </a>

    <!-- Sidebar -->
	<?php include 'template/sidebar.php' ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Projects Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../project/">Home</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body" style="overflow-x: auto;">
              <h4>API Examples</h4>
              <a class="btn btn-primary" href="https://www.sungusoft.com/project/api/projects/all/" target="_blank">View All Records</a>&nbsp;&nbsp;
              <a class="btn btn-success" href="https://www.sungusoft.com/project/api/projects/status/index.php?status=completed" target="_blank">View All Records With the Status: Completed</a>
              <a class="btn btn-warning" href="https://www.sungusoft.com/project/api/projects/country/index.php?country=Tanzania" target="_blank">View Record of a Country Not Listed</a>
          </div>
        </div>
      </div>
	  </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" align="right">
              <!-- <h3 class="card-title"></h3> -->
			  <a href="new.php" class="btn btn-primary">New Entry</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow-x: auto;">
              <table id="table1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Project Ref</th>
                  <th>Country</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>API (GET)</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$prf = new Project();
				$obj = new Project();
				$prfr = $prf->find_all('project_table', 'project_ref_id');
        $country = null;

				foreach($prfr as $pr){
					echo "<tr>";
					if($obj->find('project_ref_table', $pr->project_ref_id)){
						echo "<td>";
						echo $obj->data()->project_ref;						
						echo "</td>";
					}						
					if($obj->find('country_table', $pr->country_id)) {
            $country = $obj->data()->country;
						echo "<td>";
						echo $country;
						echo "</td>";
					}
					echo '<td><a href="view.php?project='.$pr->project_ref_id.'&c='.$pr->country_id.'&i='.$pr->implementing_office_id.'&r='.$pr->readiness_or_nap_id.'&t='.$pr->type_of_readiness_id.'&s='.$pr->status_id.'" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>';
					echo '<td><a href="edit.php?project='.$pr->project_ref_id.'&c='.$pr->country_id.'&i='.$pr->implementing_office_id.'&r='.$pr->readiness_or_nap_id.'&t='.$pr->type_of_readiness_id.'&s='.$pr->status_id.'" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>';
					echo '<td><a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a></td>';
					echo '<td><a href="https://www.sungusoft.com/project/api/projects/country/index.php?country='.$country.'" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-code"></i></a></td>';
					echo '</tr>';
				}
				?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Project Ref</th>
                  <th>Country</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>API (GET)</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
	include 'template/footer.php';
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#table1").DataTable();
    /*
	$('#table1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });*/
  });
</script>
</body>
</html>
