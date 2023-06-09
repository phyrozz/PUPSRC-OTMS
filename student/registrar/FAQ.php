<?php 
$conn = new PDO("mysql:host=localhost;dbname=reg_db", "root", "");
 $sql = "SELECT * FROM reg_faq";
 $statement = $conn->prepare($sql);
 $statement->execute();
 $faqs = $statement->fetch();
//$query_run = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Office - FAQs</title>
    <link rel="icon" type="image/x-icon" href="../../../assets/favicon.ico">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="FAQ.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Registrar Office";
            include "../../navbar.php";
            include "../../breadcrumb.php";
        ?>
        <div class="container-fluid p-4">
            <?php
            $breadcrumbItems = [
                ['text' => 'Registrar Office', 'url' => '../registrar.php', 'active' => false],
                ['text' => 'Registrar Transactions History', 'url' => 'your_transaction.php', 'active' => false],
                ['text' => 'FAQs', 'active' => true],
            ];

            echo generateBreadcrumb($breadcrumbItems, true);
            ?>
        </div>
        <div class="container-fluid text-center p-4">
            <h1>Frequently Asked Questions (FAQs)</h1>
        </div>
        <div class="container-fluid">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">
                    <i class="fa-solid fa-circle-info"></i> Reminder
                    </h4>
                    <p class="mb-0"><strong>When claiming documents:</strong></p>
                    <p class="mb-0">Authorization letter and ID if claimant is immediate family member.</p>
                    <p class="mb-0">Special Power of Attorney (SPA) if the claimant is other than the immediate family.</p>     
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for FAQs...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div> 
            </div>
            <section class="main-content">
                    <div class="row flex-center">   
                    <div class="col-sm-10 offset-sm-1">\

                    <?php //foreach($faqs as $faq) :?>
                        <!-- for connect FAQ to DB (ongoing, trying, bahala naaa)
                        <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $faq['faq_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $faq['faq_id']; ?>">
                                <div class="circle-icon"> <i class="fa fa-question"></i> </div>
                            <span><?php //echo $faq['document']; ?></span></button>
                            </button>
                            </h2>
                            <div id="collapse<?php //echo $faq['faq_id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $faq['faq_id']; ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body"> 
                            <strong>Requirements</strong>
                            <?php //echo $faq['requirements']; ?>
                            <strong>Payment</strong>
                            <?php //echo $faq['payement']; ?>
                            </div>
                            </div>
                        </div> -->
                        <?php //endforeach;?>

                        <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="circle-icon"> <i class="fa fa-question"></i> </div>
                            <span>Application for Graduation SIS and Non-SIS</span>
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body"> 
                            <strong>Requirements</strong> 
                            <li>Accomplished and printed copy of the Application for Graduation thru SIS Account (2 copies)</li>
                            <li>Accomplished copy of the Application for Graduation for Non-SIS (2 copies)</li>
                            <li>Proof of payment</li>
                            <strong>Payment</strong> 
                            <li>IF NOT COVERED BY FREE TUITION ACT: </li>
                                <ul>
                                    <li>P600.00 - Grad. Fee</li>
                                    <li>P350.00 - Non Eng’g</li>
                                    <li>P450.00 - Eng’g.</li>
                                    <li>P200.00 - Diploma</li>
                                    <li>P150.00 - Cert. of Grad.</li>
                                    <li>P90.00 – documentary stamp tax</li>
                                    <li>Non Eng’g courses – 1,590.00</li>
                                    <li>Eng’g courses – 1,690.00</li>
                                </ul>
                            </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <div class="circle-icon"> <i class="fa fa-question"></i> </div>
                            <span>Correction of Entry of Grade, Completion of Incomplete Grade, and  Late Reporting of Grade</span> </button>
                            </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body"> 
                            <strong>Requirements</strong>
                                <li>Accomplished Completion Form 3 copies</li>
                                <li>Photocopy of Class Record of the Faculty</li>
                                <li>Notarized Affidavit for the Change of Grades signed by the Professor</li>
                                <li>Proof of payment</li>
                            <strong>Payment</strong>
                                <li>P30.00</li>
                            </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> 
                                <div class="circle-icon"> <i class="fa fa-question"></i> </div>
                            <span>Processing of Request for Correction of Name in Conformity with the Philippines Statistics Authority Certificate of Live Birth </span> 
                            </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body"> 
                                <strong>Requirements</strong>
                                <li>Letter address to the Campus Registrar</li>
                                <li>Original Copy of PSA Birth Certificate </li>
                                <li>Parent Affidavit / Affidavit of Discrepancy</li>
                                <li>Joint Affidavit of Two Disinterested Person</li>
                                <li>Corrected copy of F137A/TOR (if applicable)</li>
                                <li>Original copy of Transcript of Records and Diploma (if previously issued) </li>
                                <li>General Clearance showing the client is cleared of all accountabilities</li>
                                <li>2 pcs. 2” x 2” picture in Formal Attire</li>
                                <li>Proof of payment</li>
                                <li>1 Long Brown Envelope</li>
                                <strong>Payment</strong>
                                <li>P150.00</li>
                            </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> 
                                <div class="circle-icon"> <i class="fa fa-question"></i> </div>
                            <span>Certification, Verification, Authentication (CAV/Apostile)</span> 
                            </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                            <div class="accordion-body"> 
                                <strong>Requirements</strong>
                                <li>Student’s Request Letter</li>
                                <li>General Clearance showing the client is cleared of all accountabilities</li>
                                <li>Letter request addressed to CHED Regional Director (for CAV-CHED request only)</li>
                                <li>2 pcs. 2” x 2” picture in Formal Attire</li>
                                <li>Proof of payment</li>
                                <li>1 Long Brown Envelope</li>
                                <strong>Payment</strong>
                                <li>P920.00 for DFA</li>
                                <li>150.00 for Special Certification</li>
                                <li>P620.00 for CHED</li>
                                <li>P470.00 for PRC</li>
                            </div>
                            </div>
                        </div>


                        </div>
                    </div>
                    </div>
                </div>
            </section>
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
</body>
</html>