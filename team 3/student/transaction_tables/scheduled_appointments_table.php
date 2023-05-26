<?php include './functions.php';?>

<?php
    // if (isset($_POST['delete_appointment'])) {
    //     $counselingId = $_POST['counseling_id'];

    //     $deleteQuery = "DELETE FROM counseling_schedules WHERE counseling_id = $counselingId";
    //     $deleteResult = mysqli_query($connection, $deleteQuery);
    //     $deleteQuery = "DELETE FROM doc_requests WHERE "

    //     if ($deleteResult) {
    //         header("Refresh:0");
    //         // exit();
    //     }
    // }

    if (isset($_POST['delete_appointment'])) {
        $counselingId = $_POST['counseling_id'];

        // Get the request_id associated with the counseling_id
        $getRequestIdQuery = "SELECT doc_requests_id FROM counseling_schedules WHERE counseling_id = $counselingId";
        $getRequestIdResult = mysqli_query($connection, $getRequestIdQuery);

        if ($getRequestIdResult && mysqli_num_rows($getRequestIdResult) > 0) {
            $row = mysqli_fetch_assoc($getRequestIdResult);
            $requestId = $row['doc_requests_id'];

            // Perform the deletion on counseling_schedules table
            $deleteCounselingQuery = "DELETE FROM counseling_schedules WHERE counseling_id = $counselingId";
            $deleteCounselingResult = mysqli_query($connection, $deleteCounselingQuery);

            if ($deleteCounselingResult) {
                // Perform the deletion on doc_requests table
                $deleteRequestQuery = "DELETE FROM doc_requests WHERE request_id = $requestId";
                $deleteRequestResult = mysqli_query($connection, $deleteRequestQuery);

                if ($deleteRequestResult) {
                    header("Refresh:0");
                    // exit();
                }
            }
        }
    }

    // Add pagination to the table
    $rowsPerPage = 5;

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $rowsPerPage;

    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : '';
    $sortDirection = isset($_GET['dir']) ? $_GET['dir'] : 'DESC';

    // Validate and sanitize the sort column
    $validColumns = ['counseling_id', 'appointment_description', 'scheduled_datetime', 'status_name'];
    if (!in_array($sortColumn, $validColumns)) {
        $sortColumn = 'scheduled_datetime'; // Set a default sort column
    }

    // Validate and sanitize the sort direction
    $sortDirection = strtoupper($sortDirection);
    if ($sortDirection !== 'ASC' && $sortDirection !== 'DESC') {
        $sortDirection = 'DESC'; // Set a default sort direction
    }

    $appointmentSchedules = "SELECT request_id, appointment_description, scheduled_datetime, status_name, counseling_id
                        FROM doc_requests
                        INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
                        INNER JOIN counseling_schedules ON doc_requests.request_id = counseling_schedules.doc_requests_id
                        WHERE user_id = ". $_SESSION['user_id'] ."
                        ORDER BY $sortColumn $sortDirection
                        LIMIT $offset, $rowsPerPage";

    $result = mysqli_query($connection, $appointmentSchedules);
?>
<table id="transactions-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=counseling_id&dir=<?php echo $sortColumn === 'id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Schedule Code
                    <?php if ($sortColumn === 'counseling_id') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=appointment_description&dir=<?php echo $sortColumn === 'appointment_description' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Appointment Description
                    <?php if ($sortColumn === 'appointment_description') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=scheduled_datetime&dir=<?php echo $sortColumn === 'scheduled_datetime' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Schedule
                    <?php if ($sortColumn === 'scheduled_datetime') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=status_name&dir=<?php echo $sortColumn === 'status_name' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Status
                    <?php if ($sortColumn === 'status_name') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $appointmentId = $row['counseling_id'];
                        $appointmentDescription = $row['appointment_description'];
                        $scheduledDateTime = $row['scheduled_datetime'];
                        $statusName = $row['status_name'];
        ?>
        <tr>
            <td><?php echo "GO-"; echo $appointmentId; ?></td>
            <td><?php echo $appointmentDescription; ?></td>
            <td>
                <?php echo (new DateTime($scheduledDateTime))->format("m/d/Y g:i A"); ?>
            </td>
            <td class="text-center">
                <span class="badge rounded-pill <?php echo getStatusBadgeClass($statusName); ?>">
                    <?php echo $statusName; ?>
                </span>
            </td>
            <td class="text-center">
                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                    <a href="<?php echo getSchedulePageRedirect($appointmentDescription); ?>" class="btn btn-primary btn-sm"><i class="fa-brands fa-wpforms"></i></a>
                    <input type="hidden" name="counseling_id" value="<?php echo $appointmentId; ?>">
                    <?php
                    if ($statusName == "Pending" || $statusName == "Disapproved") {
                        echo '<button type="submit" name="delete_appointment" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash-can"></i></button>';
                    }
                    else {
                        echo '<button type="button" class="btn btn-sm" disabled><i class="fa-solid fa-trash-can"></i></button>';
                    }
                    ?>
                </form>
            </td>
        </tr>
        <?php
                    }
                }
                else {
        ?>
        <tr>
            <td class="text-center table-light p-4" colspan="4">No Transactions</td>
        </tr>
        <?php
                }
            }
            else {
                echo "Error executing the query: " . mysqli_error($connection);
            }

            $countTotal = "SELECT COUNT(*) AS total FROM counseling_schedules";
            $countResult = mysqli_query($connection, $countTotal);
            $countRow = mysqli_fetch_assoc($countResult);
            $totalRows = $countRow['total'];

            $totalPages = ceil($totalRows / $rowsPerPage);
        ?>
    </tbody>
</table>