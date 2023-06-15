<?php
    $id = $_SESSION['user_id'];
    $query = "SELECT * FROM users
    INNER JOIN reg_transaction ON users.user_id = reg_transaction.user_id
    INNER JOIN offices ON reg_transaction.office_id = offices.office_id
    INNER JOIN reg_services ON reg_transaction.services_id = reg_services.services_id
    INNER JOIN reg_status ON reg_transaction.status_id = reg_status.id
    WHERE users.user_id = $id";
?>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">See Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<form method="" action="">
<!-- Search -->
<div class="d-flex w-100 justify-content-end p-0">
    <div class="d-flex justify-content-end gap-2">
        <div class="input-group mb-3 d-flex">
            <button class="btn " type="button" disabled><i class="fas fa-search"></i></button>
            <input type="text" name="search" id="search" class="form-control" placeholder="Search Here..." value="">
        </div>
    </div>
</div>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th></th>
            <th class="text-center" scope="col">Request Code</th>
            <th class="text-center" scope="col">Office</th>
            <th class="text-center" scope="col">Request</th>
            <th class="text-center" scope="col"><i class="fa-solid fa-filter" onclick=""></i>Schedule </th>
            <th class="text-center" scope="col">Status</th>
        </tr>
    </thead>
    <tbody id="transactions_table">
    <?php 
        $query_run = mysqli_query($connection, $query);
        if(mysqli_num_rows($query_run) > 0){
              foreach($query_run as $row) {
                ?>
                <tr>
                  <td><input class="userinfo" type="checkbox" data-id="<?=$row['reg_id'];?>" onclick="uncheckCheckbox(this)"></input></td>
                  <td><?=$row['request_code'];?></td>
                  <td><?=$row['office_name'];?></td>
                  <td><?=$row['services'];?></td>
                  <td><?=$row['schedule'];?></td>
                  <?php if ($row['status_id'] == "1"){ ?>
                  <td class="text-center"><span class="badge rounded-pill bg-dark"><?=$row['status'];?></td>
                  <?php } else if ($row['status_id'] == "2") { ?>
                    <td class="text-center"><span class="badge rounded-pill" style="background-color: orange;"><?=$row['status'];?></td>
                    <?php } else if ($row['status_id'] == "3") { ?>
                        <td class="text-center"><span class="badge rounded-pill" style="background-color: blue;"><?=$row['status'];?></td>
                    <?php } else if ($row['status_id'] == "4") { ?>
                        <td class="text-center"><span class="badge rounded-pill" style="background-color: DodgerBlue;"><?=$row['status'];?></td>
                    <?php } else if ($row['status_id'] == "5") { ?>
                        <td class="text-center"><span class="badge rounded-pill" style="background-color: green;"><?=$row['status'];?></td>
                    <?php } ?>
                </tr>
                <?php
                } 
        }else {
            ?>
              <tr>
                <td class="text-center" colspan="6">No record found!</td>
              </tr>
            <?php
          }
          ?>     
    </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item"disabled>
      <a class="btn-primary page-link text-white" href="#" tabindex="-1">Previous</a>
    </li>
    <?php
    //for ($i=1;$i<=$total_pages;$i++) { ?>
    <li class="page-item"><a class="page-link btn-outline-primary " href="#"><?php //echo $i?>1</a></li>
    <li class="page-item"><a class="page-link btn-outline-primary " href="#"><?php //echo $i?>2</a></li>
    <!-- <li class="page-item"><a class="page-link btn-outline-primary" href="../your_transaction.php?page=<?php //echo $i?>"><?php //echo $i?>2</a></li> -->
    <?php //}?>
    <li class="page-item">
      <a class="btn-primary page-link text-white" href="#">Next</a>
    </li>
  </ul>
</nav>
</form>


<script type='text/javascript'>
    $(document).ready(function(){
        $('.userinfo').click(function(){
            var userid = $(this).data('id');
                $.ajax({
                        url: 'trans_tables/modal_view.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-body').html(response); 
                            $('#myModal').modal('show'); 
                        }
                });
        });
    });

    function uncheckCheckbox(checkbox) {
        if (checkbox.checked) {
            checkbox.checked = false;
        }
    }

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