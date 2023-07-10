<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Registrar Office</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
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
            include "navbar.php";

            // Avoid admin user from accessing other office pages
            if ($_SESSION['office_name'] != "Registrar Office") {
                header("Location: http://localhost/admin/redirect.php");
            }
        ?>
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-xs-12">
                    <div class="d-flex w-100 justify-content-between p-0">
                        <div class="d-flex p-2">
                            <select class="form-select" id="transaction-type">
                                <option value="requests">Registrar's Document Requests</option>
                            <!--    <option value="completed">Completed Document Requests</option> for history transaction option--> 
                                <option value="records">Student Records</option>
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
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">Scholar Status</th>
                        <th class="text-center" scope="col">Request Document</th>
                        <th class="text-center" scope="col">Schedule</th>
                        <th class="text-center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>RO-0003</td>
                        <td>Juan Dela Cruz</td>
                        <td>Student</td>
                        <td>Certification of Grades</td>
                        <td>12/05/2023</td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                                <option value="pending" style="background-color: green; color: #fff;">Pending</option>
                                <option value="receiving" style="background-color: red; color: #fff;">Receiving</option>
                                <option value="releasing" style="background-color: yellow;">Releasing</option>
                                <option value="completed" style="background-color: orange;">Completed</option>
                            </select>
                        </td>         
                    </tr>
                    <tr>
                    <td>RO-0005</td>
                        <td>Juana Madrigal</td>
                        <td>Visitor</td>
                        <td>Transcript of Records</td>
                        <td>12/05/2023</td>
                        <td class="text-center">
                            <select class="form-select" id="status">
                                <option value="pending" style="background-color: green; color: #fff;">Pending</option>
                                <option value="receiving" style="background-color: red; color: #fff;">Receiving</option>
                                <option value="releasing" style="background-color: yellow;">Releasing</option>
                                <option value="completed" style="background-color: orange;">Completed</option>
                            </select>
                        </td>  
                    </tr>
                </tbody>
            `;
            table.innerHTML = defaultTable;
            
            dropdown.addEventListener('change', function() {
            // Get the selected value
            const selectedValue = this.value;
            
            // Change the table based on the selected value
            if (selectedValue === 'requests') {
                // Show the document requests and schedules table
                table.innerHTML = defaultTable;
            }
            
            else if (selectedValue === 'completed') {
                // Show the payments table
                table.innerHTML = `
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Request Code</th>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">Scholar Status</th>
                        <th class="text-center" scope="col">Request Document</th>
                        <th class="text-center" scope="col">Schedule</th>
                        <th class="text-center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       
                    </tr>
                    <tr>
                        <td>AO-0002</td>
                        <td>Tuition Fee</td>
                        <td>PHP 899.50</td>
                        <td>15/05/2023 10:00 AM</td>
                        <td class="text-center">
                            <select class="form-select" id="changeStatus">
                                <option>
                                    <span class="badge rounded-pill bg-success">Approved</span>
                                </option>
                                <option>
                                    <span class="badge rounded-pill bg-danger">Disapproved</span>
                                </option>
                                <option>
                                    <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                                </option>
                            </select>
                        </td>
                    </tr>
                </tbody>`
                ;
                }

                else if (selectedValue === 'records') {
                table.innerHTML = `
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Student Number</th>
                            <th class="text-center" scope="col">Name</th>
                            <th class="text-center" scope="col">Program</th>
                            <th class="text-center" scope="col">Shelf Location</th>
                            <th class="text-center" scope="col">Scholar Status</th>
                            <th class="text-center" scope="col">Requirements Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                        </tr>
                    </tbody>
                `;
            }
            })
        })
    </script>
    <script src="../loading.js"></script>
</body>
</html>