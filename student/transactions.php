<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Select an Office";
            include "../conn.php";
            include "../navbar.php";
        ?>
        <div class="container-fluid p-4">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                    <?php include 'transaction_tables/requests.php'; ?>
                </div>
            </div>
            <div class="d-flex w-100 justify-content-between p-2">
                <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </button>
                </button>
                <div class="d-flex justify-content-end gap-2">
                    <?php if ($page > 1) { ?>
                        <a class="btn btn-outline-primary" href="?page=<?php echo $page - 1; ?>">Previous</a>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <?php if ($i == $page) { ?>
                            <a class="btn btn-primary" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php } else { ?>
                            <a class="btn btn-outline-primary" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($page < $totalPages) { ?>
                        <a class="btn btn-outline-primary" href="?page=<?php echo $page + 1; ?>">Next</a>
                    <?php } ?>
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
    <?php
        // $query = "SELECT office_name, request_description, scheduled_date, scheduled_time, status_name
        // FROM doc_requests
        // INNER JOIN offices ON doc_requests.office_id = offices.id
        // INNER JOIN statuses ON doc_requests.status_id = statuses.id";
    
        // $result = mysqli_query($connection, $query);
    ?>
    <script>
        // window.addEventListener('DOMContentLoaded', function() {
        //     const dropdown = document.getElementById('transaction-type');
        //     const table = document.getElementById('transactions-table');

        //     const defaultTable = `
        //     <thead>
        //             <tr>
        //                 <th class="text-center" scope="col">Office</th>
        //                 <th class="text-center" scope="col">Request</th>
        //                 <th class="text-center" scope="col" data-field="scheduled_date" data-sortable="true" data-sort="scheduled-date">Scheduled Date</th>
        //                 <th class="text-center" scope="col">Scheduled Time</th>
        //                 <th class="text-center" scope="col">Status</th>
        //             </tr>
        //         </thead>
        //         <tbody>
        //                 <?php
        //                     if ($result) {
        //                         while ($row = mysqli_fetch_assoc($result)) {
        //                             $requestDescription = $row['request_description'];
        //                             $scheduledDate = $row['scheduled_date'];
        //                             $scheduledTime = $row['scheduled_time'];
        //                             $officeName = $row['office_name'];
        //                             $statusName = $row['status_name'];
        //                 ?>
        //                 <tr>
        //                     <td><?php echo $officeName; ?></td>
        //                     <td><?php echo $requestDescription; ?></td>
        //                     <td><?php echo $scheduledDate; ?></td>
        //                     <td><?php echo $scheduledTime; ?> <a href="/student/guidance/doc_appointments/good_morals.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
        //                     <td class="text-center"><span class="badge rounded-pill bg-success"><?php echo $statusName; ?></span></td>
        //                 </tr>
        //                 <?php
        //                         }
        //                     }
        //                     else {
        //                         echo "Error executing the query: " . mysqli_error($connection);
        //                     }
        //                 ?>
        //         </tbody>
        //     `;
        //     table.innerHTML = defaultTable;
            
        //     dropdown.addEventListener('change', function() {
        //     // Get the selected value
        //     const selectedValue = this.value;
            
        //     // Change the table based on the selected value
        //     if (selectedValue === 'docreqs') {
        //         // Show the document requests and schedules table
        //         table.innerHTML = defaultTable;
        //     }
        //     else if (selectedValue === 'scheds') {
        //         table.innerHTML = `
        //             <thead>
        //                 <tr>
        //                     <th class="text-center" scope="col">Appointment Code</th>
        //                     <th class="text-center" scope="col">Office</th>
        //                     <th class="text-center" scope="col">Appointment</th>
        //                     <th class="text-center" scope="col">Schedule</th>
        //                     <th class="text-center" scope="col">Status</th>
        //                 </tr>
        //             </thead>
        //             <tbody>
        //                 <tr>
        //                     <td>GO-0002</td>
        //                     <td>Guidance Office</td>
        //                     <td>Schedule Counseling</td>
        //                     <td>13/05/2023 9:00 AM  <a href="/student/guidance/counceling.php" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a></td>
        //                     <td class="text-center"><span class="badge rounded-pill bg-success">Approved</span></td>
        //                 </tr>
        //             </tbody>
        //         `;
        //     }
        //      else if (selectedValue === 'payments') {
        //         // Show the payments table
        //         table.innerHTML = `
        //         <thead>
        //             <tr>
        //                 <th class="text-center" scope="col">Accounting Code</th>
        //                 <th class="text-center" scope="col">Description</th>
        //                 <th class="text-center" scope="col">Amount Paid</th>
        //                 <th class="text-center" scope="col">Paid date</th>
        //                 <th class="text-center" scope="col">Status</th>
        //             </tr>
        //         </thead>
        //         <tbody>
        //             <tr>
        //                 <td>AO-0001</td>
        //                 <td>COR Certified True Copy</td>
        //                 <td>PHP 150.00</td>
        //                 <td>13/05/2023 3:00 PM</td>
        //                 <td class="text-center"><span class="badge rounded-pill bg-warning text-dark">Pending</span></td>
        //             </tr>
        //             <tr>
        //                 <td>AO-0002</td>
        //                 <td>Tuition Fee</td>
        //                 <td>PHP 899.50</td>
        //                 <td>15/05/2023 10:00 AM</td>
        //                 <td class="text-center"><span class="badge rounded-pill bg-success">Approved</span></td>
        //             </tr>
        //         </tbody>`
        //         ;
        //         }
        //     })
        // })
        function getStatusBadgeClass(status) {
            switch (status) {
            case 'Approved':
                return 'bg-success';
            case 'Disapproved':
                return 'bg-danger';
            default:
                return 'bg-secondary';
            }
        }
    </script>
    <?php
        mysqli_close($connection);
    ?>
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
            });

            // sortTableByColumn('scheduled-date');

            // // Add click event listener to the sortable columns
            // $('th[data-sort]').click(function() {
            // const column = $(this).data('sort');
            // sortTableByColumn(column);
            // });

            // // Function to sort the table by the specified column
            // function sortTableByColumn(column) {
            // const tbody = $('#transactions-table tbody');
            // const rows = tbody.find('tr').toArray();

            // rows.sort((a, b) => {
            //     const valueA = $(a).find(`td:nth-child(${getColumnIndex(column)})`).text();
            //     const valueB = $(b).find(`td:nth-child(${getColumnIndex(column)})`).text();

            //     return compareValues(valueA, valueB);
            // });

            // // Clear the table body and append the sorted rows
            // tbody.empty().append(rows);
            // }

            // // Function to get the index of the specified column
            // function getColumnIndex(column) {
            // const headers = $('#transactions-table th[data-sort]').toArray();
            // return headers.findIndex(th => $(th).data('sort') === column) + 1;
            // }

            // // Function to compare the values for sorting
            // function compareValues(valueA, valueB) {
            // // Assuming the date format is "DD/MM/YYYY HH:mm AM/PM"
            // const dateA = new Date(valueA.replace(/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2}) (AM|PM)/, "$2/$1/$3 $4:$5 $6"));
            // const dateB = new Date(valueB.replace(/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2}) (AM|PM)/, "$2/$1/$3 $4:$5 $6"));

            // return dateA - dateB;
            // }
        });
    </script>
</body>
</html>