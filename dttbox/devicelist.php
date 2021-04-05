<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Master-template</title>
  <meta ne="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">

</head>

<body>
  <div class="container">
   <table class="table" style="background-color:black; color: white;">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Pointer Name</th>
      <th scope="col">Address</th>
      <th scope="col">Pointer TYpe</th>
       <th scope="col">Lat NUmber</th>
        <th scope="col">Lng NUmber</th>
    </tr>
  </thead>
                <?php         
                      
                      
                      include('dbcon.php');
                      $search_Query = "select * from `colleges`";   
                      $search_Result = mysqli_query($connect, $search_Query); 
                      if($search_Result)
                      {
                        if(mysqli_num_rows($search_Result))
                        {
                          while($row = mysqli_fetch_array($search_Result))
                          {
                            //$amount  = $row['amount'] == 0 ? '' : number_format($row['amount']);
                            echo '<tr>  
                            <td>'.$row['id'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['address'].'</td>
                            <td>'.$row['type'].'</td>
                            <td>'.$row['lat'].'</td>
                            <td>'.$row['lng'].'</td>
                            </tr>';
                          }
                        }else{}
                        }else{     
                      }
                        
                    ?>
</table>   
  </div>


  <script src="js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
   <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set','transport','beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>

</html>
