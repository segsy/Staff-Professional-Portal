<?php 
include"nav.php";
$_d   = isset( $_GET['d'] ) ? escape_s($_GET['d']) : '';
$_c   = isset( $_GET['i'] ) ? escape_s($_GET['i']) : '';
$_n   = isset( $_GET['n'] ) ? escape_s($_GET['n']) : '';


// PIE CHART & PROGRESS BAR TABLE DATA
$query = query("SELECT COUNT(p.id) AS p_total, SUM(p.progress  = '100' ) AS p_completed,  SUM(p.progress  != '100' ) AS p_inprogress FROM training_program AS p
 WHERE p.course='$_c'");
while($rows=mysqli_fetch_array($query)){
        $p_total    = $rows['p_total']; 
        $_completed = $rows['p_completed'];
        $_inprogress  = $rows['p_inprogress'];
        $_percent = number_format( ($_completed/$p_total) * 100, 1 ); // change 2 to # of decimals
        // $_percent = ''; // change 2 to # of decimals

      }


$line = 0;
$dataset0 = array();
$dataset1 = array();
$chartquery = query("SELECT DAYOFMONTH(start) AS date_day, DAYNAME(start) AS date_name, COUNT(start) AS attendance FROM training_record
WHERE course = '$_c'
GROUP BY DAYNAME(start)
ORDER BY start ASC");

while ($row = mysqli_fetch_assoc($chartquery)) { //or whatever
  $numb = $line++;
    $dataset1[] = array( (int)$numb, (int)$row['attendance'] + 2 );
    $dataset0[] = array( (int)$numb, (int)$row['attendance'] );
}
//print_r($dataset0);



// MOST WATCHED DATA
$query = query("SELECT t.id, l.title, COUNT(t.lesson) AS lesson_total FROM training_record t
LEFT JOIN training_lesson l ON t.lesson = l.id
WHERE course = '$_c' GROUP BY t.lesson;");
while($rows=mysqli_fetch_array($query)){
        $most_title    = $rows['title']; 
        $most_lesson_total = $rows['lesson_total'];
      }



// BAR CHART & TOP DEPARTMENT TABLE DATA
  $query = query("SELECT d.name, COUNT(dept) AS total FROM training_program t
LEFT JOIN training_dept d ON t.dept = d.id
WHERE course = '$_c'
GROUP BY dept ORDER BY total DESC LIMIT 15"); 
    $jsonname = $jsontotal = array();
  while($rows=mysqli_fetch_array($query))
                {
                  $jsonname[]   =abbrevDept($rows['name']); 
                  $jsontotal[] =$rows['total'];
                }
$_first_name = array_slice($jsonname, 0, 1);   // returns "the first name"
$_first_value = array_slice($jsontotal, 0, 1);   // returns "the first value"
//reset(array);
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
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                            <a class="closebox"><i class="fa fa-times"></i></a>
                        </div>
                        Dashboard information and statistics
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                        <i class="pe-7s-study fa-4x m-b-sm"></i>

                        <h1 class="m-xs"><?=$p_total?></h1>

                        <h3 class="font-extra-bold m-t-sm text-info">
                            Enrolled
                        </h3>
                        <small>A toal of <?=number_format($p_total)?> staffs enrolled for <?=$_n?> with over <?=number_format($_completed)?> completed</small>


                            </div>
                            <div class="col-md-9">
                                <div class="text-center small">
                                    <i class="fa fa-laptop"></i> Active users in current month (December)
                                </div>
                                <div class="flot-chart" style="height: 190px">
                                    <div class="flot-chart-content" id="flot-line-chart"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                    <span class="pull-right">
                       Daily attendance of staff taking a class in <?=$_n?> course
                    </span>
                        Last update: <?=date('d.M.Y')?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-3">
                <div class="hpanel stats">
                    <div class="panel-body h-200">
                        <div class="stats-title pull-left">
                            <h4>PROGRESS CHART</h4>
                        </div>

                          <div class="flot-chart m-b-sm m-t-md">
                            <div class="flot-chart-content m-b-sm" id="flot-pie-chart" style="height: 150px"></div>
                         <div class="clearfix"></div>
                         </div>

                    </div>
                    <div class="panel-footer">
                        Progress diagram
                    </div>
                </div>
            </div>





            <div class="col-lg-3">
                <div class="hpanel stats">
                    <div class="panel-body h-200">
                        <div class="stats-title pull-left">
                            <h4>PROGRESS CHART</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-way fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h3 class="m-b-xs"><?=number_format($_percent)?></h3>
                    <span class="font-bold no-margins">
                        <??>
                    </span>

                            <div class="progress m-t-xs full progress-small">
                                <div style="width: <?=$_percent?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="55"
                                     role="progressbar" class=" progress-bar progress-bar-info">
                                    <span class="sr-only"><?=$_percent?>% Complete </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stats-label">In Progress</small>
                                    <h4><?=number_format($_inprogress)?></h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stats-label">% Completed</small>
                                    <h4><?=$_percent?>%</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        Progress bar
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="hpanel">
                    <div class="panel-body text-left h-200">
                            <div class="stats-title pull-left">
                            <h4>TOP DEPARTMENT</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-graph1 fa-4x"></i>
                        </div>                                            

                        <div class="m-t-xl">
                            <h3 class="m-b-sm"><?=number_format($_first_value[0])?></h3>
                              <span class="font-bold no-margins text-info">
                                  <?=$_first_name[0]?>
                              </span><br>

                        <small>Based on the highest no of staffs from a department enrolled and completed</small>
                    </div>
                    </div>
                    <div class="panel-footer">
                        First on the list of top ten
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="hpanel stats">
                    <div class="panel-body h-200">
                        <div class="stats-title pull-left">
                            <h4>Most Watched Lesson</h4>
                        </div>
                        <div class="stats-icon pull-right">
                            <i class="pe-7s-display2 fa-4x"></i>
                        </div>
                        <div class="m-t-xl">
                            <h3 class="m-b-md"><?=number_format($most_lesson_total)?></h3>
                            <span class="font-bold no-margins text-info">
                                <?=$most_title?> Lesson
                            </span>
                        </div>
                    </div>
                    <div class="panel-footer">
                        lesson with highest record
                    </div>
                </div>
            </div>







        </div>










<div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                            <a class="closebox"><i class="fa fa-times"></i></a>
                        </div>
                        TOP 15 DEPARTMENT 
                    </div>
                    <div class="panel-body" style="min-height: 350px;">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="flot-chart">
                                  <canvas id="singleBarOptions" height="90"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                    <span class="pull-right">
                        Last update: <?=date('d.M.Y')?>
                    </span>
                          Above is top fifteen departments subscribed to <?=$_n?> chart
                    </div>
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
<script src="vendor/jquery-flot/jquery.flot.pie.js"></script>
<script src="vendor/jquery.flot.spline/index.js"></script>
<script src="vendor/chartjs/Chart.min.js"></script>


<script language="javascript">

  $(function () {
 
       /**
         * Options for Bar chart
         */
        var singleBarOptions = {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.05)",
            scaleGridLineWidth : 1,
            barShowStroke : true,
            barStrokeWidth : 1,
            barValueSpacing : 5,
            barDatasetSpacing : 1,
            responsive:true
        };

        /**
         * Data for Bar chart
         */
        var singleBarData = {
            labels: <?=json_encode($jsonname)?>,
            datasets: [
                {
                    label: "My Second dataset",
                    fillColor: "rgba(62, 139, 234,0.3)",
                    strokeColor: "rgba(62, 139, 234,0.8)",
                    highlightFill: "rgba(62, 139, 234,0.5)",
                    highlightStroke: "rgba(62, 139, 234,1)",
                    data: <?=json_encode($jsontotal)?>
                }
            ]
        };
        var ctx =  document.getElementById("singleBarOptions").getContext("2d");
        var myNewChart = new Chart(ctx).Bar(singleBarData, singleBarOptions);


        /**
         * Pie Chart Data
            { label: "Data 1", data: 16, color: "#62cb31", },
            { label: "Data 2", data: 6, color: "#A4E585", },
            { label: "Data 3", data: 22, color: "#368410", },
            { label: "Data 4", data: 32, color: "#8DE563", }

         */
        var pieChartData = [
            { label: "Data 1", data: <?=$_inprogress?>, color: "#efefef"},
            { label: "Data 2", data: <?=$_completed?>, color: "#3E8BEA",},

        ];

        /**
         * Pie Chart Options
         */
        var pieChartOptions = {
            series: {
                pie: {
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            }
        };

        $.plot($("#flot-pie-chart"), pieChartData, pieChartOptions);






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






});
</script>