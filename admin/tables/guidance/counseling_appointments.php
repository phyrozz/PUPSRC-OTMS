<?php
// Generate a list of statuses for this table to be rendered on <select> in guidance.php
$statuses = array(
    'all' => 'All',
    '1' => 'Pending',
    '8' => 'Cancelled',
    '3' => 'For Evaluation',
    '7' => 'Approved',
    '6' => 'Rejected'
);
?>
<table id="transactions-table" class="table table-hover hidden">
    <thead>
        <tr class="table-active">
            <th class="text-center"></th>
            <th class="text-center doc-request-id-header sortable-header" data-column="counseling_id" scope="col" data-order="desc">
                Schedule Code
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center doc-request-id-header sortable-header" data-column="counseling_id" scope="col" data-order="desc">
                Date requested
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center doc-request-requestor-header sortable-header" data-column="last_name" scope="col" data-order="desc">
                Requestor
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center doc-request-student-or-client-header sortable-header" data-column="role" scope="col" data-order="desc">
                Student/Guest
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
        </tr>
    </thead>
    <tbody id="table-body" class="user-select-none">
        <!-- Table rows will be generated dynamically using JavaScript -->
    </tbody>
</table>
<div id="pagination" class="container-fluid p-0 d-flex justify-content-between w-100">
    <div class="d-flex gap-2">
        <div class="input-group">
            <div class="input-group-text">Update Status:</div>
            <select class="form-select" name="update-status" id="update-status" disabled>
                <option value="1">Pending</option>
                <option value="3">For Evaluation</option>
                <option value="7">Approved</option>
                <option value="6">Rejected</option>
            </select>
        </div>
        <div>
            <a href="#" id="status-info-btn">What do these statuses mean?</a>
        </div>
        <button id="update-status-button" class="btn btn-primary w-50" disabled><i class="fa-solid fa-pen-to-square"></i> Update</button>
    </div> 
    <nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be generated dynamically using JavaScript -->
            </ul>
        </div>
    </nav>
</div>
<!-- View comment modal -->
<div id="viewCommentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewCommentModalLabel" aria-hidden="true">
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
</div>
<!-- End of view comment modal -->
<!-- View user status info modal -->
<div id="statusInfoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusInfoModalLabel">What do these statuses mean?</h5>
            </div>
            <div class="modal-body">
                <div id="reminder-container" class="alert alert-info mt-3" role="alert">
                    <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The appointment is under review by the office.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill bg-secondary">Cancelled</span> - The user has cancelled the request. You must change the status to <b>Rejected</b> after.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill bg-danger">Rejected</span> - The appointment is rejected
                        by the office.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: blue;">For
                            evaluation</span> - Additional requirements or appointment purpose is under review by the office.</small>
                    </p>
                    <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: green;">Approved</span> -
                        The appointment is approved and the requestor must proceed to the Guidance Office.</small></p>
                    <!-- <p class="mb-0">You will find answers to the questions we get asked the most about requesting for academic documents through <a href="FAQ.php">FAQs</a>.</p> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view status info modal -->
<!-- Confirm generate modal -->
<div id="confirmGenerateReportModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmGenerateReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmGenerateReportModalLabel">Confirm generate</h5>
            </div>
            <div class="modal-body">
                <p>You will be generating a report in .pdf document format. Do you want to export your report in .csv?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- "dr" stands for document request -->
                <button id="generate-gc-to-pdf-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">No. Generate in .pdf</button>
                <button id="generate-gc-to-csv-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes. Export to .csv</button>
            </div>
        </div>
    </div>
</div>
<!-- End of confirm generate modal -->
<!-- Confirm status update modal -->
<div id="confirmStatusUpdateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmStatusUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmStatusUpdateModalLabel">Confirm Update</h5>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="confirm-update-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- End of confirm status update modal -->
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

    function handlePagination(page, searchTerm = '', column = 'counseling_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'tables/guidance/fetch_counseling.php',
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

                        // Convert the timestamp int value of request_id into a formatted datetime for the Date Requested column
                        var timestamp = schedules.counseling_id;
                        parsedTimestamp = parseInt(timestamp.substring(3));
                        var date = new Date(parsedTimestamp * 1000);
                        var formattedDate = date.toLocaleString();

                        var row = '<tr class="clickable-row">' +
                            '<td><input type="checkbox" name="counseling-checkbox" value="' + schedules.counseling_id + '"></td>' +
                            '<td>' + schedules.counseling_id + '</td>' +
                            '<td>' + formattedDate + '</td>' +
                            '<td>' + schedules.last_name + ", " + schedules.first_name + " " + schedules.middle_name + " " + schedules.extension_name + '</td>' +
                            '<td>' + schedules.role + '</td>' +
                            '<td>' +
                            (schedules.appointment_description === 'Other' ?
                                '<a href="#" class="other-appointment" data-comment="' + schedules.comments + '">' +
                                schedules.appointment_description +
                                '</a>' :
                                schedules.appointment_description) +
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
                            '<span class="badge rounded-pill ' + getStatusBadgeClass(schedules.status_name) + '">' + schedules.status_name + '</span>' +
                            '</td>' +
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                } else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="7">No Transactions</td></tr>';
                    tableBody.innerHTML = noRecordsRow;
                }

                // Add event listener for row clicks
                var rows = document.querySelectorAll('.clickable-row');
                rows.forEach(function (row) {
                    row.addEventListener('click', function (event) {
                        var checkbox = row.querySelector('input[name="counseling-checkbox"]');
                        checkbox.checked = !checkbox.checked;
                        handleCheckboxChange(); // Update the checkbox status
                    });
                });

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
    handlePagination(1, '', 'counseling_id', 'desc');

    $(document).ready(function() {
        $('#search-button').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterStatus(), 'counseling_id', 'desc');
        });

        $('#filterButton').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterStatus(), 'counseling_id', 'desc');
        });

        // Update status button listener
        $('#update-status-button').on('click', function() {
            var checkedCheckboxes = $('input[name="counseling-checkbox"]:checked');
            var numSelectedStatuses = checkedCheckboxes.length;
            
            // Update the message in the confirmation modal
            $('#confirmStatusUpdateModal .modal-body').html('<p>Are you sure you want to update ' + numSelectedStatuses + ' status(es)?</p>');

            // Show the confirmation modal
            $('#confirmStatusUpdateModal').modal('show');
            // var counselingIds = checkedCheckboxes.map(function() {
            //     return $(this).val();
            // }).get();
            // var statusId = $('#update-status').val(); // Get the selected status ID

            // $.ajax({
            //     url: 'tables/guidance/update_counseling.php',
            //     method: 'POST',
            //     data: { counselingIds: counselingIds, statusId: statusId }, // Include the selected status ID in the data
            //     success: function(response) {
            //         // Handle the success response
            //         console.log('Status updated successfully');

            //         // Refresh the table after status update
            //         handlePagination(1, '', 'counseling_id', 'desc');
            //     },
            //     error: function() {
            //         // Handle the error response
            //         console.log('Error occurred while updating status');
            //     }
            // });
        });

        $('#confirm-update-btn').on('click', function() {
            var checkedCheckboxes = $('input[name="counseling-checkbox"]:checked');
            var counselingIds = checkedCheckboxes.map(function() {
                return $(this).val();
            }).get();
            var statusId = $('#update-status').val(); // Get the selected status ID

            $.ajax({
                url: 'tables/guidance/update_counseling.php',
                method: 'POST',
                data: { counselingIds: counselingIds, statusId: statusId }, // Include the selected status ID in the data
                success: function(response) {
                    // Handle the success response
                    console.log('Status updated successfully');

                    // Refresh the table after status update
                    handlePagination(1, '', 'counseling_id', 'desc');
                },
                error: function() {
                    // Handle the error response
                    console.log('Error occurred while updating status');
                }
            });

            // Close the confirmation modal
            $('#confirmStatusUpdateModal').modal('hide');
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

        // Checkbox change listener using event delegation
        $(document).on('change', 'input[name="counseling-checkbox"]', handleCheckboxChange);

        $('#status-info-btn').on('click', function() {
            $('#statusInfoModal').modal('show');
        });
    });

    // Add event listener for checkbox clicks
    $(document).on('click', 'input[name="counseling-checkbox"]', function(event) {
        // Toggle the checkbox state when the checkbox is clicked directly
        var checkbox = $(event.target);
        checkbox.prop('checked', !checkbox.prop('checked'));
        handleCheckboxChange(); // Update the checkbox status
    });

    // Add event listener for row clicks
    var rows = document.querySelectorAll('.clickable-row');
    rows.forEach(function (row) {
        row.addEventListener('click', function (event) {
            var checkbox = row.querySelector('input[name="counseling-checkbox"]');
            checkbox.checked = !checkbox.checked;
            handleCheckboxChange(); // Update the checkbox status
        });
    });

    function handleCheckboxChange() {
        var checkedCheckboxes = $('input[name="counseling-checkbox"]:checked');
        var updateButton = $('#update-status-button');
        var statusDropdown = $('#update-status');

        if (checkedCheckboxes.length > 0) {
            updateButton.prop('disabled', false);
            statusDropdown.prop('disabled', false);
        }
        else {
            updateButton.prop('disabled', true);
            statusDropdown.prop('disabled', true);
        }
    }

    // Perform search functionality when either the Filter or Search button is pressed
    function filterStatus() {
        var filterByStatusVal = $('#filterByStatus').val();
        
        switch (filterByStatusVal) {
            case '1':
                return ' pending';
                break;
            case '3':
                return ' for evaluation';
                break;
            case '6':
                return ' rejected';
                break;
            case '7':
                return ' approved';
                break;
            case '8':
                return ' cancelled';
                break;
            default:
                return '';
        }
    }
</script>
