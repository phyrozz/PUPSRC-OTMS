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
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Academic Office";
            include "navbar.php"
        ?>
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="d-flex w-100 justify-content-between p-0">
                        <div class="d-flex p-2">
                            <select class="form-select" id="transaction-type">
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
                <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </button>
                </button>
                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-primary" disabled>Previous</button>
                    <button class="btn btn-primary" disabled>Next</button>
                </div>
            </div>
            
        </div>
        <div class="push"></div>
    </div>
    <footer class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
        <div>
            <small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
        </div>
        <div>
            <small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
            <small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy Statement</a></small>
        </div>
    </footer>
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
                        <th class="text-center" scope="col">Office</th>
                        <th class="text-center" scope="col">Application</th>
                        <th class="text-center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AO-SO-001</td>
                        <td>Academic Office</td>
                        <td>Subject Overload <a href="/student/academic/subject_overload.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                                <option value="pending" style="background-color: gray; color: #fff;">Pending</option>
                                <option value="needaction" style="background-color: blue; color: #fff;">Needs Action/s</option>
                                <option value="rejected" style="background-color: red; color: #fff">Rejected</option>
                                <option value="approved" style="background-color: green; color: #fff">Approved</option>
                            </select>
                        </td>         
                    </tr>
                    <tr>
                        <td>AO-GA-002</td>
                        <td>Academic Office</td>
                        <td>Grade Accreditation <a href="/student/academic/grade_accreditation.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                                <option value="pending" style="background-color: gray; color: #fff;">Pending</option>
                                <option value="needaction" style="background-color: blue; color: #fff;">Needs Action/s</option>
                                <option value="rejected" style="background-color: red; color: #fff">Rejected</option>
                                <option value="approved" style="background-color: green; color: #fff">Approved</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>AO-CE-003</td>
                        <td>Academic Office</td>
                        <td>Cross-Enrollment <a href="/student/academic/crossenrollment.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                                <option value="pending" style="background-color: gray; color: #fff;">Pending</option>
                                <option value="needaction" style="background-color: blue; color: #fff;">Needs Action/s</option>
                                <option value="rejected" style="background-color: red; color: #fff">Rejected</option>
                                <option value="approved" style="background-color: green; color: #fff">Approved</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>AO-S-004</td>
                        <td>Academic Office</td>
                        <td>Shifting <a href="/student/academic/shifting.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                                <option value="pending" style="background-color: gray; color: #fff;">Pending</option>
                                <option value="needaction" style="background-color: blue; color: #fff;">Needs Action/s</option>
                                <option value="rejected" style="background-color: red; color: #fff">Rejected</option>
                                <option value="approved" style="background-color: green; color: #fff">Approved</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>AO-ME-005</td>
                        <td>Academic Office</td>
                        <td>Manual Enrollment <a href="/student/academic/manualenrollment.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                                <option value="pending" style="background-color: gray; color: #fff;">Pending</option>
                                <option value="needaction" style="background-color: blue; color: #fff;">Needs Action/s</option>
                                <option value="rejected" style="background-color: red; color: #fff">Rejected</option>
                                <option value="approved" style="background-color: green; color: #fff">Approved</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            `;
            table.innerHTML = defaultTable;
        })
    </script>
</body>
</html>