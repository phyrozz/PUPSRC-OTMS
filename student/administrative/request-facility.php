<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Facility</title>
    <link rel="icon" href="../assets/icon/pup-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../stylesheets/request-style.css">
    
</head>

<body>

<?php
    $office_name = "Administrative Office";
    include "../../navbar.php"
?>
<div class="wrapper">
      <div class="container-fluid p-4">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../front-page/administrative.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="../front-page/administrative.php">Administrative Office</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Facility Appointment</li>
                </ol>
            </nav>
        </div>

    <div class="container-fluid text-center p-4">
        <h1>Facility Appointment</h1>
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
                    <h6>Appointment Information - Request</h6>
                </div>
                <div class="card-body">
                    <form class="row g-3">
                        <h6>Student Information</h6>
                        <div class="col-12">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="lastName" class="form-control" id="lastName" disabled>
                        </div>
                        <div class="col-12">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="firstName" class="form-control" id="firstName" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="middleName" class="form-label">Middle Name</label>
                            <input type="middleName" class="form-control" id="middleName" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="extensionName" class="form-label">Extension Name</label>
                            <input type="extensionName" class="form-control" id="extensionName" disabled>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <h6 class="mt-5">Appointment Information</h6>

                        <div class="col-md-6">
                            <label for="facilityName" class="form-label">Facility Name</label>
                            <input type="facilityName" class="form-control" id="facilityName" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="roomnum" class="form-label">Room Number</label>
                            <input type="roomnum" class="form-control" id="roomnum" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="date" class="form-label">Date Needed</label>
                            <input type="date" class="form-control" id="date">
                        </div>
                        <div class="col-md-6">
                            <label for="time" class="form-label">Timestamp</label>
                            <select class="form-control" id="time">
                                <option>8:00 AM</option>
                                <option>9:00 AM</option>
                                <option>10:00 AM</option>
                                <option>11:00 AM</option>
                                <option>12:00 PM</option>
                                <option>1:00 PM</option>
                                <option>2:00 PM</option>
                                <option>3:00 PM</option>
                                <option>4:00 PM</option>
                                <option>5:00 PM</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="purposeReq" class="form-label">Purpose of Appointment</label>
                            <textarea type="purposeReq" class="form-control form-control-lg " id="purposeReq" rows="4"></textarea>
                        </div>


                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">
                                <i class="fa-solid fa-circle-info"></i> Reminder
                            </h4>
                            <p>Your appointment request will be forwarded to the concerned office after you click the "Submit" button.</p>
                            <p>Confirmation (approved/disapproved) of the request will be sent to your registered email.</p>
                            <p>You may also constantly monitor the status of the request thru this System.</p>
                            <p>You are required to answer the Health Declaration Form a day before your scheduled appointment.</p>
                            <p class="mb-0">Please present your appointment letter on your scheduled appointment for approval</p>
                        </div>
                        <!-- <div class="d-flex justify-content-between p-1">
                            <div class="w-25">
                              <a href="/front-page/main-page.html" class="btn btn-primary">
                                <i class="fa-solid fa-arrow-left"></i> Back
                              </a>
                            </div>
                            <div class="w-50 d-flex justify-content-end">
                              <button type="save" class="btn btn-primary mr-1">Save Later</button>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div> -->
                        <div class="d-flex w-100 justify-content-between p-1">
                            <button  class="btn btn-primary w-25" onclick="window.history.go(-1); return false;">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </button>
                            <button type="save" class="btn btn-primary w-15">Save Later</button>
                            <button type="submit" class="btn btn-primary w-25">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
            });
        });
    </script>
</body>
</html>