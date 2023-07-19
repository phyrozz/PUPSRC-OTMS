<form action="trans_tables/delete.php"method="POST" enctype="multipart/form-data">
<!-- Search -->
<div class="d-flex w-100 justify-content-end p-0">
    <div class="d-flex justify-content-end gap-2">
        <div class="input-group mb-3 d-flex">
            <button class="btn " type="button" disabled><i class="fas fa-search"></i></button>
            <input type="text" name="search" id="search" class="form-control" placeholder="Search Here..." value="">
        </div>
    </div>
</div>

<table id="transactions-table" class="table table-hover">
    <thead>
        <tr class="table-active">
            <th></th>
            <th class="text-center" scope="col">Request Code</th>
            <th class="text-center" scope="col">Office</th>
            <th class="text-center w-50" scope="col">Request</th>
            <th class="text-center" scope="col"></i>Schedule </th>
            <th class="text-center" scope="col"></i>Amount to pay </th>
            <th class="text-center" scope="col">Status</th>
        </tr>
    </thead>
    <tbody id="transactions_table">
          <?php 
          
          $id = $_SESSION['user_id'];
          $query = "SELECT * FROM doc_requests
          INNER JOIN offices ON doc_requests.office_id = offices.office_id
          INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
          WHERE user_id = $id AND doc_requests.office_id = '3'";
          $query_run = mysqli_query($connection, $query);

          if(mysqli_num_rows($query_run) > 0){
              foreach($query_run as $row){
                if ($row['status_id'] == "1" || $row['status_id'] == "6"){
                ?>
                <tr>
                  <td class="text-center"><input type="checkbox" name="stud_delete_id[]" value="<?= $row ['request_id'];?>"></td>
                  <td class="text-center"><?=$row['request_id'];?></td>
                  <td class="text-center"><?=$row['office_name'];?></td>
                  <td class="text-center"><?=$row['request_description'];?></td>
                  <td class="text-center"><?= date('F d, Y', strtotime($row['scheduled_datetime'])); ?></td>
                  <td class="text-center">₱<?=$row['amount_to_pay'];?></td>
                  <?php if ($row['status_id'] == "1") { ?>
                    <td class="text-center"><span class="badge rounded-pill bg-dark"><?=$row['status_name'];?></td>
                  <?php } else {?>
                    <td class="text-center"><span class="badge rounded-pill bg-danger"><?=$row['status_name'];?></td>
                  <?php } ?>
                </tr>
                <?php
              }
            } ?>
            <td colspan="6"><input type="checkbox" name="del_all" onchange="checkAll(this)"> Select all</input></td>
          <?php }
          else {
            ?>
              <tr>
                <td class="text-center table-light p-4" colspan="7">No record found!</td>
              </tr>
              <td colspan="6"><input type="checkbox" name="del_all" onchange="checkAll(this)" disabled> Select all</input></td>
            <?php
          }
          ?>
         
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