<?php 
include("lib/config.php");

include("nav-all.php");
?>
<?php 
// include"nav.php";

?>
<style type="text/css">
mark {
    background: orange;
    color: black;
}
table tbody tr.odd.selected, table tbody tr.even.selected {
    background-color: paleturquoise;
}

table tbody tr td.highlightcolumn {
    background-color: lavender !important;
}
.btn-staff {
    padding: 5px 10px;
    font-size: 11px;
    line-height: 0.6;
    border-radius: 2px;
}

</style>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-user"></i> Staffs List with progress
                </h2>
            </div>
        </div>
    </div>




    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-12">


<?php
$query = query("SELECT c.title AS c_title, u.id, u.title, CONCAT(u.firstname, ' ', u.lastname) AS fullname, u.deptname, u.jobfamilyname, p.progress FROM training_program AS p
 LEFT JOIN  training_user AS u ON p.user = u.id 
 LEFT JOIN  training_course AS c ON p.course = c.id
  WHERE p.progress > 0
  ORDER BY p.progress DESC");

//$query = query("SELECT id, title, CONCAT(firstname, ' ', lastname) AS fullname, deptname, jobfamilyname, email, DATE_FORMAT(date, '%b %e, %y - %l:%i %p') AS format_date FROM training_user WHERE email != 'records' AND email != 'manager' AND email != 'admin' AND id != 'femotizo' ORDER BY date DESC");

$count= mysqli_num_rows($query);
if($count){
?>

                <div class="font-bold fa-lg m-b-sm">
                     Staff List
                </div>

                <div class="hpanel">

                    <div class="panel-body">

                    <table id="example1" class="table table-striped table-bordered table-hover" style="font-size: 12.5px;" width="100%">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Title </th>
                                <th class="column-title">Name </th>
                                <th class="column-title">Department </th>
                                <th class="column-title">Job Family </th>
                                <th class="column-title">Course </th>
                                <th class="column-title">Progress </th>
                                <th class="column-title"> </th>
                              </tr>
                            </thead>

                            <tbody>
<?php
/*
$query = query("SELECT c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, DATE_FORMAT(c.date, '%a, %b %y') AS c_date, COUNT(p.progress) AS p_enrolled, SUM(p.progress  = '100' ) AS p_completed,  SUM(p.progress  != '100' ) AS p_inprogresss FROM $tbl_course AS c 
                LEFT JOIN $tbl_program AS p ON c.id = p.course
                GROUP BY c.id");
                */
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $id        = $rows['id']; 
        $u_title        = $rows['title']; 
        $fullname    = $rows['fullname']; 
       // $progress       = $rows['progress']; 
        $jobfamilyname  = $rows['jobfamilyname'];
        $progress    = $rows['progress'];
       // $designation    = $rows['designation'];
        $deptname    = $rows['deptname'];
        $c_title    = $rows['c_title'];
       // $lessontotal   = ($rows['lessontotal'] !=null)?$rows['lessontotal']:0; 
        //$assigtotal   = ($rows['assigtotal'] !=null)?$rows['assigtotal']:0; 

          switch ($progress) {
            case 'd':
               $status = "<span class='label label-info'>completed<span>";
              break;
            
            default:
                $status = "<span class='label label-warning'>$progress% done<span>";
              break;
          }
     ?>
                    <tr>
                      <td><?=changeTitle($u_title)?></td>
                      <td><?=$fullname?></td>
                      <td data-search="<?=$deptname?>"><?=abbrevDept($deptname)?></td>
                      <td data-search="<?=$jobfamilyname?>"><?=abbrevJobFamily($jobfamilyname)?></td>
                      <td><?=$c_title?></td>
                      <td data-search="<?=$status?>"><?=$status?></td>
                      <td><a href="staff-info.php?id=<?=$id?>&n=<?=$fullname?>" class="btn btn-staff btn-sm btn-outline btn-info btn-edit"> View </a></td>
                    </tr>

<?php } ?>

                         
                        </tbody>
                      </table>
                    </div>

                </div>
<?php }else{?>

                <div class="font-bold fa-lg m-b-sm">
                     Staff List
                </div>

                <div class="hpanel">

                    <div class="panel-body">


                    </div>

                </div>
<?php } ?>

            </div>




    </div>


       
        
        
        
<?php include"footer.php";?>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/peity/jquery.peity.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>
<!-- DataTables -->
<script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables buttons scripts -->
<script src="vendor/pdfmake/build/pdfmake.min.js"></script>
<script src="vendor/pdfmake/build/vfs_fonts.js"></script>
<script src="vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="vendor/datatables-markjs/mark-js-plus-datatables.mark.js"></script>


<script language="javascript">
$(function () {
    var _d = "<?=date('Y-m-d')?>";

          // Initialize Example 1
var table = $('#example1').DataTable( {
        mark: true,/*
            "ajax": 'lib/api-staffs.php', */
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            lengthMenu: [ [-1], ["All"] ],
            buttons: [
                {extend: 'copy',className: 'btn-sm'},
                {extend: 'csv',title: 'Staff-record-'+_d, className: 'btn-sm'},
                {extend: 'pdf', title: 'Staff-record-'+_d, className: 'btn-sm'},
                {extend: 'print',className: 'btn-sm'}
            ]
        });


 
    $('#example1 tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

    $('#example1 tbody')
        .on( 'mouseenter', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            $( table.cells().nodes() ).removeClass( 'highlightcolumn' );
            $( table.column( colIdx ).nodes() ).addClass( 'highlightcolumn' );
        } )
        .on( 'mouseout', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            $( table.cells().nodes() ).removeClass( 'highlightcolumn' );
           // $( table.column( colIdx ).nodes() ).addClass( 'highlightcolumn' );
        } );





 /*
var table = $('#example').DataTable();
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    } );
 */




      $("span.pie").peity("pie", {
        fill: ["#62cb31", "#edf0f5"]
    });
});
</script>
<script src="scripts/table-core.js"></script><!--   -->
