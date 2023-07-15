<?php 
include '../../conn.php';
$query = "SELECT * FROM reg_faq";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Office - FAQs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../../../assets/favicon.ico">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../style.css">
    <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <?php
            $office_name = "Registrar Office";
            include "../navbar.php";
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
                    <p class="mb-0">Kindly download the <a href="reg_request_letter.pdf" download>Request Letter file</a>, which is necessary for requesting the desired document.</p>
                    <p class="mb-0">Authorization letter and ID if claimant is immediate family member.</p>
                    <p class="mb-0">Special Power of Attorney (SPA) if the claimant is other than the immediate family.</p>     
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                        <input type="text" name="search" id="search" class="form-control w-100" placeholder="Search for FAQs..." value="">
                </div>
            </div>

            <div class="container-fluid p-4">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Document</th>
                            <th class="text-center" scope="col">Requirements</th>
                            <th class="text-center" scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="transactions_table">
                    <?php 
                        $query_run = mysqli_query($connection, $query);
                        if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $row) {
                                ?>
                                <tr>
                                <td class="text-center w-25" scope="col"><?=$row['document'];?></td>
                                <td scope="col"><?=$row['requirements'];?></td>
                                <td scope="col"><?=$row['payment'];?></td>
                                </tr>
                                <?php
                                } 
                        }?>     
                    </tbody>
                </table>
            </div>
            
        </div>
        <div class="push"></div>
    </div>
    <?php include '../../footer.php'; ?>
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
            });
        });

        $(document).ready(function(){  
           $('#search').keyup(function(){  
                search_table($(this).val());  
           });  
           function search_table(value){  
                $('#transactions_table tr').each(function(){  
                     var found = 'false';  
                     $(this).each(function(){  
                          if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
                          {  
                               found = 'true';  
                          }  
                     });  
                     if(found == 'true')  
                     {  
                          $(this).show();  
                     }  
                     else  
                     {  
                          $(this).hide();  
                     }  
                });  
           }  
      }); 
    </script>
    <script src="../../saved_settings.js"></script>
</body>
</html>