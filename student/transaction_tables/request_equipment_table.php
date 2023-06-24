<?php include './functions.php';?>

<?php
    // Add pagination to the table
    $rowsPerPage = 5;

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $rowsPerPage;

    $sortColumn = isset($_GET['sort']) ? $_GET['sort'] : '';
    $sortDirection = isset($_GET['dir']) ? $_GET['dir'] : 'DESC';

    // Validate and sanitize the sort column
    $validColumns = ['request_id', 'equipment_name', 'quantity_equip', 'datetime_schedule', 'status_name'];
    if (!in_array($sortColumn, $validColumns)) {
        $sortColumn = 'request_id'; // Set a default sort column
    }

    // Validate and sanitize the sort direction
    $sortDirection = strtoupper($sortDirection);
    if ($sortDirection !== 'ASC' && $sortDirection !== 'DESC') {
        $sortDirection = 'DESC'; // Set a default sort direction
    }

    $requestEquipment = "SELECT request_id, equipment_name, quantity_equip, datetime_schedule, status_name
    FROM request_equipment
    -- INNER JOIN offices ON request_equipment.office_id = offices.office_id
    INNER JOIN statuses ON request_equipment.status_id = statuses.status_id
    INNER JOIN equipment ON request_equipment.equipment_id = equipment.equipment_id
    -- INNER JOIN equipment_type ON request_equipment.equipment_type_id = equipment.equipment_type_id
    WHERE user_id = " . $_SESSION['user_id'] . " AND datetime_schedule IS NOT NULL
    ORDER BY $sortColumn $sortDirection
    LIMIT $offset, $rowsPerPage";

    $result = mysqli_query($connection, $requestEquipment);
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
                <a class="text-decoration-none text-dark" href="?sort=equipment_name&dir=<?php echo $sortColumn === 'equipment_name' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Equipment Name
                    <?php if ($sortColumn === 'equipment_name') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
   
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=quantity_equip&dir=<?php echo $sortColumn === 'quantity_equip' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Quantity
                    <?php if ($sortColumn === 'quantity_equip') { ?>
                        <span class="sort-icon <?php echo $sortDirection === 'ASC' ? 'asc' : 'desc'; ?>"></span>
                    <?php } ?>
                </a>
            </th>
            <th class="text-center sortable-header" scope="col">
                <a class="text-decoration-none text-dark" href="?sort=datetime_schedule&dir=<?php echo $sortColumn === 'datetime_schedule' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'; ?>">
                    Schedule
                    <?php if ($sortColumn === 'datetime_schedule') { ?>
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
                        $equipmentName = $row['equipment_name'];
                        $quantity = $row['quantity_equip'];
                        $schedule = $row['datetime_schedule'];
                        $statusName = $row['status_name'];
                        $formattedSchedule = date("F j, Y | g:i a", strtotime($schedule));
        ?>
        <tr>
            <td><?php echo "AO-"; echo $requestId; ?></td>
            <td><?php echo $equipmentName; ?></td>
            <td><?php echo $quantity; ?></td>
            <td><?php echo $formattedSchedule; ?></td>

            <td class="text-center">
                <span class="badge rounded-pill bg-dark text-white <?php echo getStatusBadgeClass($statusName); ?>">
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

            $countTotal = "SELECT COUNT(*) AS total FROM request_equipment";
            $countResult = mysqli_query($connection, $countTotal);
            $countRow = mysqli_fetch_assoc($countResult);
            $totalRows = $countRow['total'];

            $totalPages = ceil($totalRows / $rowsPerPage);
        ?>
    </tbody>
</table>