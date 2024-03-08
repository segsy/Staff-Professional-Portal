<?php 
include("lib/config.php");

include("nav-all.php");
?>

<?php 
// include"nav.php";
$_d   = isset( $_GET['d'] ) ? escape_s($_GET['d']) : '';
$_c   = isset( $_GET['c'] ) ? escape_s($_GET['c']) : '';
$_n   = isset( $_GET['n'] ) ? escape_s($_GET['n']) : '';

$query = query("SELECT d.name AS d_name, COUNT(d.id) AS d_record, SUM(p.progress  = '100' ) AS p_completed,  SUM(p.progress  != '100' ) AS p_inprogress FROM training_program AS p
 LEFT JOIN training_dept AS d ON (p.dept = d.id)
 WHERE p.course='$_c' AND p.dept = '$_d'");
while($rows=mysqli_fetch_array($query)){
        $_name      = $rows['d_name']; 
        $_record    = $rows['d_record']; 
        $_completed = $rows['p_completed'];
        $_inprogress  = $rows['p_inprogress'];

        $_percent = number_format( ($_completed/$_record) * 100, 2 ); // change 2 to # of decimals

      }


$line = 0;
/*
$dataset0 = array(
            0 => 0,
            1 => 0
       );
$dataset1 = array(
            0 => 0,
            1 => 0
       );
       */
$dataset1 = array();
$dataset0 = array();
$chartquery = query("SELECT DAYOFMONTH(start) AS date_day, DAYNAME(start) AS date_name, COUNT(start) AS attendance FROM training_record
WHERE course = '$_c' AND dept = '$_d'
GROUP BY DAYNAME(start)
ORDER BY start ASC");
/*
while($rows=mysqli_fetch_array($chartquery)){
        $line++;
        $date_day     = $rows['date_day']; 
        $date_name    = $rows['date_name'];
        $attendance   = $rows['attendance'];

        echo "$line : $attendance \n"; // change 2 to # of decimals
}
*/

while ($row = mysqli_fetch_assoc($chartquery)) { //or whatever
  $numb = $line++;
    $dataset1[] = array( (int)$numb, (int)$row['attendance'] + 2 );
    $dataset0[] = array( (int)$numb, (int)$row['attendance'] );
}
//print_r($dataset0);
?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">
                            <span>Add A New COurse</span>
                        </li>
                    </ol>
                </div>
                <h4 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <?=$_n?> Overview
                </h4>
            </div>
        </div>
    </div>













    <div class="content animate-panel">

        <div class="row">

            <div class="col-md-8">

                <div class="font-bold m-b-sm">
                    ATTENDANCE CHART
                </div>

                <div class="hpanel">
                    <div class="panel-body">

                        <small>
                            <?=$_name?> daily staff attendance record
                        </small>



                        <div class="m-t-md">
                              <div class="flot-chart" style="height: 200px">
                                  <div class="flot-chart-content" id="flot-line-chart"></div>
                               </div>
                        </div>
                    </div>
                </div>




                <div class="font-bold m-b-sm">
                    ENROLLMENT LIST
                </div>


        <div class="hpanel">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-check"></i> Completed </a></li>
                <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-database"></i> In Progress</a></li>
            </ul>

            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">



<?php
$query = query("SELECT u.title AS u_title, u.firstname AS u_firstname, u.lastname AS u_lastname, p.progress, jobfamilyname, designation FROM training_program AS p
LEFT JOIN training_user AS u ON p.user = u.id
WHERE p.course = '$_c' AND p.dept = '$_d' AND p.progress = '100'");
if(mysqli_num_rows($query)){
?>
                        <div class="alert alert-info">
                        <strong>Information</strong>
                        <p>Table showing courses completed by staff members of <?=$_n?>. </p>
                        </div><br>

                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Title </th>
                                <th class="column-title">Name </th>
                                <th class="column-title">Job Family </th>
                              </tr>
                            </thead>

                            <tbody>


<?php
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $u_title        = $rows['u_title']; 
        $u_firstname    = $rows['u_firstname']; 
        $u_lastname     = $rows['u_lastname']; 
        $progress       = $rows['progress']; 
        $jobfamilyname  = $rows['jobfamilyname'];
        $designation    = $rows['designation'];

     ?>
                    <tr>
                      <td><?=$u_title?></td>
                      <td><?=$u_firstname?> <?=$u_lastname?></td>
                      <td><?=$jobfamilyname?></td>
                    </tr>
<?php } ?>
                        </tbody>
                      </table>
<?php }else{ ?>


                        <div class="alert alert-warning">
                        <strong>Information not available</strong>
                        <p><?=$_n?> is yet to be completed by staff members of <?=$_name?>, kindly click on the <strong><i class="fa fa-database"></i> In Progress</strong> tab for a list of staffs taking this course</p>
                        </div>
<?php } ?>

                </div>
               </div>



                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">

                        <div class="alert alert-info m-b-sm">
                        <strong>Information</strong>
                        <p>Table showing list of staff members of <?=$_name?> taking  <?=$_n?> course</p>
                        </div><br>


<?php
$query = query("SELECT u.title AS u_title, u.firstname AS u_firstname, u.lastname AS u_lastname, p.progress, jobfamilyname, designation FROM training_program AS p
LEFT JOIN training_user AS u ON p.user = u.id
WHERE p.course = '$_c' AND p.dept = '$_d' AND p.progress < '100'");
if(mysqli_num_rows($query)){
?>

                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Name </th>
                                <th class="column-title">Job Family </th>
                                <th class="column-title">Chart </th>
                                <th class="column-title">Completed </th>
                              </tr>
                            </thead>

                            <tbody>

  <?php
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $u_title        = $rows['u_title']; 
        $u_firstname    = $rows['u_firstname']; 
        $u_lastname     = $rows['u_lastname']; 
        $progress       = $rows['progress']; 
        $jobfamilyname  = $rows['jobfamilyname'];
        $designation    = $rows['designation'];
     ?>
                    <tr>
                      <td><?=$u_title?> <?=$u_firstname?> <?=$u_lastname?></td>
                      <td><?=$jobfamilyname?></td>
                      <td>
                       <span class="pie"><?=$progress?>/100</span>
                      </td>
                       <td><?=$progress?>%<strong></strong></td>
                   </tr>
<?php } ?>
                        </tbody>
                      </table>
<?php }else{ ?>


                        <div class="alert alert-warning">
                        <strong>Information not available</strong>
                        <p><?=$_n?> has been completed by staff members of <?=$_name?>, kindly click on the <strong><i class="fa fa-check"></i> Completed</strong> tab for a list of staffs that enrolled in this course</p>
                        </div>

<?php } ?>
                    </div>
                     </div>
            </div>


        </div>









            </div>









            <div class="col-md-4">

                <div class="font-bold m-b-sm">
                    STAFF ACTIVITIES
                </div>



                <div class="hpanel stats">
                    <div class="panel-body h-200">
                        <div class="stats-title pull-left">
                            <h4></h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-study fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h3 class="m-b-xs"><?=$_record?> Staff Enrolled</h3>

                            <div class="progress m-t-xs full progress-small">
                                <div style="width: <?=$_percent?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="55" role="progressbar" class=" progress-bar progress-bar-info">
                                    <span class="sr-only"><?=$_percent?>% Complete (success)</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stats-label">Completed</small>
                                    <h4><?=$_completed?></h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stats-label">In Progress</small>
                                    <h4><?=$_inprogress?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                         <?=$_name?> Records
                    </div>
                </div>



                <div class="font-bold m-b-sm">
                    PARTICIPATION CHART
                </div>

                                <div class="hpanel stats">
                    <div class="panel-body h-200">
                    <!--
                        <div class="stats-title pull-left">
                            <h4>Users Activity</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-share fa-4x"></i>
                        </div>

                        -->

                            <div class="flot-chart-content" id="datatable" style="height: 300px;width: 300px;"></div>


                         <div class="clearfix"></div>
                    </div>
                    <div class="panel-footer">
                         <?=$_name?> Records
                    </div>
                </div>


            </div>


        </div>

    </div>



       
        
        
        
<?php include"footer.php";?>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>

<script src="vendor/peity/jquery.peity.min.js"></script>
<script src="vendor/jquery-flot/jquery.flot.js"></script>
<script src="vendor/jquery-flot/jquery.flot.resize.js"></script>
<script src="vendor/jquery.flot.spline/index.js"></script>

<!--  
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
 -->
<script src="vendor/highcharts/highcharts.js"></script>
<script src="vendor/highcharts/exporting.js"></script>
<script language="javascript">

$(function () {
  
      $("span.pie").peity("pie", {
        fill: ["#62cb31", "#edf0f5"]
    });

      var dataset1 = <?php echo json_encode($dataset1); ?>;
      var dataset0 = <?php echo json_encode($dataset0); ?>;

        /**
         * Flot charts data and options
         */
        //var data1 = [ [0, 55], [1, 48], [2, 40], [3, 36], [4, 40], [5, 60], [6, 50], [7, 51] ];
        //var data2 = [ [0, 56], [1, 49], [2, 41], [3, 38], [4, 46], [5, 67], [6, 57], [7, 59] ];
        var data1 = dataset0;
        var data2 = dataset1;

        var chartUsersOptions = {
            series: {
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
            },
            grid: {
                tickColor: "#f0f0f0",
                borderWidth: 1,
                borderColor: 'f0f0f0',
                color: '#6a6c6f'
            },
            colors: [ "#3E8BEA", "#efefef"],
        };

        $.plot($("#flot-line-chart"), [data1, data2], chartUsersOptions);



  Highcharts.theme = {
   colors: ['#f6b1d0', '#bad6f8', '#50e4ec'],
   chart: {
      backgroundColor: null,
      style: {
         fontFamily: 'Dosis, sans-serif'
      }
   },
   title: {
      style: {
         fontSize: '16px',
         fontWeight: 'bold',
         textTransform: 'uppercase'
      }
   },
   tooltip: {
      borderWidth: 0,
      backgroundColor: 'rgba(219,219,216,0.8)',
      shadow: false
   },
   legend: {
      itemStyle: {
         fontWeight: 'bold',
         fontSize: '13px'
      }
   },
   xAxis: {
      gridLineWidth: 1,
      labels: {
         style: {
            fontSize: '12px'
         }
      }
   },
   yAxis: {
      minorTickInterval: 'auto',
      title: {
         style: {
            textTransform: 'uppercase'
         }
      },
      labels: {
         style: {
            fontSize: '12px'
         }
      }
   },
   plotOptions: {
      candlestick: {
         lineColor: '#404048'
      }
   },


   // General
   background2: '#F0F0EA'

};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);

 // Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });
    // Build the chart
    Highcharts.chart('datatable', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
    
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'blue'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Subscription',
            data: [
                {
                    name: 'Completed',
                    y: <?=$_completed?>,
                    sliced: true,
                    selected: true
                },
                { name: 'In Progress', y: <?=$_inprogress?> },
            ]
        }]
    });
});
</script>