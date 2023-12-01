<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satisfaction Survey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Select an Office";
            include "navbar.php";
            include "../breadcrumb.php";
        ?>
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Satisfaction Survey', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>PUPSRC-OTMS Satisfaction Survey</h1>
        </div>
        <div class="container-fluid">
            <div class="row g-1">
                <div class="card col-md-3 p-0 m-1">
                    <div class="card-header">
                        <h6>PUP Data Privacy Notice</h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p><small>PUP respects and values your rights as a data subject under the Data Privacy Act (DPA). PUP is committed to protecting the personal data you provide in accordance with the requirements under the DPA and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the confidentiality, integrity and availability of your personal data. For more detailed Privacy Statement, you may visit <a href="https://www.pup.edu.ph/privacy/" target="_blank">https://www.pup.edu.ph/privacy/</a></small></p>
                        <div class="d-flex flex-column">
                            <button class="btn btn-outline-primary mb-2">
                                <i class="fa-solid fa-arrows-rotate"></i> Reset Form
                            </button>
                            <button class="btn btn-outline-primary mb-2">
                                <i class="fa-solid fa-circle-question"></i> Help
                            </button>
                        </div>
                    </div>
                </div>
            
        <div class="card col-md p-0 m-1">
            <div class="card-header">
                <div class="row">
                </div></div>

                <div class="card-body">
                <div class="row">
                <div class="col-sm-12">
                    <h5>Based on the service provided, how would you rate your experience?</h5>
                </div>
            </div>

            <div class="form-check">
            
        <!-- The form action is changed from survey.php to conn.php, it is to send the entered data on the database. -->
            <form action="conn.php" method="post">
    <input class="form-check-input" type="radio" name="rating" id="radio1" value="Excellent" checked>
    <label class="form-check-label" for="radio1">
      Excellent
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="rating" id="radio2" value="Good">
    <label class="form-check-label" for="radio2">
      Good
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="rating" id="radio3" value="Average">
    <label class="form-check-label" for="radio3">
      Average
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="rating" id="radio4" value="Poor">
    <label class="form-check-label" for="radio4">
      Poor
    </label>
  </div>
        <div class="col-sm-12">
                    <br/><h5>Do you have suggestions or complaints?</h5>
                </div>
        <div class="form-group">

    <textarea class="form-control" id="exampleTextarea" name="suggestions"  rows="3"></textarea>
  </div><br/>
  <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="push"></div>
    </div>
     </form>
    <footer class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
        <div>
            <small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
        </div>
        <div>
            <small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
            <small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy Statement</a></small>
        </div>
    </footer>
    <script src="../loading.js"></script>
    <script src="../saved_settings.js"></script>
</body>
</html>