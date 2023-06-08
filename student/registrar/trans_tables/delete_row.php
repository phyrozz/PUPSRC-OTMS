<form action="trans_tables/delete.php"method="POST" enctype="multipart/form-data">
<!-- Search -->
<div class="d-flex w-100 justify-content-end p-0">
    <div class="d-flex p-2">
        <div class="input-group mb-3">
        <select class="form-select">
            <option value="">All</option>
            <option value="">Request Code</option>
            <option value="">Request</option>
            <option value="">Schedule</option>
            <option value="">Status</option>
        </select>
        <input type="text" name="search" id="search" class="form-control w-50" placeholder="Search Here..." value="">
        <!-- <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button> -->
        </div>
        </div>
    </div>
</div>

<table id="transactions-table" class="table table-hover table-bordered">
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
          $query = "SELECT * FROM users
          INNER JOIN reg_transaction ON  users.id = reg_transaction.user_id
          INNER JOIN office ON reg_transaction.office_id = office.id
          INNER JOIN reg_services ON reg_transaction.services_id = reg_services.services_id
          INNER JOIN reg_status ON reg_transaction.status_id = reg_status.id";
          $query_run = mysqli_query($connect, $query);

          if(mysqli_num_rows($query_run) > 0){
              foreach($query_run as $row){
                if ($row['status_id'] == "1"){
                ?>
                <tr>
                  <td><input type="checkbox" name="stud_delete_id[]" value="<?= $row ['reg_id'];?>"></td>
                  <td><?=$row['request_code'];?></td>
                  <td><?=$row['offices'];?></td>
                  <td><?=$row['services'];?></td>
                  <td><?=$row['schedule'];?></td>
                  <td class="text-center"><span class="badge rounded-pill bg-dark"><?=$row['status'];?></td>
                </tr>
                <?php
              }
            }
          }else {
            ?>
              <tr>
                <td colspan="5">No record found!</td>
              </tr>
            <?php
          }
          ?>
          <td colspan="6"><input type="checkbox" name="del_all" onchange="checkAll(this)"> Select all</input></td>
    </tbody>
</table>

<div class="container">
  <div class="row">
    <div class="col text-center">
        <button type="submit" name="stud_delete_multiple_btn" id="del_btn" class="btn btn-primary" disabled>Delete</button>
    </div>
  </div>
</div>
</form>

<script>
  function checkAll(source) {
    var checkboxes = document.getElementsByName('stud_delete_id[]');
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
      }
  }

  $(document).ready(function() {
      $('input[type="checkbox"]').change(function() {
        if ($('input[type="checkbox"]:checked').length > 0) {
          $('#del_btn').prop('disabled', false);
        } else {
          $('#del_btn').prop('disabled', true);
        }
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