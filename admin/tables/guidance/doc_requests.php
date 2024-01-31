<?php
// Generate a list of statuses for this table to be rendered on <select> in guidance.php
$statuses = array(
    'all' => 'All',
    '1' => 'Pending',
    '8' => 'Cancelled',
    '2' => 'For Receiving',
    '3' => 'For Evaluation',
    '4' => 'Ready for Pickup',
    '5' => 'Released',
    '6' => 'Rejected'
);
?>
<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center"></th>
                <th class="text-center doc-request-id-header sortable-header" data-column="request_id" scope="col" data-order="desc">
                    Request Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-id-header sortable-header" data-column="request_id" scope="col" data-order="desc">
                    Date requested
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-id-header sortable-header" data-column="scheduled_datetime" scope="col" data-order="desc">
                    Scheduled Date
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
                <th class="text-center doc-request-description-header sortable-header" data-column="request_description" scope="col" data-order="desc">
                    Request
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
                <th class="text-center">
                    Attached files
                </th>
            </tr>
        </thead>
        <tbody id="table-body" class="user-select-none">
            <!-- Table rows will be generated dynamically using JavaScript -->
        </tbody>
    </table>
</div>
<div id="pagination" class="container-fluid p-0 d-flex justify-content-between w-100">
    <div class="d-flex gap-2">
        <div class="input-group">
            <div class="input-group-text">Update Status:</div>
            <select class="form-select" name="update-status" id="update-status" disabled>
                <option value="1">Pending</option>
                <option value="2">For Receiving</option>
                <option value="3">For Evaluation</option>
                <option value="4">Ready for Pickup</option>
                <option value="5">Released</option>
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
<!-- View user details modal -->
<div id="viewUserDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewUserDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserDetailsModalLabel">User Details</h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view user details modal -->
<!-- View user status info modal -->
<div id="statusInfoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusInfoModalLabel">What do these statuses mean?</h5>
            </div>
            <div class="modal-body">
                <div id="reminder-container" class="alert alert-info mt-3" role="alert">
                    <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The requester should settle
                        the deficiency/ies to necessary office.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill bg-secondary">Cancelled</span> - The user has cancelled the request. You must change the status to <b>Rejected</b> after.</small></p> 
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
                <button id="generate-dr-to-pdf-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">No. Generate in .pdf</button>
                <button id="generate-dr-to-csv-btn" type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes. Export to .csv</button>
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
            case 'Cancelled':
                return 'bg-secondary';
            default:
                return 'bg-dark';
        }
    }

    // Function to populate the edit modal with the request details
    function populateUserInfoModal(userId) {
        $.ajax({
            url: 'tables/guidance/get_user_details.php',
            method: 'POST',
            data: { user_id: userId },
            success: function(response) {
                var userDetails = JSON.parse(response);
                var modalTitle = document.getElementById('viewUserDetailsModalLabel');
                var modalBody = document.querySelector('#viewUserDetailsModal .modal-body');

                modalTitle.innerText = 'User details';

                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-6">
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Name</strong></p>
                                <p class="mx-2">${userDetails.last_name + ", " + userDetails.first_name + " " + userDetails.middle_name + " " + userDetails.extension_name}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Student/Guest</strong></p>
                                <p class="mx-2">${userDetails.user_role_id == 1 ? "Student" : "Guest"}</p>
                            </div>
                            <div class="m-0" style="display: ${userDetails.course == 'N/A' ? "none" : "block"};">
                                <p class="fs-5 m-0"><strong>Student Number</strong></p>
                                <p class="mx-2">${userDetails.student_no}</p>
                            </div>
                            <div class="m-0" style="display: ${userDetails.course == 'N/A' ? "none" : "block"};">
                                <p class="fs-5 m-0"><strong>Course</strong></p>
                                <p class="mx-2">${userDetails.course}</p>
                            </div>
                            <div class="m-0" style="display: ${userDetails.course == 'N/A' ? "none" : "block"};">
                                <p class="fs-5 m-0"><strong>Year and Section</strong></p>
                                <p class="mx-2">${userDetails.year_and_section == "" || null ? 'N/A' : userDetails.year_and_section}</p>
                            </div>
                            </div>
                        <div class="col-6">
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Sex</strong></p>
                                <p class="mx-2">${userDetails.sex == 1 ? "Male" : "Female"}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Email</strong></p>
                                <p class="mx-2">${userDetails.email}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Contact Number</strong></p>
                                <p class="mx-2">${userDetails.contact_no}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Birth Date</strong></p>
                                <p class="mx-2">${userDetails.formatted_birth_date}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Address</strong></p>
                                <p class="mx-2 py-0 my-0">${userDetails.home_address}</p>
                                <p class="mx-2 py-0 my-0">${userDetails.barangay + ", " + userDetails.city}</p>
                                <p class="mx-2 py-0 my-0">${userDetails.province + (userDetails.zip_code ? ", " + userDetails.zip_code : "")}</p>
                            </div>
                        </div>
                    </div>
                `;

                $("#viewUserDetailsModal").modal("show");
            },
            error: function() {
                console.log('Error occurred while fetching request details.');
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
            url: 'tables/guidance/fetch_doc_requests.php',
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

                        var row = '<tr class="clickable-row">' +
                            '<td><input type="checkbox" name="request-checkbox" value="' + request.request_id + '"></td>' +
                            '<td>' + request.request_id + '</td>' +
                            '<td>' + request.formatted_request_id + '</td>' +
                            '<td>' + (request.formatted_scheduled_datetime !== null ? request.formatted_scheduled_datetime : 'Not yet scheduled') + '</td>' +
                            '<td><a href="#" class="user-details-link" data-user-id="' + request.user_id + '">' + request.last_name + ", " + request.first_name + " " + request.middle_name + " " + request.extension_name + '</a></td>' +
                            '<td>' + request.role + '</td>' +
                            '<td>' + request.request_description + '</td>' +
                            '<td>' + '₱' + request.amount_to_pay + '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill ' + getStatusBadgeClass(request.status_name) + '">' + request.status_name + '</span>' +
                            '</td>' +
                            '<td>' + (request.attached_files ? '<a href="' + request.attached_files + '" target="_blank">View Attachment</a>' : "No attachment") + '</td>' +
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }
                else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="10">No Transactions</td></tr>';
                    tableBody.innerHTML = noRecordsRow;
                }

                // Update the pagination links
                var paginationLinks = document.getElementById('pagination-links');
                paginationLinks.innerHTML = '';

                if (data.total_pages > 1) {
                    for (var i = 1; i <= data.total_pages; i++) {
                        var pageLink = '<li class="page-item">' +
                        '<a class="page-link ' + (i == data.current_page ? 'btn-primary text-light' : 'btn-outline-primary') + '" href="#" onclick="handlePagination(' + i + ', \'' + searchTerm + '\', \'request_id\', \'desc\')">' + i + '</a>' +
                        '</li>';
                        paginationLinks.innerHTML += pageLink;
                    }
                }

                $('.user-details-link').on('click', function(event) {
                    var userId = event.target.getAttribute('data-user-id');
                    populateUserInfoModal(userId);
                });

                // Add event listener for row clicks
                var rows = document.querySelectorAll('.clickable-row');
                rows.forEach(function (row) {
                    row.addEventListener('click', function (event) {
                        var checkbox = row.querySelector('input[name="request-checkbox"]');
                        checkbox.checked = !checkbox.checked;
                        handleCheckboxChange(); // Update the checkbox status
                    });
                });
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
    handlePagination(1, '', 'request_id', 'desc');

    $(document).ready(function() {
        $('#search-input').on('input', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterDocType() + filterStatus(), 'request_id', 'desc');
        });

        $('#search-button').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterDocType() + filterStatus(), 'request_id', 'desc');
        });

        $('#filterButton').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterDocType() + filterStatus(), 'request_id', 'desc');
        });

        // Update status button listener
        $('#update-status-button').on('click', function() {
            var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
            var numSelectedStatuses = checkedCheckboxes.length;
            
            // Update the message in the confirmation modal
            $('#confirmStatusUpdateModal .modal-body').html('<p>Are you sure you want to update ' + numSelectedStatuses + ' status(es)?</p>');

            // Show the confirmation modal
            $('#confirmStatusUpdateModal').modal('show');
        });

        $('#confirm-update-btn').on('click', function() {
            // Get the selected status ID
            var statusId = $('#update-status').val();

            // Get the IDs of selected requests
            var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
            var requestIds = checkedCheckboxes.map(function() {
                return $(this).val();
            }).get();

            $.ajax({
                url: 'tables/guidance/update_doc_requests.php',
                method: 'POST',
                data: { requestIds: requestIds, statusId: statusId },
                success: function(response) {
                    // Refresh the table after status update
                    handlePagination(1, '', 'request_id', 'desc');
                },
                error: function() {
                    console.log('Error occurred while updating status');
                }
            });

            // Close the confirmation modal
            $('#confirmStatusUpdateModal').modal('hide');
        });

        // Checkbox change listener using event delegation
        $(document).on('change', 'input[name="request-checkbox"]', handleCheckboxChange);

        $('#status-info-btn').on('click', function() {
            $('#statusInfoModal').modal('show');
        });
    });

    // Add event listener for checkbox clicks
    $(document).on('click', 'input[name="request-checkbox"]', function(event) {
        // Toggle the checkbox state when the checkbox is clicked directly
        var checkbox = $(event.target);
        checkbox.prop('checked', !checkbox.prop('checked'));
        handleCheckboxChange(); // Update the checkbox status
    });

    // Add event listener for row clicks
    var rows = document.querySelectorAll('.clickable-row');
    rows.forEach(function (row) {
        row.addEventListener('click', function (event) {
            var checkbox = row.querySelector('input[name="request-checkbox"]');
            checkbox.checked = !checkbox.checked;
            handleCheckboxChange(); // Update the checkbox status
        });
    });

    function handleCheckboxChange() {
        var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
        var updateButton = $('#update-status-button');
        var statusDropdown = $('#update-status');

        if (checkedCheckboxes.length > 0) {
            updateButton.prop('disabled', false);
            statusDropdown.prop('disabled', false);
        } else {
            updateButton.prop('disabled', true);
            statusDropdown.prop('disabled', true);
        }
    }

    // Perform search functionality when either the Filter or Search button is pressed
    function filterDocType() {
        var filterByDocTypeVal = $('#filterByDocType').val();
        
        switch (filterByDocTypeVal) {
            case 'goodMoral':
                return ' request good moral document';
                break;
            case 'clearance':
                return ' request clearance';
                break;
            default:
                return '';
        }
    }

    function filterStatus() {
        var filterByStatusVal = $('#filterByStatus').val();
        
        switch (filterByStatusVal) {
            case '1':
                return ' pending';
                break;
            case '2':
                return ' for receiving';
                break;
            case '3':
                return ' for evaluation';
                break;
            case '4':
                return ' ready for pickup';
                break;
            case '5':
                return ' released';
                break;
            case '6':
                return ' rejected';
                break;
            case '8':
                return ' cancelled';
                break;
            default:
                return '';
        }
    }
</script>
