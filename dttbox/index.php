<?php include"phpinclude.php" ?>
<?php include"connect.php" ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DCC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- gmap--->
  
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
     .content-wrapper{

      background-color: black;
     }
     .main-sidebar{
      background-color: rgb(51,51,0);
     }
     div .inner{
      background color: red;
     }

  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      
      <img src="dist/img/logo.png" alt="Smiley face" class="center">
    </a>
   <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <div class="dropdown">
    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="width:200px; background-size: 100%;">
     <h5> Dashboard</h5>
    </button>
    <div class="dropdown-menu" style="background-color: black;">
      <a class="dropdown-item" href="#"data-toggle="modal" data-target="#signupmodal" style="width:200px; background-size: 100%;"><h5>Add Device<h5></a>
      <a class="dropdown-item" href="api.php"><h5>Weather Report</h5></a>
      <a class="dropdown-item" href="devicelist.php"><h5>Device Data</h5></a>
      <a class="dropdown-item" href="historytable.php"><h5>Historical Data</h5></a>
    </div>
  </div>
        </ul>
             
            </div>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


 <!-- Sign UP Modal -->
<?php
    function phpAlert($msg) {
      echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
    
    
    if(isset($_POST['insert'])){
    include('dbcon.php');  
        $name  = $_POST['name'] ;
        $address  = $_POST['address'] ;
        $type  = $_POST['type'] ;     
        $lat  = $_POST['lat'] ;
        $lng  = $_POST['lng'] ;
        $sqlx = "INSERT INTO colleges (name,address,type,lat,lng) VALUES ('$name','$address','$type','$lat','$lng')";
          try{
              $update_Result = mysqli_query($conn, $sqlx);    
              if($update_Result)
              {
                  if(mysqli_affected_rows($conn) > 0)
                  {
            phpAlert("Thank you Sir, We will reply you very soon");
            }else{   
          }
        }
        else {  }
        } catch (Exception $ex) {
        
          
      }
    }
  ?>

<!-- Add device end  -->



 <!-- Sign UP Modal -->
    <div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="SignUP" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <h4 class="modal-title text-center signinmodaltitle" id="exampleModalCenterTitle">ADD Device</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <br>

                    <form action="" method="POST">
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="name" placeholder="Pointer Name">
                        </div>
                       
                        <div class="form-group si_usernamebox">
                            <input type="" class="form-control no-border" name="address" placeholder="Address">
                        </div>
                         <div class="form-group si_usernamebox">
                            <input type="" class="form-control no-border" name="type" placeholder="Pointer Type">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="lat" placeholder="lat Number">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="lng" placeholder="Lng Number">
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" name="insert" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 text-center">   
        <div class="col-sm-8">      
            <h1 class="m-0 text-white">Dhaka City Corporation Environment Monitoring System.</h1>
          </div>
          <div class="col-sm-4">
            <div class="search-container text-right">
    <form action="">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php

$sql = "SELECT DID FROM dbox  order by id desc limit 1 ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<h3>" . $row['DID'] . "</h3>";
            echo "<h4>Device ID </h4>";
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>

          </div>

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
/* Attempt MySQL server connection. Assuming you are running MySQL
 server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "digitalbox");
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt select query execution
$sql = "SELECT TMP FROM dbox  order by id desc limit 1 ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<h3>" . $row['TMP'] . "</h3>";
            echo "<h4> Temperature </h4>";
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php
/* Attempt MySQL server connection. Assuming you are running MySQL
 server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "digitalbox");
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt select query execution
$sql = "SELECT HUM FROM dbox  order by id desc limit 1 ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<h3>" . $row['HUM'] . "</h3>";
            echo "<h4>  Humidity </h4>";
        }
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>

   <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php

/* Attempt MySQL server connection. Assuming you are running MySQL
 server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "digitalbox");
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt select query execution
$sql = "SELECT CO2 FROM dbox  order by id desc limit 1 ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<h3>" . $row['CO2'] . "</h3>";
            echo "<h4>Carbon Dioxide (CO2) </h4>";
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>

        <!-- ./col -->

 <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php

/* Attempt MySQL server connection. Assuming you are running MySQL
 server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "digitalbox");
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt select query execution
$sql = "SELECT VOC,date FROM dbox  order by id desc limit 1 ";
$voc = '';
$date = '';
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          $d = $d .'"' .$row['VOC'].'",';
          $date = $date .'"' .$row['date'].'",';
            //echo "<h3>" . $row['VOC'] . "</h3>";
            echo "<h4>Air Pollution (VOC)</h4>";
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
<script>
 
new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: [<?php echo $date; ?> ],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f",],

          data: [<?php echo $d; ?> ]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,

      }
    }
});

</script>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>

                    <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php

/* Attempt MySQL server connection. Assuming you are running MySQL
 server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "digitalbox");
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt select query execution
$sql = "SELECT CH4 FROM dbox  order by id desc limit 1 ";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<h3>" . $row['CH4'] . "</h3>";
            echo "<h4>Methane (CH4)</h4>";
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          



        </div>
</div>

<div class="container">
<div class="row">
            <!-- DONUT CHART -->
          <div class="col-sm-6 col-md-6 col-xl-6" style="">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Air Pollution (VOC)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">

                 <canvas id="bar-chart" width="900" height="500"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

           <div class="col-sm-6 col-md-6 col-xl-6" >
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Humidity And Temperature</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">

                  <div class="panel-body"><iframe src="weather.php" width="100%" height="268"></iframe></div>

                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
    </div>    
    </div> 

<div class="row">
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Methane (CH4)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                 <canvas id="line-chart1" width="900" height="500"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>
         <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Carbon Dioxide (CO2)</h3>


                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
              <div class="chart">
              <div class="panel-body"><iframe src="chart1.php" width="100%" height="270"></iframe></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

</div>

  <iframe src="map.php"style="width: 100%; height:455px;"></iframe>



  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>

<!--gmaps------>
  
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script src="RGraph.common.core.js"></script>
<script src="RGraph.bipolar.js"></script>

<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'digitalbox';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);
$VOC = '';
$date = '';
//query to get data from the table
$sql = "  select VOC, date(date) as Day, hour(date) as Hour, count(*) as Count
from dbox

group by day(date), hour(date) order by id desc limit 10 ";

$result = mysqli_query($mysqli, $sql);
//loop through the returned data
while ($row = mysqli_fetch_array($result)) {
    $VOC = $VOC . '"' . $row['VOC'] . '",';
    
@    $Hour = $Hour . '"' . $row['Hour'] . '",';
}
$VOC = trim($VOC, ",");
$Hour = trim($Hour, ",");
?>

<script>
  
new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: [<?php echo $Hour; ?> ],
      datasets: [
        {
          label: "Popuaddression (millions)",
          backgroundColor: ["#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f","#3cba9f",],

          data: [<?php echo $VOC; ?> ]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,

      }
    }
});

</script>


<script>
  new Chart(document.getElementById("line-chart1"), {
  type: 'line',
  data: {
    labels: [<?php echo $id; ?>],
    datasets: [{ 
        data: [<?php echo $CH4; ?>],
        label: "CH4",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,

    }
  }
});
</script>
