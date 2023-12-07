<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 p-1">
            <div class="card">
                <div class="card-header">
                    <h4 class="alert-heading">
                        <i class="fa-solid fa-circle-info"></i> Reminder
                    </h4>
                </div>
                <div class="card-body">
                    <p class="mb-0">Always check your transaction status to follow instructions.</p>
                    <p class="mb-0">You can delete or edit transactions during <span
                        class="badge rounded-pill bg-dark">Pending</span> status.</p>
                    <hr />
                    <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The appointment is under review by the office.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill bg-secondary">Cancelled</span> - The user has cancelled the appointment.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill bg-danger">Rejected</span> - The appointment is rejected
                        by the office.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: blue;">For
                            evaluation</span> - Additional requirements or appointment purpose is under review by the office.</small>
                    </p>
                    <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: green;">Approved</span> -
                        The appointment is approved and the requestor must proceed to the Guidance Office.</small></p>
                </div>
            </div>
        </div>
        <div class="col-md-9 p-1">
            <div class="card">
                <div class="table-responsive">
                    <table id="transactions-table" class="table table-hover hidden m-0 p-0">
                        <thead>
                            <tr class="table-active">
                                <th class="text-center"></th>
                                <th class="text-center doc-request-id-header sortable-header" data-column="counseling_id" scope="col" data-order="desc">
                                    Counseling Code
                                    <i class="sort-icon fa-solid fa-caret-down"></i>
                                </th>
                                <th class="text-center doc-request-office-header sortable-header" data-column="appointment_description" scope="col" data-order="desc">
                                    Description
                                    <i class="sort-icon fa-solid fa-caret-down"></i>
                                </th>
                                <th class="text-center doc-request-description-header sortable-header" data-column="scheduled_datetime" scope="col" data-order="desc">
                                    Schedule
                                    <i class="sort-icon fa-solid fa-caret-down"></i>
                                </th>
                                <th class="text-center doc-request-schedule-header sortable-header" data-column="status_name" scope="col" data-order="desc">
                                    Status
                                    <i class="sort-icon fa-solid fa-caret-down"></i>
                                </th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="table-body" class="pe-none">
                            <!-- Table rows will be generated dynamically using JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="pagination" class="container-fluid p-0 pt-2">
                <nav aria-label="Page navigation">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <button id="delete-button" class="btn btn-primary" disabled="disabled">Delete Transaction(s)</button>
                        <ul class="pagination" id="pagination-links">
                            <!-- Pagination links will be generated dynamically using JavaScript -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- View comment modal -->
        <!-- <div id="viewCommentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewCommentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewCommentModalLabel">Reason/Comment</h5>
                    </div>
                    <div class="modal-body">
                        <p><?php  ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- End of view comment modal -->
<!-- View confirm cancel modal -->
<div id="confirmCancelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCancelModalLabel">Confirm cancellation</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this appointment? This action is irreversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button id="cancel-request-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- End of confirm cancel modal -->
<!-- Confirm delete modal -->
<div id="confirmDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm delete</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this request?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button id="delete-request-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- End of confirm delete modal -->
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'Approved':
                return 'bg-success';
            case 'Rejected':
                return 'bg-danger';
            case 'For Evaluation':
                return 'bg-primary';
            case 'Cancelled':
                return 'bg-secondary';
            default:
                return 'bg-dark';
        }
    }

    function handleDeleteRequest(appointmentIds) {
        // Make an AJAX request to delete the document requests
        $.ajax({
            url: 'transaction_tables/delete_counseling.php',
            method: 'POST',
            data: { appointment_id: appointmentIds },
            success: function(response) {
                console.log('Requests deleted successfully');
                console.log(appointmentIds);

                // Refresh the table after deletion
                handlePagination(1, '');
            }
        });
    }

    function addDeleteButtonListeners() {
        var deleteButton = document.getElementById('delete-button');
        var confirmDeleteButton = document.getElementById('delete-request-btn');

        // Get all the checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Function to update the delete button state based on checkbox selection and status_id value
        function updateDeleteButtonState() {
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Check the status_id value of the selected rows
            var canDelete = Array.from(checkedCheckboxes).every(function (checkbox) {
                var row = checkbox.closest('tr');
                var statusCell = row.querySelector('.counseling-status-cell');
                var status = statusCell.textContent.trim();
                
                return status === 'Pending' || status === 'Rejected';
            });

            deleteButton.disabled = !canDelete || checkedCheckboxes.length === 0;
        }

        // Add event listeners to checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateDeleteButtonState);
        });

        deleteButton.addEventListener('click', function() {
            $("#confirmDeleteModal").modal("show");
        });

        // Add event listener to delete button
        confirmDeleteButton.addEventListener('click', function () {
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Get the request ids of the checked rows
            var appointmentIds = Array.from(checkedCheckboxes).map(function (checkbox) {
                return checkbox.value;
            });

            handleDeleteRequest(appointmentIds);
        });

        // Update delete button state initially
        updateDeleteButtonState();
    }

    function handlePagination(page, searchTerm = '', column = 'counseling_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'transaction_tables/fetch_counseling.php',
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
                    for (var i = 0; i < data.counseling_schedules.length; i++) {
                        var schedules = data.counseling_schedules[i];
                        var row = '<tr>' +
                            '<td class="pe-auto"><input type="checkbox" id="' + schedules.counseling_id + '" name="' + schedules.counseling_id + '" value="' + schedules.counseling_id + '"></td>' +
                            '<td>' + schedules.counseling_id + '</td>' +
                            '<td>' + schedules.appointment_description + '</td>' +
                            // This table data adds a link that opens the description modal if the value is Other

                            // (schedules.appointment_description === 'Other' ?
                            //     '<a href="#" class="other-appointment" data-comment="' + schedules.comments + '">' +
                            //     schedules.appointment_description +
                            //     '</a>' :
                            //     schedules.appointment_description) +
                            '</td>' + 
                            '<td>' + (schedules.scheduled_datetime !== null ? (new Date(schedules.scheduled_datetime)).toLocaleString('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                            }) : 'Not yet scheduled')
                            + '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill counseling-status-cell ' + getStatusBadgeClass(schedules.status_name) + '">' + schedules.status_name + '</span>' +
                            '</td><td>';

                        if (schedules.status_name !== "Cancelled") {
                            row += '<button class="ms-2 btn btn-primary btn-sm pe-auto cancel-request" data-counseling-id="' + schedules.counseling_id + '" >Cancel <i class="fa-solid fa-xmark"></i></button>'
                        }
                        row += '</td></tr>';
                        tableBody.innerHTML += row;
                    }
                } else {
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

    // Function for confirm cancellation modal
    function confirmCancellationModal(counselingId) {
        $("#confirmCancelModal").modal("show");
        var confirmCancelButton = document.getElementById('cancel-request-btn');

        confirmCancelButton.addEventListener('click', function() {
            cancelRequest(counselingId);
        });
    }

    // Click event listener for the cancel button
    document.addEventListener('click', function(event) {
        // Cancel button
        if (event.target.classList.contains('cancel-request')) {
            var counselingId = event.target.getAttribute('data-counseling-id');
            confirmCancellationModal(counselingId);
        }
    });

    // Function for Cancel button
    function cancelRequest(counselingId) {
    // Make an AJAX request to cancel the equipment request
        $.ajax({
            url: 'transaction_tables/cancel_counseling.php',
            method: 'POST',
            data: { counseling_id: counselingId },
            success: function(response) {
                console.log(counselingId);
                console.log('Request canceled successfully');



                handlePagination(1, '', 'request_id', 'desc');
            },
            error: function(error) {
                console.error('Error canceling appointment:', error.responseText);
            }
        });
    }

    // Disables Cancel Button for certain statuses
    function updateCancelButtonStatus() {
        var cancelButtons = document.querySelectorAll('.cancel-request');

        cancelButtons.forEach(function (button) {
            var row = button.closest('tr');
            var statusCell = row.querySelector('.counseling-status-cell');
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
        $('#search-button').click(function() {
            var searchTerm = ($('#search-input').val() + filterStatus()).trim();
            handlePagination(1, searchTerm, 'request_id', 'desc');
        });
    });

    // Add event listener to the table body
    var tableBody = document.getElementById('table-body');
    tableBody.addEventListener('click', function(event) {
        var target = event.target;

        // Check if the clicked element is an "Other" appointment hyperlink
        if (target.tagName === 'A' && target.classList.contains('other-appointment')) {
            event.preventDefault();
            var comment = target.getAttribute('data-comment');

            // Set the comment in the modal body
            var commentModalBody = document.getElementById('viewCommentModal').querySelector('.modal-body');
            commentModalBody.textContent = comment;

            // Show the comment modal
            $('#viewCommentModal').modal('show');
        }
    });

    // Add status value on the search term based on the selected option on status filter dropdown
    function filterStatus() {
        var filterByStatusVal = $('#status-filter-btn').text();
        
        switch (filterByStatusVal) {
            case 'Pending':
                return ' pending';
                break;
            case 'Approved':
                return ' approved';
                break;
            case 'For evaluation':
                return ' for evaluation';
                break;
            case 'Rejected':
                return ' rejected';
                break;
            case 'Cancelled':
                return ' cancelled';
                break;
            default:
                return '';
        }
    }
</script>
