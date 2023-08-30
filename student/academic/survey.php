<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Office - Subject Overload</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">

    <!-- Loading page -->
    <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
    <div id="loader" class="center">
        <div class="loading-spinner"></div>
        <p class="loading-text display-3 pt-3">Getting things ready...</p>
    </div>
     
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="academic.css">
</head>
<body>
<div class="wrapper">
    <?php

        use FontLib\Table\Type\head;

        $office_name = "Academic Office";

        include('../navbar.php');
        include '../../conn.php';
        include '../../breadcrumb.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $query = "SELECT last_name, first_name, extension_name, email FROM users
            WHERE user_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if(isset($_POST['surveySubmit'])) {
            $query = "INSERT INTO acad_survey (user_id, rating, suggestions)
            VALUES (?, ?, ?)";

            $stmt = $connection->prepare($query);
            $stmt->bind_param("iss", $_SESSION['user_id'], $_POST["rating"], $_POST["suggestions"]);
            if ($stmt->execute()) {
                // Success! Redirect to "../ytransactions.php"
            // header("Location: ../transactions.php");
            echo '<script>window.location.href="../transactions.php";</script>';
            exit; // Make sure to exit after the redirect
        } else {
                var_dump($stmt->error);
            }
            $stmt->close();
            $connection->close();
        }
    ?>

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
                            <button class="btn btn-outline-primary mb-2" onclick="location.reload(0)">
                                <i class="fa-solid fa-arrows-rotate"></i> Reset Form
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card col-md p-0 m-1">
                    <div class="card-header">
                        <div class="row"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>Based on the service provided, how would you rate your experience?</h5>
                            </div>
                        </div>
                        <form action="survey.php" method="post">
                            <div class="form-check">
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
                                <br/>
                                <h5>Do you have suggestions or complaints?</h5>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="exampleTextarea" name="suggestions" rows="3"></textarea>
                            </div>
                            <br/>
                            <button type="submit" class="btn btn-primary" name="surveySubmit">Submit</button>
                        </form>
                    </div>
                    <div class="push"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../footer.php'; ?>
    <script src="../../loading.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="../../saved_settings.js"></script>
</body>
</html>