<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction History</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/style.css">
  <!-- Loading page -->
  <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
  <div id="loader" class="center">
    <div class="loading-spinner"></div>
    <p class="loading-text display-3 pt-3">Getting things ready...</p>
  </div>
  <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../node_modules/flatpickr/dist/flatpickr.min.css">
</head>

<body>
  <div class="wrapper">
    <?php
            $office_name = "Select an Office";
            include "../conn.php";
            include "navbar.php";
            include "../breadcrumb.php";

            $table = 'document_request';
            $academictable = 'subject_overload';

            if (isset($_POST['filter-button'])) {
                $table = $_POST['table-select'];
            }
        ?>
    <div class="container-fluid p-4">
      <?php
            $breadcrumbItems = [
                ['text' => 'My Transactions', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
    </div>
    <div class="container-fluid text-center p-4">
      <h1>My Transactions</h1>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="d-flex w-100 justify-content-between p-0">
            <div class="d-flex p-2">
              <form id="defaultTableValueSelect" class="d-flex input-group" action="transactions.php" method="post">
                <select id="transactionTableSelect" class="form-select" name="table-select">
                  <option value="registrar_request" <?php if ($table === 'registrar_request') echo 'selected'; ?>>
                    Registrar Requests</option>
                  <option value="document_request" <?php if ($table === 'document_request') echo 'selected'; ?>>Guidance
                    Requests</option>
                  <option value="scheduled_appointments"
                    <?php if ($table === 'scheduled_appointments') echo 'selected'; ?>>Counseling Schedules</option>
                  <option value="offsettings" <?php if ($table === 'offsettings') echo 'selected'; ?>>Offsettings</option>
                  <option value="request_equipment" <?php if ($table === 'request_equipment') echo 'selected'; ?>>
                    Request of Equipment</option>
                  <option value="appointment_facility" <?php if ($table === 'appointment_facility') echo 'selected'; ?>>
                    Facility Appointment</option>
                  <option value="acad_transactions" <?php if ($table === 'acad_transactions') echo 'selected'; ?>>
                    Academic Transactions</option>
                </select>
                <button type="submit" name="filter-button" class="btn btn-primary"><i class="fas fa-refresh"></i> Load
                  Table</button>
              </form>
            </div>
            <div class="d-flex justify-content-end p-2">
              <div class="input-group d-flex justify-content-end">
                <input type="text" class="form-control" placeholder="Search..." id="search-input">
                <button class="btn btn-outline-primary" type="button" id="search-button"><i
                    class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
          <div id="loading-indicator" class="text-center">
            Loading...
          </div>
          <div id="table-container">
            <?php
                            // Load the requested table
                            if ($table === 'document_request') {
                                include 'transaction_tables/document_request_table.php';
                            } elseif ($table === 'scheduled_appointments') {
                                include 'transaction_tables/scheduled_appointments_table.php';
                            } elseif ($table === 'offsettings') {
                                include 'transaction_tables/offsetting_table.php';
                            } elseif ($table === 'request_equipment') {
                                include 'transaction_tables/request_equipment_table.php';
                            } elseif ($table === 'appointment_facility') {
                                include 'transaction_tables/appointment_facility_table.php';
                            } elseif ($table === 'acad_transactions') {
                                include 'transaction_tables/academic_table.php';
                            } elseif ($table === 'registrar_request') {
                                include 'transaction_tables/registrar_request_table.php';
                            }
                        ?>
          </div>
        </div>
      </div>
    </div>
    <div class="push"></div>
  </div>
  <?php
        include "../footer.php";
        mysqli_close($connection);
    ?>
  <script src="../loading.js"></script>
  <script>
  $(document).ready(function() {
    $('.sortable-header').on('click', function() {
      var column = $(this).data('column');
      var order = $(this).data('order');

      // Toggle the sort order
      order = (order === 'asc') ? 'desc' : 'asc';

      // Reset the sort icons
      $('.sortable-header').data('order', 'asc').find('.sort-icon').removeClass('fa-sort-up fa-sort-down')
        .addClass('fa-sort');

      // Update the clicked header's sort order and icon
      $(this).data('order', order).find('.sort-icon').removeClass('fa-sort').addClass(order === 'asc' ?
        'fa-sort-up' : 'fa-sort-down');

      // Call the handlePagination function with the updated sort parameters
      handlePagination(1, '', column, order);
    });

    $('#search-button').on('click', function() {
      var searchTerm = $('#search-input').val();
      handlePagination(1, searchTerm);
    });

    // $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
    //     $(this).next('ul').toggle();
    //     e.stopPropagation();
    //     e.preventDefault();
    // });
  });

  function checkViewport() {
    if (window.innerWidth < 768) {
      document.getElementById('transactions-table').classList.add('text-nowrap', 'w-auto');
    } else {
      document.getElementById('transactions-table').classList.remove('text-nowrap', 'w-auto');
    }
  }

  // Check viewport initially and on window resize
  window.addEventListener('DOMContentLoaded', checkViewport);
  window.addEventListener('resize', checkViewport);
  </script>
  <script src="../saved_settings.js"></script>
</body>

</html>