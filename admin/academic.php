<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Academic Office</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Academic Office";
            include "navbar.php";

            // Avoid admin user from accessing other office pages
            if ($_SESSION['office_name'] != "Academic Office") {
                header("Location: http://localhost/admin/redirect.php");
            }
        ?>
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="d-flex w-100 justify-content-between p-0">
                        <div class="d-flex p-2">
                            <select class="form-select" id="transaction-type">
                                <option value="">All</option>
                                <option value="subjectoverload">Subject Overload</option>
                                <option value="gradeaccreditation">Grade Accreditation</option>
                                <option value="crossenrollment">Cross-Enrollment</option>
                                <option value="shifting">Shifting</option>
                                <option value="manualenrollment">Manual Enrollment</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <div class="input-group mb-3 d-flex justify-content-end">
                                <input type="text" class="form-control" placeholder="Search...">
                                <button class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <table id="transactions-table" class="table table-hover table-bordered"></table>
                </div>
            </div>
            <div class="d-flex w-100 justify-content-between p-2">
                <!-- Add footer buttons here -->
            </div>
            
        </div>
        <div class="push"></div>
    </div>
    <?php include '../footer.php'; ?>
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
            });
        });
    </script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('transaction-type');
            const table = document.getElementById('transactions-table');

            const defaultTable = `<thead>
                    <tr>
                        <th class="text-center" scope="col">Request Code</th>
                        <th class="text-center" scope="col">Requestor</th>
                        <th class="text-center" scope="col">Application</th>
                        <th class="text-center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AO-SO-001</td>
                        <td></td>
                        <td>Subject Overload</td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                                <option value="1">Pending</option>
                                <option value="2">Missing</option>
                                <option value="3">Under Verification</option>
                                <option value="4">Verified</option>
                            </select>
                        </td>         
                    </tr>
                    <tr>
                        <td>AO-GA-002</td>
                        <td></td>
                        <td>Grade Accreditation</td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                            <option value="1">Pending</option>
                                <option value="2">Missing</option>
                                <option value="3">Under Verification</option>
                                <option value="4">Verified</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>AO-CE-003</td>
                        <td></td>
                        <td>Cross-Enrollment</td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                            <option value="1">Pending</option>
                                <option value="2">Missing</option>
                                <option value="3">Under Verification</option>
                                <option value="4">Verified</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>AO-S-004</td>
                        <td></td>
                        <td>Shifting</td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                            <option value="1">Pending</option>
                                <option value="2">Missing</option>
                                <option value="3">Under Verification</option>
                                <option value="4">Verified</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>AO-ME-005</td>
                        <td></td>
                        <td>Manual Enrollment</td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                            <option value="1">Pending</option>
                                <option value="2">Missing</option>
                                <option value="3">Under Verification</option>
                                <option value="4">Verified</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            `;
            table.innerHTML = defaultTable;
        })
    </script>
    <script src="../loading.js"></script>
</body>
</html>