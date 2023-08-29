<?php 
    include "header.php";


?>

                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>Package Details</h4>
                                                    <span>List of  all Packages</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#!">Package Details</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <div class="page-body">
										<div class="row">
                                            <div class="col-sm-12">
                                                <!-- HTML5 Export Buttons table start -->
                                                <div class="card">
                                                     <div class="card-header table-card-header">
                                                    

                                                    </div>
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <table data-page-length="500" id="basic-btn" class="table table-striped table-bordered nowrap">
                                                                <thead>
                                                                    <tr>                                                                        
                                                                        <th>#</th>
                                                                        <th>Package</th>
                                                                        <th>Purchased count</th>
                                                                        <!-- <th>Datetime</th> -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                        <?php 
                        $sql = "SELECT p.package_name,
                        COUNT(pd.id) AS purchased_count FROM  package_details pd, package p where p.id=pd.pkg_id GROUP BY
    p.package_name";
//                         $sql = "SELECT
//     p.package_name,
//     COUNT(pd.id) AS purchased_count
// FROM
//     package_details pd,
//     package p
// WHERE
//     p.id = pd.pkg_id
// GROUP BY
//     p.package_name;
// ";
                        $result = mysqli_query($con, $sql);
                                                
                        $x = 1;
                        while ( $data = mysqli_fetch_array($result)):
                        //echo "$pkgstatus"."<br/>";
                            

                        ?>
                                                            <tr>
                                                                <td><?php echo $x++; ?></td>
                                                                <td><?php echo $data['package_name'];  ?></td>
                                                                <td><?php echo $data['purchased_count'];  ?></td>
                                                                <!-- <td><?php echo date('Y-m-d:h-m:s',strtotime($data['date']) );  ?></td> -->
                                                            </tr>
                                                            <?php endwhile; ?>                                    
                                                        </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Package</th>
                                                                        <th>Purchased count</th>
                                                                        <!-- <th>Datetime</th> -->
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- HTML5 Export Buttons end -->
                                            </div>
                                        </div>


                                </div>


                            </div>
                        </div>z






<?php
    include "footer.php";
?>                        
 <script type="text/javascript">
     $(document).ready(function(){
// Reject
        $(document).on("click", ".edit_roi", function () {

        var roiID = $(this).data('wid');
        var roiDays = $(this).data('roidays');

     $(".modal-body #roiID").val( roiID );
     $(".modal-body #roiDays").val( roiDays );


     });

     });
 </script>  
