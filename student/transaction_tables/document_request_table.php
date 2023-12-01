<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center"></th>
                <th class="text-center doc-request-id-header sortable-header" data-column="request_id" scope="col" data-order="desc">
                    Request Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-description-header sortable-header" data-column="request_description" scope="col" data-order="desc">
                    Request
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-schedule-header sortable-header" data-column="scheduled_datetime" scope="col" data-order="desc">
                    Scheduled Date
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-amount-header sortable-header" data-column="amount_to_pay" scope="col" data-order="desc">
                    Amount to pay
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
        <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The requester should settle
            the deficiency/ies to necessary office.</small></p>
        <p class="mb-0"><small><span class="badge rounded-pill bg-danger">Rejected</span> - The request is rejected
            by the admin.</small></p>
        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: orange;">For
                receiving</span> - The request is currently in Receiving window and waiting for submission of
            requirements.</small></p>
        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: blue;">For
                evaluation</span> - Evaluation and Processing of records and required documents for releasing.</small>
        </p>
        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: DodgerBlue;">Ready for
                pickup</span> - The requested document/s is/are already available for pickup at the releasing section
            of student records.</small></p>
        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: green;">Released</span> -
            The requested document/s was/were claimed.</small></p>
        <!-- <p class="mb-0">You will find answers to the questions we get asked the most about requesting for academic documents through <a href="FAQ.php">FAQs</a>.</p> -->
    </div>
</div>
<!-- View edit modal -->
<div id="viewEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEditModalLabel">Edit request</h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view edit modal -->
<script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'Released':
                return 'bg-success';
            case 'Rejected':
                return 'bg-danger';
            case 'For Receiving':
                return 'bg-warning text-dark';
            case 'For Evaluation':
                return 'bg-primary';
            case 'Ready for Pickup':
                return 'bg-info';
            default:
                return 'bg-dark';
        }
    }

    function handleDeleteRequest(requestIds) {
        // Make an AJAX request to delete the document requests
        $.ajax({
            url: 'transaction_tables/delete_document_request.php',
            method: 'POST',
            data: { request_id: requestIds },
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

    // Function to populate the edit modal with the request details
    function populateEditModal(editId) {
        $.ajax({
            url: 'transaction_tables/get_document_request.php',
            method: 'POST',
            data: { edit_id: editId },
            success: function(response) {
                var request = JSON.parse(response);
                var modalTitle = document.getElementById('viewEditModalLabel');
                var modalBody = document.querySelector('#viewEditModal .modal-body');

                modalTitle.innerText = 'Edit Request';

                modalBody.innerHTML = `
                    <form id="editForm" action="" method="POST">
                        <div class="mb-3">
                            <label for="requestDescription" class="form-label">Request Description</label>
                            <select id="requestDescription" class="form-select" name="requestDescription" value="${request.request_description}" required>
                                <option value="Request Good Moral Document">Request Good Moral Document</option>
                                <option value="Request Clearance">Request Clearance</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="scheduledDate" class="form-label">Scheduled Date</label>
                            <input type="text" class="form-control" id="scheduledDate" name="scheduledDate" value="${request.scheduled_datetime}" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                    </form>
                `;

                flatpickr('#scheduledDate', {
                    readonly: false,
                    allowInput: true,
                    defaultDate: "today",
                    dateFormat: "Y-m-d",
                    theme: "custom-datepicker",
                    minDate: "today",
                    maxDate: "31.12.2033",
                    disable: [
                        function(date) {
                            // Disable date on Sundays
                            return (date.getDay() === 0);

                        }
                    ],
                    locale: {
                        "firstDayOfWeek": 1 // start week on Monday
                    },
                });

                var editForm = document.getElementById('editForm');
                editForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    updateRequest(editId);
                });

                $("#viewEditModal").modal("show");
            },
            error: function() {
                console.log('Error occurred while fetching request details.');
            }
        });
    }

    // Function to update the request using AJAX
    function updateRequest(editId) {
        var form = document.getElementById('editForm');
        var formData = new FormData(form);

        formData.append('edit_id', editId);

        $.ajax({
            url: 'transaction_tables/update_document_request.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $("#viewEditModal").modal("hide");
                handlePagination(1, '');
                form.reset();
            },
            error: function() {
                console.log('Error occurred while updating request.');
            }
        });
    }

    function handlePagination(page, searchTerm = '', column = 'request_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'transaction_tables/fetch_document_requests.php',
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
                    for (var i = 0; i < data.document_requests.length; i++) {
                        var request = data.document_requests[i];

                        var row = '<tr>' +
                            '<td><input type="checkbox" id="' + request.request_id + '" name="' + request.request_id + '" value="' + request.request_id + '"></td>' +
                            '<td>' + request.request_id + '</td>' +
                            '<td>' + request.request_description + '</td>' +
                            '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })) : 'Not yet scheduled') + '</td>' +
                            '<td>' + '₱' + request.amount_to_pay + '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill doc-request-status-cell ' + getStatusBadgeClass(request.status_name) + '">' + request.status_name + '</span>' +
                            '</td>' +
                            '<td><a href="#" class="btn btn-primary btn-sm edit-request" data-request-id="' + request.request_id + '">Edit <i class="fa-solid fa-pen-to-square"></i></a></td>' +
                            '<td><button class="btn btn-primary btn-sm cancel-request" data-request-id="' + request.request_id + '" >Cancel <i class="fa-solid fa-xmark"></i></button></td>' + 
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
                // Checks for request status and hides cancelled button
                updateCancelButtonStatus();
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

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('cancel-request')) {
            var requestId = event.target.getAttribute('data-request-id');
           cancelRequest(requestId);
        }
    });

    // Function for Cancel button
    function cancelRequest(requestId) {
    // Make an AJAX request to cancel the equipment request
        $.ajax({
            url: 'transaction_tables/cancel_doc_request.php',
            method: 'POST',
            data: { request_id: requestId },
            success: function(response) {
                console.log(requestId);
                console.log('Request canceled successfully');



                handlePagination(1, '', 'request_id', 'desc');
            },
            error: function(error) {
                console.error('Error canceling request:', error.responseText);
            }
        });
    }

    // Disables Cancel Button for certain statuses
    function updateCancelButtonStatus() {
        var cancelButtons = document.querySelectorAll('.cancel-request');

        cancelButtons.forEach(function (button) {
            var row = button.closest('tr');
            var statusCell = row.querySelector('.doc-request-status-cell');
            var status = statusCell.textContent.trim();

            // Disable the Cancel button based on specific statuses
            if (
                status === 'For Receiving' ||
                status === 'For Evaluation' ||
                status === 'Ready for Pickup' ||
                status === 'Released' ||
                status === 'Rejected' ||
                status === 'Approved' ||
                status === 'Cancelled'
            ) {
                button.disabled = true;
            } else {
                button.disabled = false;
            }
        });
    }

    // Initial pagination request (page 1)
    handlePagination(1, '', 'request_id', 'desc');

    $(document).ready(function() {
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'request_id', 'desc');
        });
    });
</script>
