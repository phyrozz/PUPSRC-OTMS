<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
            <th class="text-center"></th>
                <th class="text-center doc-request-id-header sortable-header" data-column="offsetting_id" scope="col" data-order="desc">
                    Transaction Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-office-header sortable-header" data-column="timestamp" scope="col" data-order="desc">
                    Transaction Date
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-description-header sortable-header" data-column="amountToOffset" scope="col" data-order="desc">
                    Amount to Offset
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-amount-header sortable-header" data-column="offsetType" scope="col" data-order="desc">
                    Offset Type
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-status-header sortable-header" data-column="status_name" scope="col" data-order="desc">
                    Status
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table rows will be generated dynamically using JavaScript -->
        </tbody>
    </table>
</div>
<div id="pagination" class="container-fluid p-0">
<nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <button id="delete-button" class="btn btn-primary" disabled="disabled">Delete Transaction(s)</button>
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be generated dynamically using JavaScript -->
            </ul>
        </div>
    </nav>
</div>
<div class="d-flex">
    <div id="reminder-container" class="alert alert-info mt-3" role="alert">
        <h4 class="alert-heading">
            <i class="fa-solid fa-circle-info"></i> Reminder
        </h4>
        <p class="mb-0">Always check your transaction status to follow instructions.</p>
        <p class="mb-0">You can delete or edit transactions during <span
            class="badge rounded-pill bg-dark">Pending</span> status.</p>
        <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The offsetting transaction is pending for review by the office.</small></p>
        <p class="mb-0"><small><span class="badge rounded-pill bg-danger">Rejected</span> - The transaction is rejected
            by the office.</small></p>
        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: blue;">For Evaluation</span> - The offsetting transaction is under review by the office.</small>
        </p>
        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: green;">Approved</span> -
            The offsetting has been settled.</small></p>
        <!-- <p class="mb-0">You will find answers to the questions we get asked the most about requesting for academic documents through <a href="FAQ.php">FAQs</a>.</p> -->
    </div>
</div>
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'Approved':
                return 'bg-success';
            case 'Rejected':
                return 'bg-danger';
            case 'For Evaluation':
                return 'bg-primary';
            default:
                return 'bg-dark';
        }
    }
    function handleDeleteRequest(requestIds) {
        // Make an AJAX request to delete the document requests
        $.ajax({
            url: 'transaction_tables/delete_offsetting.php',
            method: 'POST',
            data: { offsetting_id: requestIds },
            success: function(response) {
                // Refresh the table after deletion
                handlePagination(1, '');
            }
        });
    }

    function addDeleteButtonListeners() {
        var deleteButton = document.getElementById('delete-button');

        // Get all the checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Function to update the delete button state based on checkbox selection and status_id value
        function updateDeleteButtonState() {
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Check the status_id value of the selected rows
            var canDelete = Array.from(checkedCheckboxes).every(function (checkbox) {
                var row = checkbox.closest('tr');
                var statusCell = row.querySelector('.doc-request-status-cell');
                var status = statusCell.textContent.trim();
                
                return status === 'Pending' || status === 'Rejected';
            });

            deleteButton.disabled = !canDelete || checkedCheckboxes.length === 0;
        }

        // Add event listeners to checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateDeleteButtonState);
        });

        // Add event listener to delete button
        deleteButton.addEventListener('click', function () {
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Get the request ids of the checked rows
            var requestIds = Array.from(checkedCheckboxes).map(function (checkbox) {
                return checkbox.value;
            });

            if (confirm('Are you sure you want to delete the selected appointment(s)?')) {
                handleDeleteRequest(requestIds);
            }
        });

        // Update delete button state initially
        updateDeleteButtonState();
    }

    // Event listener for edit buttons
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('edit-request')) {
            var editId = event.target.getAttribute('data-request-id');
            populateEditModal(editId);
        }
    });

    function handlePagination(page, searchTerm = '', column = 'timestamp', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'transaction_tables/fetch_offsettings.php',
            method: 'POST',
            data: { page: page, searchTerm: searchTerm, column: column, order: order },
            success: function(response) {
                // Hide the loading indicator
                loadingIndicator.style.display = 'none';

                // Show the table
                table.classList.remove('hidden');

                // Parse the JSON response
                var data = JSON.parse(response);

                // Update the table body with the received data
                var tableBody = document.getElementById('table-body');
                tableBody.innerHTML = '';

                if (data.total_records > 0) {
                    for (var i = 0; i < data.offsettings.length; i++) {
                        var offsetting = data.offsettings[i];

                        var row = '<tr>' +
                        '<td><input type="checkbox" id="' + offsetting.offsetting_id + '" name="' + offsetting.offsetting_id + '" value="' + offsetting.offsetting_id + '"></td>' +
                            '<td>' + 'AO-' + offsetting.offsetting_id + '</td>' +
                            '<td>' + (offsetting.timestamp !== null ? (new Date(offsetting.timestamp)).toLocaleString('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                            }) : 'Not yet scheduled')
                            + '</td>' +
                            '<td>' + '₱' + offsetting.amountToOffset + '</td>' +
                            '<td>' + offsetting.offsetType + '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill doc-request-status-cell ' + getStatusBadgeClass(offsetting.status_name) + '">' + offsetting.status_name + '</span>' + 
                            '</td>' +
                            '<td>' +
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }  else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="8">No Transactions</td></tr>';
                    tableBody.innerHTML = noRecordsRow;
                }

                // Update the pagination links
                var paginationLinks = document.getElementById('pagination-links');
                paginationLinks.innerHTML = '';

                if (data.total_pages > 1) {
                    for (var i = 1; i <= data.total_pages; i++) {
                        var pageLink = '<li class="page-item">' +
                            '<a class="page-link ' + (i == data.current_page ? 'btn-primary text-light' : 'btn-outline-primary') + '" href="#" onclick="handlePagination(' + i + ')">' + i + '</a>' +
                            '</li>';
                        paginationLinks.innerHTML += pageLink;
                    }
                }
                             // Add event listeners for delete buttons
                             addDeleteButtonListeners();
            },
            error: function() {
                // Hide the loading indicator in case of an error
                loadingIndicator.style.display = 'none';

                // Handle the error appropriately
                console.log('Error occurred while fetching data.');
            }
        });
    }

    // Function to toggle the sort icons
    function toggleSortIcons(header) {
        var sortIcon = header.querySelector('.sort-icon');
        sortIcon.classList.toggle('fa-caret-down');
        sortIcon.classList.toggle('fa-caret-up');
    }

    // Add event listeners to sortable headers
    var sortableHeaders = document.querySelectorAll('.sortable-header');
    sortableHeaders.forEach(function (sortableHeader) {
        sortableHeader.addEventListener('click', function () {
            var column = sortableHeader.getAttribute('data-column');
            var order = sortableHeader.getAttribute('data-order');

            // Toggle the sort icons
            toggleSortIcons(sortableHeader);

            // Update the data-order attribute
            sortableHeader.setAttribute('data-order', order === 'asc' ? 'desc' : 'asc');

            // Call the pagination function with the updated sorting parameters
            handlePagination(1, '', column, order);
        });
    });

    // Initial pagination request (page 1)
    handlePagination(1, '', 'timestamp', 'desc');

    $(document).ready(function() {
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'timestamp', 'desc');
        });
    });
</script>
