<?php
 $query = "SELECT * FROM users
 INNER JOIN reg_transaction ON  users.id = reg_transaction.user_id
 INNER JOIN office ON reg_transaction.office_id = office.id
 INNER JOIN reg_services ON reg_transaction.services_id = reg_services.services_id
 INNER JOIN reg_status ON reg_transaction.status_id = reg_status.id";
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
    <div class="d-flex p-2">
        <div class="input-group mb-3">
        <select class="form-select">
            <option name="all">All</option>
            <option name="code">Request Code</option>
            <option name="request">Request</option>
            <option name="schedule">Schedule</option>
            <option name="status">Status</option>
        </select>
        <input type="text" name="search" id="search" class="form-control w-50" placeholder="Search Here..." value="">
        <!-- <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button> -->
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
        $query_run = mysqli_query($connect, $query);
        if(mysqli_num_rows($query_run) > 0){
              foreach($query_run as $row) {
                ?>
                <tr>
                  <td><input class="userinfo" type="checkbox" data-id="<?=$row['reg_id'];?>" onclick="uncheckCheckbox(this)"></input></td>
                  <td><?=$row['request_code'];?></td>
                  <td><?=$row['offices'];?></td>
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
                <td colspan="5">No record found!</td>
              </tr>
            <?php
          }
          ?>     
    </tbody>
</table>
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