<?php include './functions.php';?>

<?php
    // Add pagination to the table
    $rowsPerPage = 5;

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $rowsPerPage;

    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : '';
    $sortDirection = isset($_GET['dir']) ? $_GET['dir'] : 'DESC';

    // Validate and sanitize the sort column
    $validColumns = ['id', 'appointment_description', 'scheduled_datetime', 'status_name'];
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
                    Reference Number
                    <?php if ($sortColumn === 'counseling_id') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=appointment_description&dir=<?php echo $sortColumn === 'appointment_description' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Document Type
                    <?php if ($sortColumn === 'appointment_description') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=scheduled_datetime&dir=<?php echo $sortColumn === 'scheduled_datetime' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Amount
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
            <td><a href="<?php echo getSchedulePageRedirect($appointmentDescription); ?>" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a> <?php echo (new DateTime($scheduledDateTime))->format("m/d/Y g:i A"); ?></td>
            <td class="text-center">
                <span class="badge rounded-pill <?php echo getStatusBadgeClass($statusName); ?>">
                    <?php echo $statusName; ?>
                </span>
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