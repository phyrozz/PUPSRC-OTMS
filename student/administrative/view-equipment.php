<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrative - View Equipment</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../style.css">
  <!-- Loading page -->
  <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
  <div id="loader" class="center">
    <div class="loading-spinner"></div>
    <p class="loading-text display-3 pt-3">Getting things ready...</p>
  </div>
  <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js" crossorigin="anonymous"></script>
  <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


  <div class="wrapper">
    <?php
    $office_name = "Administrative Office";
    include "../navbar.php";
    include "../../breadcrumb.php";
    include "../../conn.php";
?>

    <div class="container-fluid p-4">
      <?php
            $breadcrumbItems = [
                ['text' => 'Administrative Office', 'url' => '../administrative.php', 'active' => false],
                ['text' => 'View Equipment', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
    ?>

      <div class="container-fluid text-center mt-4 p-4">
        <h1>View Equipment</h1>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-info" role="alert">
              <h4 class="alert-heading">
                <i class="fa-solid fa-circle-info"></i> Reminder
              </h4>
              <p class="mb-0">To set or edit a request, click on the "Create Request" button on the table.</p>
            </div>
            <div class="d-flex w-100 justify-content-between p-0">
              <div class="d-flex p-2">
                <!-- Filter form -->
                <div class="input-group mb-3 filter-button  ">
                  <label class="input-group-text " for="category">Filter by Category:</label>
                  <select class="form-select" name="category" id="category">
                    <option value="">All</option>
                    <option value="School"
                      <?php if(isset($_POST['category']) && $_POST['category'] == 'School') echo 'selected'; ?>>School
                      Equipment</option>
                    <option value="Sports"
                      <?php if(isset($_POST['category']) && $_POST['category'] == 'Sports') echo 'selected'; ?>>Sports
                      Equipment</option>
                    <option value="Cleaning"
                      <?php if(isset($_POST['category']) && $_POST['category'] == 'Cleaning') echo 'selected'; ?>>
                      Cleaning Equipment</option>
                  </select>
                  <button class="btn btn-primary" onclick="filterResults()">Filter</button>
                </div>
              </div>
            </div>

            <!-- Container for displaying filtered results -->
            <div id="filtered-results"></div>

            <script>
            // Pre-select the category on page load
            var selectedCategory = sessionStorage.getItem('selectedCategory');
            if (selectedCategory) {
              $('#category').val(selectedCategory);
            }

            // Function to handle the AJAX request and display filtered results
            function filterResults() {
              var category = $("#category").val();

              // Store the selected category in session storage
              sessionStorage.setItem('selectedCategory', category);

              $.ajax({
                type: "POST",
                url: "filter.php",
                data: {
                  category: category
                },
                success: function(response) {
                  $("#filtered-results").html(response);
                },
                error: function() {
                  $("#filtered-results").html("An error occurred while filtering the results.");
                }
              });
            }
            // Load initial table without filtering
            filterResults();

            function redirectToRequest(id, equipment_table, equipment_name, quantity) {
              var url = "request-equip.php?id=" + id + "&equipment_table=" + equipment_table + "&equipment_name=" +
                encodeURIComponent(equipment_name) + "&quantity=" + quantity;
              window.location.href = url;
            }
            </script>




            <style>
            .bigger-font {
              font-size: 20px;
            }

            .custom-font-size {
              font-size: 12px;
            }

            .filter-button {
              /* Adjust the value to create space below the navbar */
              z-index: 1
            }
            </style>

          </div>
        </div>
      </div>
      <div class="d-flex w-100 justify-content-between p-2">
        <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
          <i class="fa-solid fa-arrow-left"></i> Back
        </button>
      </div>
    </div>
    <div class="push"></div>
  </div>
  <?php include '../../footer.php'; ?>
  <script src="../../loading.js"></script>
  <script src="../../saved_settings.js"></script>
</body>

</html>