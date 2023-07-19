<?php
    $id = $_SESSION['user_id'];

    //get page number
    if(isset($_GET['page_no']) && $_GET['page_no'] !== "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    //total rows or records to display
    $total_records_per_page = 20;
    //get the page offset for the LIMIT query
    $offset = ($page_no - 1) * $total_records_per_page;
    //get previous page
    $previous_page = $page_no - 1;
    //get next page
    $next_page = $page_no + 1;
    //get the total count of records
    $result_count = mysqli_query($connection, "SELECT COUNT(*) as total_records FROM reg_transaction WHERE user_id = '$id'");
    //total records
    $records = mysqli_fetch_array($result_count);
    //store total_records to a variable
    $total_records = $records['total_records'];
    //get total pages
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    $query = "SELECT * FROM doc_requests
                INNER JOIN offices ON doc_requests.office_id = offices.office_id
                INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                WHERE user_id = $id AND doc_requests.office_id = '3' LIMIT $offset, $total_records_per_page";
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
            <button class="btn " type="button" name="query" disabled><i class="fas fa-search"></i></button>
            <input type="text" name="search" id="search_text" class="form-control" placeholder="Search Here...">
        </div>
    </div>
</div>

<table class="table table-hover" id="table-data">
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
        $query_run = mysqli_query($connection, $query);
        if(mysqli_num_rows($query_run) > 0){
              foreach($query_run as $row) {
                ?>
                <tr>
                  <td><input class="userinfo" type="checkbox" data-id="<?=$row['request_id'];?>" onclick="uncheckCheckbox(this)"></input></td>
                  <td class="text-center"><?=$row['request_id'];?></td>
                  <td class="text-center"><?=$row['office_name'];?></td>
                  <td class="text-center"><?=$row['request_description'];?></td>
                  <td class="text-center"><?= date('F d, Y', strtotime($row['scheduled_datetime'])); ?></td>
                  <td class="text-center">₱<?=$row['amount_to_pay'];?></td>
                  <?php if ($row['status_id'] == "1"){ ?>
                  <td class="text-center"><span class="badge rounded-pill bg-dark"><?=$row['status_name'];?></td>
                  <?php } else if ($row['status_id'] == "2") { ?>
                    <td class="text-center"><span class="badge rounded-pill" style="background-color: orange;"><?=$row['status_name'];?></td>
                    <?php } else if ($row['status_id'] == "3") { ?>
                        <td class="text-center"><span class="badge rounded-pill" style="background-color: blue;"><?=$row['status_name'];?></td>
                    <?php } else if ($row['status_id'] == "4") { ?>
                        <td class="text-center"><span class="badge rounded-pill" style="background-color: DodgerBlue;"><?=$row['status_name'];?></td>
                    <?php } else if ($row['status_id'] == "5") { ?>
                        <td class="text-center"><span class="badge rounded-pill" style="background-color: green;"><?=$row['status_name'];?></td>
                    <?php } else if ($row['status_id'] == "6") { ?>
                        <td class="text-center"><span class="badge rounded-pill" style="background-color: red;"><?=$row['status_name'];?></td>
                    <?php } ?>
                </tr>
                <?php
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
<nav aria-label="Page navigation example">
  <ul class="pagination">
  <div class="d-flex w-100 justify-content-between p-2">
        <li class="page-item"><a class="btn btn-primary text-white<?= ($page_no <= 1)? 'disabled' : '';?>" 
            <?= ($page_no > 1)? 'href=?page_no='.$previous_page : '';?> >Previous</a></li>

        <div class="d-flex justify-content-center">
            <?php for($counter = 1; $counter <= $total_no_of_pages; $counter++){ ?>
            <li class="page-item"><a class="page-link btn-outline-primary border-0" href="?page_no=<?= $counter; ?>"><u><?= $counter; ?></u></a></li>
            <?php } ?> 
        </div>

        <div class="d-flex justify-content-end gap-2">
            <li class="page-item"><a class="btn btn-primary text-white<?= ($page_no >= $total_no_of_pages)? 'disabled' : '';?>"
                <?= ($page_no < $total_no_of_pages)? 'href=?page_no='.$next_page : '';?> >Next</a></li>
        </div>
    </div>
  </ul>
</nav>
<div class="p-10 pagination">
    <strong>
        Page <?= $page_no ?> of <?= $total_no_of_pages ?>
    </strong>
</div>
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

      $(document).ready(function() {
        var originalTable = $("#table-data").html(); // Store the original table HTML

        $('#search_text').keyup(function() {
        var search = $(this).val();
        if (search === '') {
            // Empty search input, show original table and pagination
            $("#table-data").html(originalTable);
            $(".pagination").show();
        } else {
            $.ajax({
            url: 'trans_tables/search.php',
            method: 'post',
            data: {
                query: search
            },
            success: function(response) {
                $("#table-data").html(response);
                // Hide pagination buttons during search
                $(".pagination").hide();
            }
            });
        }
        });
    });

</script>