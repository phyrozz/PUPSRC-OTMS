<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/transactions.css">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include "../navbar.php"; ?>
    <div class="wrapper">
        <div class="container-fluid p-4">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Accounting Services Office</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Transactions</li>
                </ol>
            </nav>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>My Transactions</h1>
        </div>
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-xs-12">
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">
                        <i class="fa-solid fa-circle-info"></i> Reminder
                        </h4>
                        <p>You must set an appointment for approved document requests before retrieving it from their respective offices.</p>
                        <p class="mb-0">To set or edit an appointment, click on the <i class="fa-brands fa-wpforms"></i> button on the table.</p> 
                    </div>
                    <div class="d-flex w-100 justify-content-between p-0">
                        <div class="d-flex p-2">
                            <select class="form-select" id="transaction-type">
                                <option value="docreqs">Document Requests</option>
                                <option value="scheds">Document Schedules</option>
                                <option value="payments">Payments</option>
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
                    <a class="btn btn-primary" href="index.php">Previous</button></a>
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
                        <th class="text-center" scope="col">Request</th>
                        <th class="text-center" scope="col">Schedule</th>
                        <th class="text-center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>GO-0001</td>
                        <td>Guidance Office</td>
                        <td>Request Good Moral Document</td>
                        <td>12/05/2023 12:00 PM <a href="/student/guidance/doc_appointments/good_morals.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
                        <td class="text-center"><span class="badge rounded-pill bg-success">Approved</span></td>
                    </tr>
                    <tr>
                        <td>GO-0003</td>
                        <td>Guidance Office</td>
                        <td>Request Clearance</td>
                        <td>-</td>
                        <td class="text-center"><span class="badge rounded-pill bg-danger">Disapproved</span></td>
                    </tr>
                </tbody>
            `;
            table.innerHTML = defaultTable;
            
            dropdown.addEventListener('change', function() {
            // Get the selected value
            const selectedValue = this.value;
            
            // Change the table based on the selected value
            if (selectedValue === 'docreqs') {
                // Show the document requests and schedules table
                table.innerHTML = defaultTable;
            }
            else if (selectedValue === 'scheds') {
                table.innerHTML = `
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Appointment Code</th>
                            <th class="text-center" scope="col">Office</th>
                            <th class="text-center" scope="col">Appointment</th>
                            <th class="text-center" scope="col">Schedule</th>
                            <th class="text-center" scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>GO-0002</td>
                            <td>Guidance Office</td>
                            <td>Schedule Counseling</td>
                            <td>13/05/2023 9:00 AM  <a href="/student/guidance/counceling.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
                            <td class="text-center"><span class="badge rounded-pill bg-success">Approved</span></td>
                        </tr>
                    </tbody>
                `;
            }
             else if (selectedValue === 'payments') {
                // Show the payments table
                table.innerHTML = `
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Accounting Code</th>
                        <th class="text-center" scope="col">Description</th>
                        <th class="text-center" scope="col">Amount Paid</th>
                        <th class="text-center" scope="col">Paid date</th>
                        <th class="text-center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AO-0001</td>
                        <td>COR Certified True Copy</td>
                        <td>PHP 150.00</td>
                        <td>13/05/2023 3:00 PM</td>
                        <td class="text-center"><span class="badge rounded-pill bg-warning text-dark">Pending</span></td>
                    </tr>
                    <tr>
                        <td>AO-0002</td>
                        <td>Tuition Fee</td>
                        <td>PHP 899.50</td>
                        <td>15/05/2023 10:00 AM</td>
                        <td class="text-center"><span class="badge rounded-pill bg-success">Approved</span></td>
                    </tr>
                </tbody>`
                ;
                }
            })
        })
        
    </script>
</body>
</html>