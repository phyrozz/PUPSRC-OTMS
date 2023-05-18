<?php include './functions.php';?>

<?php
    // Add pagination to the table
    $rowsPerPage = 5;

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $rowsPerPage;

    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'request_code';
    $sortDirection = isset($_GET['dir']) ? $_GET['dir'] : 'DESC';

    // Validate and sanitize the sort column
    $validColumns = ['id', 'office_name', 'request_description', 'scheduled_datetime', 'status_name', 'amount_to_pay'];
    if (!in_array($sortColumn, $validColumns)) {
        $sortColumn = 'scheduled_datetime'; // Set a default sort column
    }

    // Validate and sanitize the sort direction
    $sortDirection = strtoupper($sortDirection);
    if ($sortDirection !== 'ASC' && $sortDirection !== 'DESC') {
        $sortDirection = 'DESC'; // Set a default sort direction
    }

    $documentRequests = "SELECT doc_requests.id, office_name, request_description, scheduled_datetime, status_name, amount_to_pay
                        FROM doc_requests
                        INNER JOIN offices ON doc_requests.office_id = offices.id
                        INNER JOIN statuses ON doc_requests.status_id = statuses.id
                        WHERE user_id = 1 OR request_description <> NULL
                        ORDER BY $sortColumn $sortDirection
                        LIMIT $offset, $rowsPerPage";

    $result = mysqli_query($connection, $documentRequests);
?>
<table id="transactions-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=id&dir=<?php echo $sortColumn === 'id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Request Code
                    <?php if ($sortColumn === 'id') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=office_name&dir=<?php echo $sortColumn === 'office_name' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Office
                    <?php if ($sortColumn === 'office_name') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=request_description&dir=<?php echo $sortColumn === 'request_description' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Request
                    <?php if ($sortColumn === 'request_description') { ?>
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
            <th class="text-center" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=id&dir=<?php echo $sortColumn === 'amount_to_pay' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Amount to pay
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
                while ($row = mysqli_fetch_assoc($result)) {
                    $requestId = $row['id'];
                    $requestDescription = $row['request_description'];
                    $scheduledDateTime = $row['scheduled_datetime'];
                    $officeName = $row['office_name'];
                    $statusName = $row['status_name'];
                    $amountToPay = $row['amount_to_pay'];
        ?>
        <tr>
            <td><?php echo "DR-"; echo $requestId; ?></td>
            <td><?php echo $officeName; ?></td>
            <td><?php echo $requestDescription; ?></td>
            <td><a href="<?php echo getSchedulePageRedirect($requestDescription); ?>" class="btn btn-primary px-2 py-0"><i class="fa-brands fa-wpforms"></i></a> <?php echo (new DateTime($scheduledDateTime))->format("m/d/Y g:i A"); ?></td>
            <td><?php echo "₱"; echo $amountToPay; ?></td>
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
                echo "Error executing the query: " . mysqli_error($connection);
            }

            $countTotalOnDocumentRequests = "SELECT COUNT(*) AS total FROM doc_requests WHERE user_id = 1";
            $countResult = mysqli_query($connection, $countTotalOnDocumentRequests);
            $countRow = mysqli_fetch_assoc($countResult);
            $totalRows = $countRow['total'];

            $totalPages = ceil($totalRows / $rowsPerPage);
        ?>
    </tbody>
</table>