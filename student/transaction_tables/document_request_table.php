<table id="transactions-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center"></th>
            <th class="text-center doc-request-id-header sortable-header" data-column="1" scope="col" data-order="asc">
                Request Code
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center doc-request-office-header sortable-header" data-column="2" scope="col" data-order="asc">
                Office
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center doc-request-description-header sortable-header" data-column="3" scope="col" data-order="asc">
                Request
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <!-- <th class="text-center doc-request-schedule-header sortable-header" data-column="4" scope="col" data-order="asc">
                Schedule
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th> -->
            <th class="text-center doc-request-amount-header sortable-header" data-column="5" scope="col" data-order="asc">
                Amount to pay
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center doc-request-status-header sortable-header" data-column="6" scope="col" data-order="asc">
                Status
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
        </tr>
    </thead>
    <tbody id="table-body">
        <!-- Table rows will be generated dynamically using JavaScript -->
    </tbody>
</table>
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
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'Approved':
                return 'bg-success';
            case 'Disapproved':
                return 'bg-danger';
            case 'For receiving':
                return 'bg-warning text-dark';
            case 'For evaluation':
                return 'bg-primary';
            case 'Ready for pickup':
                return 'bg-info';
            case 'Released':
                return 'bg-success';
            default:
                return 'bg-dark';
        }
    }
    
    // Add more cases here for other office document requests
    function getSchedulePageRedirect(request) {
        switch (request) {
            case "Request Good Moral Document":
                return "/student/guidance/doc_appointments/good_morals.php";
            case "Request Clearance":
                return "/student/guidance/doc_appointments/clearance.php";
            default:
                return "#";
        }
    }

    function handleDeleteRequest(requestIds) {
        // Make an AJAX request to delete the document requests
        $.ajax({
            url: 'transaction_tables/delete_document_request.php',
            method: 'POST',
            data: { request_id: requestIds },
            success: function(response) {
                console.log('Requests deleted successfully');
                console.log(requestIds);

                // Refresh the table after deletion
                handlePagination(1, '');
            }
        });
    }

    function addDeleteButtonListeners() {
        // Get the delete button element
        var deleteButton = document.getElementById('delete-button');

        // Get all the checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Function to update the delete button state based on checkbox selection
        function updateDeleteButtonState() {
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            deleteButton.disabled = checkedCheckboxes.length === 0;
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

    function handlePagination(page, searchTerm = '', column = 'request_id', order = 'desc') {
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'transaction_tables/fetch_document_requests.php',
            method: 'POST',
            data: { page: page, searchTerm: searchTerm, column: column, order: order },
            success: function(response) {
                // Parse the JSON response
                var data = JSON.parse(response);

                // Update the table body with the received data
                var tableBody = document.getElementById('table-body');
                tableBody.innerHTML = '';

                if (data.total_records > 0) {
                    for (var i = 0; i < data.document_requests.length; i++) {
                        var request = data.document_requests[i];
                        var scheduleButton = '';

                        // Add schedule button if the status is "Pending"
                        if (request.status_name === 'Pending') {
                            var schedulePageRedirect = getSchedulePageRedirect(request.request_description);
                            scheduleButton = '<a href="' + schedulePageRedirect + '" class="btn btn-primary">Schedule Now</a>';
                        }

                        var row = '<tr>' +
                            '<td><input type="checkbox" id="' + request.request_id + '" name="' + request.request_id + '" value="' + request.request_id + '"></td>' +
                            '<td>' + 'DR-' + request.request_id + '</td>' +
                            '<td>' + request.office_name + '</td>' +
                            '<td>' + request.request_description + '</td>' +
                            // '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)).toLocaleString() : 'Not yet scheduled') + '</td>' +
                            '<td>' + '₱' + request.amount_to_pay + '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill ' + getStatusBadgeClass(request.status_name) + '">' + request.status_name + '</span>' +
                            '</td>' +
                            // '<td class="text-center">' +
                            // scheduleButton +
                            // '</td>' +
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }  else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="7">No Transactions</td></tr>';
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
    handlePagination(1, '', 'request_id', 'desc');

    $(document).ready(function() {
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'request_id', 'desc');
        });
    });
</script>
