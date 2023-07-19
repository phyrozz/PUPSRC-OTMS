<form method="POST" enctype="multipart/form-data">
<!-- Search -->
<div class="d-flex w-100 justify-content-end p-0">
    <div class="d-flex justify-content-end gap-2">
        <div class="input-group mb-3 d-flex">
            <button class="btn " type="button" disabled><i class="fas fa-search"></i></button>
            <input type="text" name="search" id="search" class="form-control" placeholder="Search Here..." value="">
        </div>
    </div>
</div>

<table id="datatableid" class="table table-hover">
    <thead>
        <tr class="table-active">
            <th></th>
            <th class="text-center sortable-header w-25" scope="col" data-order="desc">Request Code</th>
            <th class="text-center sortable-header w-25" scope="col" data-order="desc">Office</th>
            <th class="text-center sortable-header w-25" scope="col" data-order="desc">Request</th>
            <th class="text-center sortable-header w-25" scope="col" data-order="desc">Schedule</th>
            <th class="text-center sortable-header" scope="col" data-order="desc">Amount to pay</th>
            <th class="text-center sortable-header" scope="col" data-order="desc">Status</th>
        </tr>
    </thead>
    <tbody id="transactions_table">
          <?php 
          $id = $_SESSION['user_id'];
          $query_set = "SELECT * FROM doc_requests
          INNER JOIN offices ON doc_requests.office_id = offices.office_id
          INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
          WHERE user_id = $id AND doc_requests.office_id = '3'";
          $query_run = mysqli_query($connection, $query_set);
          if(mysqli_num_rows($query_run) > 0){
              foreach($query_run as $row){
                if ($row['status_id'] == "1"){
                ?>
                <tr id=<?=$row['request_id'];?>>
                    <td class="text-center"><button type="button" id="editbtn" class="btn editbtn" style="background-color:transparent"><i class="fas fa-edit"></i></button></td>
                    <td class="text-center"><?=$row['request_id'];?></td>
                    <td class="text-center"><?=$row['office_name'];?></td>
                    <td class="text-center"><?=$row['request_description'];?></td>
                    <td style="display: none"><?=date('Y-m-d', strtotime($row['scheduled_datetime']));?></td> <!--hidden-->
                    <td class="text-center"><?= date('F d, Y', strtotime($row['scheduled_datetime'])); ?></td>
                    <td class="text-center">₱<?=$row['amount_to_pay'];?></td>
                    <td class="text-center"><span class="badge rounded-pill bg-dark"><?=$row['status_name'];?></td>
                </tr>
                <?php
              }
            }
          }else {
            ?>
              <tr>
                <td class="text-center table-light p-4" colspan="7">No record found!</td>
              </tr>
            <?php
          }
          ?> 
    </tbody>
</table>
</form>

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Request </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="trans_tables/edit.php" method="POST" class="was-validated">

                    <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label> Code </label>
                            <input type="text" name="code" id="code" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label>Request </label>
                            <select name="request" id="request" class="form-control" required>
                                <?php
                                //fetching registrar service
                                $result_registrar = mysqli_query($connection, "SELECT * FROM reg_services");
                                while ($dropdown = mysqli_fetch_assoc($result_registrar)){
                                    if ($dropdown['services_id'] === '23') {
                                        break; // Stop the loop when services_id is 23
                                    }
                                  echo '<option value="' . $dropdown['services'] . '">' . $dropdown['services'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Schedule </label>
                            <input type="date" name="date" id="date" class="form-control is-invalid" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $('.editbtn').on('click', function () {
                $('#editmodal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                console.log(data);
                $('#id').val(data[1]);
                $('#code').val(data[1]);
                $('#request').val(data[3]);
                $('#date').val(data[4]);
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

    // Get the reference to the date input element
    var dateInput = document.getElementById('date');

    // Add an event listener for the input event
    dateInput.addEventListener('input', function() {
    var selectedDate = new Date(this.value);

    // Check if the selected date is a Sunday (0 represents Sunday in JavaScript)
    if (selectedDate.getDay() === 0) {
        // Disable the input field
        dateInput.value = ''; // Clear the input value if necessary
        //dateInput.disabled = true;
        alert('Selection of Sundays is not allowed.');
    } else {
        // Enable the input field if it was previously disabled
        dateInput.disabled = false;
    }
    });

    jQuery('#request option').each(function() {
    var optionText = this.text;
    console.log(optionText);
    var newOption = optionText.substring(0,50);
    console.log(newOption);
    jQuery(this).text(newOption + '..');
    });

    </script>