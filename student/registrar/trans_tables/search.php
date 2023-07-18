<?php 
session_start();
include '../../../conn.php';

// Check if the query parameter is set
if (isset($_POST['query'])) {
    // Sanitize the search query to prevent SQL injection
    $search = mysqli_real_escape_string($connection, $_POST['query']);
    
    // Get the necessary variables from transactions.php
    $id = $_SESSION['user_id'];
    $page_no = $_GET['page_no'] ?? 1;
    $total_records_per_page = 20;
    $offset = ($page_no - 1) * $total_records_per_page;
    
    // Construct the search query
    $search_query = "SELECT * FROM users
    INNER JOIN reg_transaction ON users.user_id = reg_transaction.user_id
    INNER JOIN offices ON reg_transaction.office_id = offices.office_id
    INNER JOIN reg_services ON reg_transaction.services_id = reg_services.services_id
    INNER JOIN statuses ON reg_transaction.status_id = statuses.status_id
    WHERE users.user_id = $id AND (request_code LIKE '%$search%' OR office_name LIKE '%$search%' OR services LIKE '%$search%' OR schedule LIKE '%$search%' OR status_name LIKE '%$search%')
    LIMIT $offset, $total_records_per_page";

    // Execute the search query
    $search_result = mysqli_query($connection, $search_query);

    // Check if any matching records found
    if (mysqli_num_rows($search_result) > 0) {
        echo '<table class="table table-hover" id="table-data">
            <thead>
                <tr class="table-active">
                    <th></th>
                    <th class="text-center sortable-header" scope="col" data-order="desc">Request Code</th>
                    <th class="text-center sortable-header" scope="col" data-order="desc">Office</th>
                    <th class="text-center sortable-header w-50" scope="col" data-order="desc">Request</th>
                    <th class="text-center sortable-header" scope="col" data-order="desc">Schedule</th>
                    <th class="text-center sortable-header" scope="col" data-order="desc">Status</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($search_result as $row) {
            ?>
            <tr>
                <td><input class="userinfo" type="checkbox" data-id="<?= $row['reg_id']; ?>" onclick="uncheckCheckbox(this)"></td>
                <td class="text-center"><?= $row['request_code']; ?></td>
                <td class="text-center"><?= $row['office_name']; ?></td>
                <td class="text-center"><?= $row['services']; ?></td>
                <td class="text-center"><?= $row['schedule']; ?></td>
                <?php if ($row['status_id'] == "1") { ?>
                    <td class="text-center"><span class="badge rounded-pill bg-dark"><?= $row['status_name']; ?></span></td>
                <?php } else if ($row['status_id'] == "2") { ?>
                    <td class="text-center"><span class="badge rounded-pill" style="background-color: orange;"><?= $row['status_name']; ?></span></td>
                <?php } else if ($row['status_id'] == "3") { ?>
                    <td class="text-center"><span class="badge rounded-pill" style="background-color: blue;"><?= $row['status_name']; ?></span></td>
                <?php } else if ($row['status_id'] == "4") { ?>
                    <td class="text-center"><span class="badge rounded-pill" style="background-color: DodgerBlue;"><?= $row['status_name']; ?></span></td>
                <?php } else if ($row['status_id'] == "5") { ?>
                    <td class="text-center"><span class="badge rounded-pill" style="background-color: green;"><?= $row['status_name']; ?></span></td>
                <?php } else if ($row['status_id'] == "6") { ?>
                    <td class="text-center"><span class="badge rounded-pill" style="background-color: red;"><?= $row['status_name']; ?></span></td>
                <?php } ?>
            </tr>
        <?php
        }
        echo '</tbody>
        </table>';
    } else {
        // No matching records found
        echo '<tr>
                <td class="text-center table-light p-4"" colspan="6">No record found!</td>
              </tr>';
    }
}
?>

<script>
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
</script>