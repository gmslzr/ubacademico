 <?php
$con=mysql_connect("localhost","root","1234") or die("Failed to connect with database!!!!");
mysql_select_db("be001086_sai_desarrollo", $con); 
// The Chart table contain two fields: Weekly_task and percentage
$sql = "SELECT *,(SELECT NOM_APE FROM estudiantes WHERE cedula=listaalumnos.cedula) as NOM_APE ,(SELECT nom_emp FROM empresas WHERE codEmp=listaalumnos.codEmp) as nom_emp, (SELECT codPer FROM empresas_area WHERE codEmp= listaalumnos.codEmp) as codPer, (SELECT codTutor FROM empresas_tutor WHERE codEmp= listaalumnos.codEmp) as codTutor FROM listaalumnos ";
//this example will display a pie chart.if u need other charts such as Bar chart, u will need to change little bit to make work with bar chart and others charts
$sth = mysql_query();
echo $sql;

/*
---------------------------
example data: Table (Chart)
--------------------------
Weekly_Task     percentage
Sleep           30
Watching Movie  40
work            44
*/

$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    //Labels your chart, this represent the column title
    //note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage And string will be used for column title
    array('label' => 'sexo', 'type' => 'string'),
    array('label' => 'COUNT(*)', 'type' => 'number')

);

$rows = array();
while($r = mysql_fetch_assoc($sth)) {

    $temp = array();
    // the following line will used to slice the Pie chart
    $temp[] = array('v' => (string) $r['sexo']); 

    //Values of the each slice
    $temp[] = array('v' => (int) $r['COUNT(*)']); 
    $rows[] = array('c' => $temp);
}


$table['rows'] = $rows;
$jsonTable = json_encode($table);
//echo $jsonTable;
?>

<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
           title: 'Estudiantes con una calificación definitiva entre 17 y 20 puntos.',
          is3D: 'true',
          width: 800,
          height: 600
        };
      // Instantiate and draw our chart, passing in some options.
      //do not forget to check ur div ID
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>