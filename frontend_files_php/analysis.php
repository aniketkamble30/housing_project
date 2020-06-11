<?php include './_navbar.php';?>
<?php 
$conn = mysqli_connect('localhost','root','','house');
$graph = array();
$graph2 = array();
$graph3 = array();
$valscredit = array();
$valsdebit = array();
$cars = array("APR","MAY","JUN","JUL","AUG","SEPT","OCT","NOV","DEC","JAN","FEB","MAR");
$month = array();
$monthlycredit = array();
$monthlydebit = array();

$query  = "SELECT `type`,SUM(amount) AS sum from finance_records where crdr='DR'  group by type";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)){
    array_push($graph, array('value' => $row['type'],'url'=>'expense_details.php?val='.$row['type'].' ','sum'=>intval($row['sum'])));
}

$query2  = "SELECT `type`,SUM(amount) AS sum1 from finance_records where crdr='CR' group by type";
$result2 = mysqli_query($conn,$query2);
while($row2 = mysqli_fetch_array($result2)){
    array_push($graph2, array('value' => $row2['type'],'url'=>'income_details.php?val='.$row['type'].' ','sum'=>intval($row2['sum1'])));
}

$query3  = " SELECT `month`,`crdr`,SUM(amount) as sum  from `finance_records` where crdr='CR' group by `month`";
$result3 = mysqli_query($conn,$query3);
while($row3 = mysqli_fetch_array($result3)){
    array_push($month,$cars[$row3['month']-1]);
    array_push($monthlycredit,intval($row3['sum']));
}
$query4  = " SELECT `month`,`crdr`,SUM(amount) as sum  from `finance_records` where crdr='DR' group by `month`";
$result4 = mysqli_query($conn,$query4);
while($row4 = mysqli_fetch_array($result4)){
    array_push($month,$cars[$row4['month']-1]);
    array_push($monthlydebit,intval($row4['sum']));
}

$graph = json_encode($graph);
$graph2 = json_encode($graph2);
?>

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/dark.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

am4core.useTheme(am4themes_animated);
// Themes begin
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart3D);
chart.data = <?php echo $graph; ?>;

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries3D());
pieSeries.dataFields.value = "sum";
pieSeries.dataFields.category = "value";
pieSeries.ticks.template.disabled = true;
pieSeries.alignLabels = false;
pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
pieSeries.labels.template.radius = am4core.percent(-40);
pieSeries.labels.template.fill = am4core.color("white");
pieSeries.slices.template.propertyFields.url = "url";
pieSeries.slices.template.cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ];
  
// pieSeries.events.on("hit", function(ev) {
//  console.log("clicked on ", ev.target.labels);
// }, this);
pieSeries.labels.template.adapter.add("radius", function(radius, target) {
  if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
    return 0;
  }
  return radius;
});

pieSeries.labels.template.adapter.add("fill", function(color, target) {
  if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
    return am4core.color("#000");
  }
  return color;
}); 
// ----------------------------------------------------------------------------------------------------------

    am4core.useTheme(am4themes_material);
    var chart = am4core.create("chartdiv1", am4charts.PieChart3D);

    chart.data = <?php echo $graph2; ?>;
    var pieSeries1 = chart.series.push(new am4charts.PieSeries3D());
    pieSeries1.dataFields.value = "sum";
    pieSeries1.dataFields.category = "value";

    pieSeries1.ticks.template.disabled = true;
    pieSeries1.alignLabels = false;
    pieSeries1.labels.template.text = "{value.percent.formatNumber('#.0')}%";
    pieSeries1.labels.template.radius = am4core.percent(-40);
    pieSeries1.labels.template.fill = am4core.color("white");
    pieSeries1.slices.template.cursorOverStyle = [
        {
            "property": "cursor",
            "value": "pointer"
        }
    ];
    pieSeries1.labels.template.adapter.add("radius", function(radius, target) {
        if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
            return 0;
        }
        return radius;
    });

    pieSeries1.labels.template.adapter.add("fill", function(color, target) {
        if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
            return am4core.color("#000");
        }
        return color;
    });

// ----------------------------------------------------------------------------------------------------------

});

</script>

<!-- HTML -->

            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="clearfix">
                        <a href="inexpdetials.php" class="float-right btn btn-primary btn-sm">View Details</a>
                        <h4 class="card-title float-left">Income And Expense Statistics For <?php echo date('Y')-1; ?></h4>
                        <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                      </div>
                      <canvas id="visit-sale-chart" class="mt-4"></canvas>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <a href="expense_details.php" class="btn btn-primary btn-sm float-right" style="cursor:pointer">View Complete Analysis</a>
                    <h4 class="card-title">Expense Analysis  For <?php echo date('Y')-1; ?></h4><hr>
                    <div id="chartdiv" style="height:350px"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <a href="income_details.php"" class="btn btn-primary btn-sm float-right" style="cursor:pointer">View Complete Analysis</a>
                    <h4 class="card-title">Income Analysis  For <?php echo date('Y')-1; ?></h4><hr>
                    <div id="chartdiv1" style="height:350px"></div>
                  </div>
                </div>
              </div>
            </div>

<?php  include './footer.html';?>

<script>
var jsmonth = ['APR', 'MAY', 'JUN', 'JUL', 'AUG','SEPT','OCT','NOV','DEC','JAN', 'FEB', 'MAR'];
var valscredit = [];
var valsdebit = [];
<?php 

$index = 0;
for($i = 3 ;$i<12;$i++){
  if(in_array($cars[$i],$month)){
    $index=array_search($cars[$i],$month);
    array_push($valscredit,$monthlycredit[$index]);
 }else{
      array_push($valscredit,0);
  }
}

$index = 0;
for($i =0 ;$i<3;$i++){
  if(in_array($cars[$i],$month)){
    $index=array_search($cars[$i],$month);
    array_push($valscredit,$monthlycredit[$index]);
 }else{
      array_push($valscredit,0);
  }
}
$index = 0;
for($i = 3 ;$i<12;$i++){
  if(in_array($cars[$i],$month)){
    $index=array_search($cars[$i],$month);
    array_push($valsdebit,$monthlydebit[$index]);
 }else{
      array_push($valsdebit,0);
  }
}

$index = 0;
for($i =0 ;$i<3;$i++){
  if(in_array($cars[$i],$month)){
    $index=array_search($cars[$i],$month);
    array_push($valsdebit,$monthlydebit[$index]);
 }else{
      array_push($valsdebit,0);
  }
}
?>
  if ($("#visit-sale-chart").length) {
    Chart.defaults.global.legend.labels.usePointStyle = true;
    var ctx = document.getElementById('visit-sale-chart').getContext("2d");
    
    var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 360);
    gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
    gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
    var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

    var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
    gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
    var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: jsmonth,
        datasets: [
          {
            label: "Income",
            borderColor: gradientStrokeRed,
            backgroundColor: gradientStrokeRed,
            hoverBackgroundColor: gradientStrokeRed,
            legendColor: gradientLegendRed,
            pointRadius: 0,
            fill: true,
            borderWidth: 1,
            fill: 'origin',
            data: <?php echo json_encode($valscredit); ?>,
          },
          {
            label: "Expense",
            borderColor: gradientStrokeBlue,
            backgroundColor: gradientStrokeBlue,
            hoverBackgroundColor: gradientStrokeBlue,
            legendColor: gradientLegendBlue,
            pointRadius: 0,
            fill: false,
            borderWidth: 1,
            fill: 'origin',
            data: <?php echo json_encode($valsdebit); ?>,  
          }
        ]
      },
      options: {
        responsive: true,
        legend: false,
        legendCallback: function (chart) {
          var text = [];
          text.push('<ul>');
          for (var i = 0; i < chart.data.datasets.length; i++) {
            text.push('<li><span class="legend-dots" style="background:' +
              chart.data.datasets[i].legendColor +
              '"></span>');
            if (chart.data.datasets[i].label) {
              text.push(chart.data.datasets[i].label);
            }
            text.push('</li>');
          }
          text.push('</ul>');
          return text.join('');
        },
        scales: {
          yAxes: [{
            ticks: {
              display: true,
            },
            gridLines: {
              drawBorder: false,
              color: 'rgba(219,219,219,1)',
              zeroLineColor: 'rgba(235,237,242,1)'
            }
          }],
          xAxes: [{
            gridLines: {
              display: false,
              drawBorder: false,
              color: 'rgba(0,0,0,1)',
              zeroLineColor: 'rgba(235,237,242,1)'
            },
            ticks: {
              padding: 20,
              fontColor: "#555",
              autoSkip: true,
            },
            categoryPercentage: 0.7,
            barPercentage: 0.8
          }]
        }
      },
      elements: {
        point: {
          radius: 0
        }
      }
    })
    $("#visit-sale-chart-legend").html(myChart.generateLegend());
  }
</script>