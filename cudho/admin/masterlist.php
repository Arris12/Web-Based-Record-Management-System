<?php   
    require '../include/user_session.php'; // $user_id
    include '../include/accessrightfunc.php'; //dashboard access
    checkAccessRights($user_id, 'ar_report');
    include 'nav-bar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CUDHO | Dashboard </title>
    
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    
    <link rel="stylesheet" href="../../adminLTE/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="../../adminLTE/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    
    <link rel="stylesheet" href="../../adminLTE/AdminLTE-3.2.0/dist/css/adminlte.css">

    <link rel="stylesheet" href="../../adminLTE/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="../../adminLTE/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="../../adminLTE/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="../../adminLTE/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="../../adminLTE/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
    
    <script>
        window.addEventListener('DOMContentLoaded', validateDates);

        function validateDates() {
            var form = document.getElementById('myForm');
            var startDateInput = document.getElementById('startdate');
            var endDateInput = document.getElementById('enddate');

            form.addEventListener('submit', function(event) {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                if (endDate < startDate) {
                    event.preventDefault();
                    alert("End date cannot be before the start date.");
                }
            });
        }
    </script>

</head>
<body>
<style>
    * {
        font-family: Arial, sans-serif;
    }

</style>
<div class="content-wrapper" style="min-height: 820px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-1 text-dark">Masterlist <a style="font-size:16px">Dispay and print reports of members information</a></h3>
                        
                            
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Reports</a></li>
                            <li class="breadcrumb-item">Masterlist</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
        <div class="content">
            <div class="col-md-12">
                <div class="card card" >
                    <div class="card-header" style="background-color:maroon; height:50px"></div>
                    <div class="card-body">
                    <form id="myForm" action="PDF_Preview.php" method="POST" target="pdf-frame" class="row">
                    <div class="col-md-3">
                        <label for="startdate">Start Date:</label>
                        <input type="date" id="startdate" style="width: 100%; height: 36px;" name="startdate" required>
                    </div>
                    <div class="col-md-3">
                        <label for="enddate">End Date:</label>
                        <input type="date" id="enddate" style="width: 100%; height: 36px;" name="enddate" required>
                    </div>
                    <div class="col-md-3">
                        <label for="preparedby">Original Masterlist Prepared By:</label>
                        <div class="form-group">
                        <?php
                            include '../include/connect1.php';

                            $query = "SELECT firstname, middlename, lastname FROM tbl_user WHERE id = $user_id";
                            $result = $con->query($query);

                            // Check if the query returned any rows
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $firstname = $row['firstname'];
                                $middlename = $row['middlename'];
                                $lastname = $row['lastname'];

                                $full_name = $firstname . ' ' . $middlename . ' ' . $lastname;

                                // Display the input box with pre-filled value
                                echo '<input type="text" name="preparedby" id="preparedby" value="' . $full_name . '" style="width: 100%; height: 36px;" readonly>';
                            }
                        ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="organizedby">Organized By:</label>
                        <div class="form-group">
                        <?php
                            include '../include/connect1.php';

                            $query = "SELECT firstname, middlename, lastname FROM tbl_user WHERE id = $user_id";
                            $result = $con->query($query);

                            // Check if the query returned any rows
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $firstname = $row['firstname'];
                                $middlename = $row['middlename'];
                                $lastname = $row['lastname'];

                                $full_name = $firstname . ' ' . $middlename . ' ' . $lastname;

                                // Display the input box with pre-filled value
                                echo '<input type="text" name="organizedby" id="organizedby" value="' . $full_name . '" style="width: 100%; height: 36px;" readonly>';
                            }
                        ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="form-group">Barangay</label>
                        <div class="form-group">
                            <select name="address" style="width: 100%; height: 36px;" aria-hidden="true">
                                <option selected="" data-select2-id="0"></option>
                                <option data-select2-id="1">Barangay 01</option>
                                <option data-select2-id="2">Barangay 02</option>
                                <option data-select2-id="3">Barangay 03</option>
                                <option data-select2-id="4">Barangay 04</option>
                                <option data-select2-id="5">Barangay 05</option>
                                <option data-select2-id="6">Barangay 06</option>
                                <option data-select2-id="7">Barangay 07</option>
                                <option data-select2-id="8">Barangay 08</option>
                                <option data-select2-id="9">Barangay 09</option>
                                <option data-select2-id="10">Barangay 10</option>
                                <option data-select2-id="11">Barangay 11</option>
                                <option data-select2-id="12">Barangay 12</option>
                                <option data-select2-id="13">Barangay 13</option>
                                <option data-select2-id="14">Barangay 14</option>
                                <option data-select2-id="15">Barangay 15</option>
                                <option data-select2-id="16">Barangay 16</option>
                                <option data-select2-id="17">Barangay 17</option>
                                <option data-select2-id="18">Barangay 18</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <label for="form-group">Community/Association</label>
                        <div class="form-group">
                            <select name="community" style="width: 100%; height: 36px;" aria-hidden="true">
                                <option selected=""></option>
                                <option data-select2-id="1">Organization</option>
                                <option data-select2-id="2">Association</option>
                                <option data-select2-id="3">Samahan</option>
                                <option data-select2-id="4">Emmersion</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 offset-md-9">
                        <button style="height:36px; width:100%; color:white; background-color:maroon; border:none" type="submit">PREVIEW PDF</button>
                    </div>     
                </form>
                    </div></div></div></div>
</div>
</body>

<?php include ('footer.php'); ?>    
</html>