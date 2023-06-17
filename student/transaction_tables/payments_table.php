<?php include './functions.php';?>

<?php
    // Add pagination to the table
    $rowsPerPage = 5;

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $rowsPerPage;

    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : '';
    $sortDirection = isset($_GET['dir']) ? $_GET['dir'] : 'DESC';

    // Validate and sanitize the sort column
    $validColumns = ['request_id', 'office_name', 'request_description', 'amount_to_pay', 'status_name'];
    if (!in_array($sortColumn, $validColumns)) {
        $sortColumn = 'amount_to_pay'; // Set a default sort column
    }

    // Validate and sanitize the sort direction
    $sortDirection = strtoupper($sortDirection);
    if ($sortDirection !== 'ASC' && $sortDirection !== 'DESC') {
        $sortDirection = 'DESC'; // Set a default sort direction
    }

    $appointmentSchedules = "SELECT request_id, office_name, request_description, amount_to_pay, status_name
    FROM doc_requests
    INNER JOIN offices ON doc_requests.office_id = offices.office_id
    INNER JOIN statuses ON doc_requests.status_id = statuses.status_id
    WHERE user_id = " . $_SESSION['user_id'] . " AND request_description IS NOT NULL
    ORDER BY $sortColumn $sortDirection
    LIMIT $offset, $rowsPerPage";

    $result = mysqli_query($connection, $appointmentSchedules);
?>
<table id="transactions-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=request_id&dir=<?php echo $sortColumn === 'id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Request Code
                    <?php if ($sortColumn === 'request_id') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=appointment_description&dir=<?php echo $sortColumn === 'appointment_description' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Office
                    <?php if ($sortColumn === 'appointment_description') { ?>
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
                <a class="text-decoration-none text-dark" href="?sort=amount_to_pay&dir=<?php echo $sortColumn === 'amount_to_pay' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Amount to Pay
                    <?php if ($sortColumn === 'amount_to_pay') { ?>
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
                        $requestId = $row['request_id'];
                        $officeName = $row['office_name'];
                        $requestDesc = $row['request_description'];
                        $amountToPay = $row['amount_to_pay'];
                        $statusName = $row['status_name'];
        ?>
        <tr>
            <td><?php echo "GO-"; echo $requestId; ?></td>
            <td><?php echo $officeName; ?></td>
            <td><?php echo $requestDesc; ?></td>
            <td><?php echo $amountToPay; ?></td>
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