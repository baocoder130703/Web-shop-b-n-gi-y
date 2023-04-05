<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<body>


<canvas id="myChart1" style="width:100%;max-width:1100px ;overflow-x: auto;"></canvas>

<script>

var chart_array = <?php $rs = productoder(); 
foreach($rs as $item)
{
    $array1 = $array1 . substr($item['date_added'],0,10) . ',';
}
$array1 = '"'.$array1.'"';
echo $array1;
?>;
// <?php
//     $today = date("d/m/Y");
//     echo $today;
//   ?>

var chart_array2 = <?php $rs = productoder(); 
foreach($rs as $item)
{
    $array2 = $array2 . $item['total'] . ',';
}
$array2 = '"'.$array2. 'đ' .'"';
echo $array2;
?>;


var xValues = chart_array.split(',');
var yValues = chart_array2.split(',');
var barColors = ["red", "green","blue","orange","brown","red", "green"];

new Chart("myChart1", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Biểu đồ số liệu 1244"
    }
  }
});

</script>
</body>
</html> 