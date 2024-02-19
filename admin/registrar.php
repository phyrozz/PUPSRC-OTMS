<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Registrar Office</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
  <!-- Loading page -->
  <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
  <div id="loader" class="center">
    <div class="loading-spinner"></div>
    <p class="loading-text display-3 pt-3">Getting things ready...</p>
  </div>
  <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</head>

<body>
  <div class="wrapper">
    <?php
            include "../conn.php";
            include "navbar.php";

            // Avoid admin user from accessing other office pages
            if ($_SESSION['office_name'] != "Registrar Office") {
                header("Location: /admin/redirect.php");
            }

            $table = 'document_request';

            if (isset($_POST['filter-button'])) {
              $table = $_POST['table-select'];
            }

            $query = "SELECT services, services_id FROM reg_services";
            $stmt = $connection->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        ?>
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-xs-12">
          <div class="d-md-flex w-100 pb-2 justify-content-between align-items-end">
            <div class="d-flex flex-column gap-1">
              <div>
                <form id="defaultTableValueSelect" class="d-flex input-group" action="registrar.php" method="post">
                  <label class="input-group-text" for="table-select">Service:</label>
                  <select id="transactionTableSelect" class="form-select" name="table-select">
                    <option value="document_request" <?php if ($table === 'document_request') echo 'selected'; ?>>
                      Document Requests</option>
                    <option value="student_records" <?php if ($table === 'student_records') echo 'selected'; ?>>Student
                      Records</option>
                    <option value="feedback" <?php if ($table === 'feedback') echo 'selected'; ?>>Feedback Table</option>
                  </select>
                  <button id="tableSelectSubmit" type="submit" name="filter-button" class="btn btn-primary">Load
                    Table</button>
                </form>
              </div>
              <div>
                <div id="filterByStatusSection" class="input-group">
                  <label class="input-group-text" for="filterByStatus">Filter by Status:</label>
                  <select name="filterByStatus" id="filterByStatus" class="form-select">
                     <!-- Select options are dynamically displayed depending on the table -->
                  </select>
                </div>
              </div>
              <div>
                <div id="filterByDocTypeSection" class="input-group">
                  <label class="input-group-text" for="filterByDocType">Filter by Document Type:</label>
                  <select multiple name="filterByDocType[]" id="filterByDocType" class="form-select">
                    <option value="all">All</option>
                    <?php foreach ($data as $row) {
                      if ($row['services_id'] < '23' || $row['services_id'] == '35') {
                        echo '<option value="' . $row['services'] . '">' . $row['services'] . '</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
                <button type="submit" id="filterButton" onclick="showSelectedValues()" name="filterButton" class="btn btn-primary mt-2"><i
                    class="fa-solid fa-filter"></i> Filter</button>
                <?php if ($table === 'document_request') { ?>
                  <a href="tables/registrar/generate_registrar_reports.php" id="generate-report-pdf-link" name="generate-report-btn" class="btn btn-primary mt-2" target="_blank"><i class="fas fa-file-pdf"></i>PDF</a>
                  <a href="tables/registrar/generate_registrar_reports_excel.php" id="generate-report-excel-link" name="generate-report-btn" class="btn btn-primary mt-2" target="_blank"><i class="fas fa-file-excel"></i>Excel</a>
                  <a href="tables/registrar/generate_registrar_reports_docx.php" id="generate-report-docx-link" name="generate-report-btn" class="btn btn-primary mt-2" target="_blank"><i class="fas fa-solid fa-file-word"></i>Word</a>
                <?php } ?>
                </div>
            </div>
            <div class="mt-2">
              <div class="input-group search-group">
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
                  include 'tables/registrar/doc_requests.php';
                }
                elseif ($table === 'student_records') {
                  include 'tables/registrar/student_records.php';
                }
                elseif ($table === 'feedback') {
                  include 'tables/registrar/feedbacks_table.php';
                }
            ?>
          </div>
        </div>
      </div>
     
    </div>
    <div class="push"></div>
  </div>
  <?php include '../footer.php'; ?>
  <script>
  $(document).ready(function() {
    $('.dropdown-submenu a.dropdown-toggle').on("click", function(e) {
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
  </script>
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

  $(document).ready(function() {
    $("#generate-report-pdf-link").on('click', function() {
      var selectedStatus = $("#filterByStatus").val();
      var searchValue = $("#search-input").val();
      var selectedRequestDescriptions = $('#filterByDocType').val() || [];

      var encodedStatus = encodeURIComponent(selectedStatus);
      var encodedSearchValue = encodeURIComponent(searchValue);
      var encodedRequestDescriptions = encodeURIComponent(JSON.stringify(selectedRequestDescriptions));

      var link = "tables/registrar/generate_registrar_reports.php?status=" + encodedStatus + "&search=" + encodedSearchValue + "&req_desc=" + encodedRequestDescriptions;

      $(this).attr("href", link);
    });

    $("#generate-report-excel-link").on('click', function() {
      var selectedStatus = $("#filterByStatus").val();
      var searchValue = $("#search-input").val();
      var selectedRequestDescriptions = $('#filterByDocType').val() || [];

      var encodedStatus = encodeURIComponent(selectedStatus);
      var encodedSearchValue = encodeURIComponent(searchValue);
      var encodedRequestDescriptions = encodeURIComponent(JSON.stringify(selectedRequestDescriptions));

      var link = "tables/registrar/generate_registrar_reports_excel.php?status=" + encodedStatus + "&search=" + encodedSearchValue + "&req_desc=" + encodedRequestDescriptions;

      $(this).attr("href", link);
    });

    $("#generate-report-docx-link").on('click', function() {
      var selectedStatus = $("#filterByStatus").val();
      var searchValue = $("#search-input").val();
      var selectedRequestDescriptions = $('#filterByDocType').val() || [];

      var encodedStatus = encodeURIComponent(selectedStatus);
      var encodedSearchValue = encodeURIComponent(searchValue);
      var encodedRequestDescriptions = encodeURIComponent(JSON.stringify(selectedRequestDescriptions));

      var link = "tables/registrar/generate_registrar_reports_docx.php?status=" + encodedStatus + "&search=" + encodedSearchValue + "&req_desc=" + encodedRequestDescriptions;

      $(this).attr("href", link);
    });
  });

    // Function to show or hide the "Filter by Document Type" section
    function toggleFilterByDocTypeSection() {
      var selectedTable = $("#transactionTableSelect").val();

      if (selectedTable === "document_request") {
        $("#filterByDocTypeSection").show();
        $("#filterByStatusSection").show();
        $("#filterButton").show();
        $(".search-group").show();
      } else {
        $("#filterByStatusSection").hide();
        $("#filterByDocTypeSection").hide();
        $("#filterButton").hide();
        $(".search-group").hide();
      }
    }

    // Call the toggle function initially
    toggleFilterByDocTypeSection();

    // Event listener for the table select dropdown change
    $("#tableSelectSubmit").on('click', function() {
      toggleFilterByDocTypeSection();
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

  // Get the select element on "Filter by Status" dropdown
  var filterByStatusSelect = document.getElementById('filterByStatus');

  // Define the statuses array
  var statuses = <?php echo json_encode($statuses); ?>;

  // Generate the options
  var allOption = document.createElement('option');
  allOption.value = 'all';
  allOption.textContent = 'All';
  filterByStatusSelect.appendChild(allOption);

  for (var key in statuses) {
    if (statuses.hasOwnProperty(key) && key !== 'all') {
      var option = document.createElement('option');
      option.value = key;
      option.textContent = statuses[key];
      filterByStatusSelect.appendChild(option);
    }
  }

  var selectElement = document.getElementById("filterByDocType");
  var options = selectElement.options;
  // for minimizing dropdown width
  for (var i = 0; i < options.length; i++) {
    var option = options[i];
    var optionText = option.text;

    if (optionText.length > 60) {
      option.text = optionText.substring(0, 100) + '...';
    }
  }
  </script>
  <script src="../loading.js"></script>
</body>

</html>