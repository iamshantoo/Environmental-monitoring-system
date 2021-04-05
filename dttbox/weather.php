<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Medidor Temperatura, Humedad</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Humidity', 0],
          ['Temperature', 0]
         
        ]);
        var options = {
          width: 460, height: 460,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
        var chart = new google.visualization.Gauge(document.getElementById('Medidores'));
        chart.draw(data, options);
        setInterval(function() {
            var JSON=$.ajax({
                url:"weatherdb.php?q=1",
                dataType: 'json',
                async: false}).responseText;
            var Respuesta=jQuery.parseJSON(JSON);
            
          data.setValue(0, 1,Respuesta[0].HUM);
          data.setValue(1, 1,Respuesta[0].TMP);
          chart.draw(data, options);
        }, 500);
        
      }
    </script>
</head>
<body>
       <div id="Medidores" ></div>
   
</body>
</html>