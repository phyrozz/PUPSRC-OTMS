<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUPSRC-OTMS - Student Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bg.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="jumbotron container-lg bg-white d-flex">
        <div class="container-lg container-fluid">
            <div class="row">
                <div class="col-md-12 text-center d-flex flex-column align-items-center justify-content-center">
                    <img src="/assets/pup-logo.png" alt="PUP Logo" width="100">
                    <h1 class="display-4">PUP-SRC</h1>
                    <h2>Online Transaction Management System</h2>
                    <p class="lead">Sign in as PUP client (Alumni, Visitor, etc.)</p>

                    <form class="d-flex flex-column gap-2" action="student.php">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" id="email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group col-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-12">
                            Don't have an account yet? <a href="#" data-bs-toggle="modal" data-bs-target="#Register">Sign up</a>
                        </div>
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">
                            <i class="fa-solid fa-circle-info"></i> Reminder
                            </h4>
                            <p class="mb-0">By using this service, you understood and agree to the PUPSRC-OTMS <a href="https://www.pup.edu.ph/terms" target="_blank">Terms of Use</a> and <a href="https://www.pup.edu.ph/privacy" target="_blank">Privacy Statement</a></p>
                        </div>
                        <div class="mb-3 d-flex w-100 justify-content-between p-1">
                            <button class="btn btn-outline-primary px-4" onclick="window.history.go(-1); return false;">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </button>
                            <input id="submitBtn" value="Login" type="submit" class="btn btn-primary w-25" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up Modal -->
    <div class="modal fade" id="Register" tabindex="-1" aria-labelledby="registerLabel" aria-hidden="true"> 
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title">Create New Account</p> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                    <input type="hidden" class="form-control font-weigth-light" id="hfDepartment" name="hfDepartment">
                    <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Personal Details</label>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">  
                        <div class="row">
                            <div class="form-group col-6">
                            <label class="mb-0 pb-1">Last Name <code>*</code></label>
                                <div class="input-group mb-0 mt-0">
                                <input type="text" name="LName" value="" id="LName" placeholder="Last Name" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-6">
                            <label class="mb-0 pb-1">First Name <code>*</code></label>
                                <div class="input-group mb-0 mt-0">
                                <input type="text" name="FName" value="" id="FName" placeholder="First Name" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-6">
                            <label class="mb-0 pb-1">Middle Name</label>
                                <div class="input-group mb-0">
                                <input type="text" name="MName" value="" id="MName" placeholder="Middle Name" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-6">
                            <label class="mb-0 pb-1">Extension Name <font class="small">(Jr./Sr./III Etc..)</font></label>
                                <div class="input-group mb-0">
                                <input type="text" name="EName" value="" id="EName" placeholder="Middle Name" pattern="[a-zA-Z0-9Ññ\_\-\'\ \.]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>                             
                            </div>
                            <div class="row">
                            <div class="form-group col-12">
                                <label>Contact Number <code>*</code></label>
                                <div class="input-group mb-0">
                                    <input type="text" name="ContactNumber" value="" id="ContactNumber" placeholder="Contact No." pattern="[0-9\+\ ]*" maxlength="20" size="20" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Birthdate <code>*</code></label>
                                <div data-target="#Birthday" data-toggle="datetimepicker">
                                    <input type="text" name="Birthday" id="Birthday" class="form-control datetimepicker-input" data-target="#Birthday">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Sex  <code>*</code></label><br>
                                <div class="form-check">
                                <label class="form-check-label col-3">
                                    <input class="form-check-input" type="radio" id="GenderM" name="Gender" value="Male" checked=""> Male
                                </label>
                                <label class="form-check-label col-3">
                                    <input class="form-check-input" type="radio" id="GenderF" name="Gender" value="Female"> Female
                                </label>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Home Address <code>*</code></label>
                                <div class="input-group mb-0">
                                    <input type="text" name="Address" value="" id="Address" placeholder="Address" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Province <code>*</code></label>
                                <select class="form-control" id="Province" name="Province" style="width: 100%;" onchange="ShowCity(this.value)">
                                    <option></option>
                                    <option value="Abra">Abra</option><option value="Agusan del Norte">Agusan del Norte</option><option value="Agusan del Sur">Agusan del Sur</option><option value="Aklan">Aklan</option><option value="Albay">Albay</option><option value="Antique">Antique</option><option value="Apayao">Apayao</option><option value="Aurora">Aurora</option><option value="Basilan">Basilan</option><option value="Bataan">Bataan</option><option value="Batanes">Batanes</option><option value="Batangas">Batangas</option><option value="Benguet">Benguet</option><option value="Biliran">Biliran</option><option value="Bohol">Bohol</option><option value="Bukidnon">Bukidnon</option><option value="Bulacan">Bulacan</option><option value="Cagayan">Cagayan</option><option value="Camarines Norte">Camarines Norte</option><option value="Camarines Sur">Camarines Sur</option><option value="Camiguin">Camiguin</option><option value="Capiz">Capiz</option><option value="Catanduanes">Catanduanes</option><option value="Cavite">Cavite</option><option value="Cebu">Cebu</option><option value="Compostela Valley">Compostela Valley</option><option value="Cotabato">Cotabato</option><option value="Davao del Norte">Davao del Norte</option><option value="Davao del Sur">Davao del Sur</option><option value="Davao Oriental">Davao Oriental</option><option value="Eastern Samar">Eastern Samar</option><option value="Guimaras">Guimaras</option><option value="Ifugao">Ifugao</option><option value="Ilocos Norte">Ilocos Norte</option><option value="Ilocos Sur">Ilocos Sur</option><option value="Iloilo">Iloilo</option><option value="Isabela">Isabela</option><option value="Kalinga">Kalinga</option><option value="Laguna">Laguna</option><option value="Lanao del Norte">Lanao del Norte</option><option value="Lanao del Sur">Lanao del Sur</option><option value="La Union">La Union</option><option value="Leyte">Leyte</option><option value="Maguindanao">Maguindanao</option><option value="Marinduque">Marinduque</option><option value="Masbate">Masbate</option><option value="Metropolitan Manila">Metropolitan Manila</option><option value="Misamis Occidental">Misamis Occidental</option><option value="Misamis Oriental">Misamis Oriental</option><option value="Mountain">Mountain</option><option value="Negros Occidental">Negros Occidental</option><option value="Negros Oriental">Negros Oriental</option><option value="Northern Samar">Northern Samar</option><option value="Nueva Ecija">Nueva Ecija</option><option value="Nueva Vizcaya">Nueva Vizcaya</option><option value="Occidental Mindoro">Occidental Mindoro</option><option value="Oriental Mindoro">Oriental Mindoro</option><option value="Palawan">Palawan</option><option value="Pampanga">Pampanga</option><option value="Pangasinan">Pangasinan</option><option value="Quezon">Quezon</option><option value="Quirino">Quirino</option><option value="Rizal">Rizal</option><option value="Romblon">Romblon</option><option value="Samar">Samar</option><option value="Sarangani">Sarangani</option><option value="Siquijor">Siquijor</option><option value="Sorsogon">Sorsogon</option><option value="South Cotabato">South Cotabato</option><option value="Southern Leyte">Southern Leyte</option><option value="Sultan Kudarat">Sultan Kudarat</option><option value="Sulu">Sulu</option><option value="Surigao del Norte">Surigao del Norte</option><option value="Surigao del Sur">Surigao del Sur</option><option value="Tarlac">Tarlac</option><option value="Tawi-Tawi">Tawi-Tawi</option><option value="Zambales">Zambales</option><option value="Zamboanga del Norte">Zamboanga del Norte</option><option value="Zamboanga del Sur">Zamboanga del Sur</option><option value="Zamboanga-Sibugay">Zamboanga-Sibugay</option><option value="Dinagat Islands">Dinagat Islands</option>                  </select>
                            </div>              
                            <div class="form-group col-6">
                                <label>City <code>*</code></label>
                                <select id="City" name="City" class="form-control" style="width: 100%;">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Barangay <code>*</code></label>
                                <div class="input-group mb-0">
                                    <input type="text" name="Barangay" value="" id="Barangay" placeholder="Barangay" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label>Zip Code</label>
                                <div class="input-group mb-0">
                                    <input type="text" name="ZipCode" value="" id="ZipCode" placeholder="Zip Code" pattern="[0-9]+" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <label>Account Details</label>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">  
                            <div class="row">
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">Email <code>*</code></label>
                                <div class="input-group mb-0">
                                <input type="text" name="Email" value="" id="Email" placeholder="Complete Email" pattern="[a-zA-Z0-9Ññ\@\_\-\.\(\)\&amp;\,\<\>\'\`]*" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">Password <code>*</code></label>
                                <div class="input-group mb-0">
                                <input type="password" name="Password" value="" id="Password" placeholder="Password" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">Confirm Password <code>*</code></label>
                                <div class="input-group mb-0">
                                <input type="password" name="ConfirmPassword" value="" id="ConfirmPassword" placeholder="Retype Password" maxlength="50" size="50" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="alert alert-info alert-dismissible text-xs" style="height: 90%">
                                    <h4>Data Privacy Notice</h4>
                                    <p>
                                    <img style="float: right; margin-left: 3px;" src="//i.imgur.com/1fWC7sz.png" title="QR code">Thank you for providing your data at Polytechnic University of the Philippines (PUP). We respect and value your rights as a data subject under the Data Privacy Act (DPA). PUP is committed to protecting the personal data you provide in accordance with the requirements under the DPA and its IRR. In this regard, PUP implements reasonable and appropriate security measures to maintain the confidentiality, integrity and availability of your personal data. For more detailed Privacy Statement, you may visit <a class="text-white" href="https://www.pup.edu.ph/privacy/" target="_blank">https://www.pup.edu.ph/privacy/</a></p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="submit" class="btn btn-primary">Submit</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>