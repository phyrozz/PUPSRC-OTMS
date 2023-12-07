
<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center"></th>
                <th class="text-center appointment-facility-id-header sortable-header" data-column="appointment_id" scope="col" data-order="asc">
                    Request Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-name-header sortable-header" data-column="facility_name" scope="col" data-order="asc">
                    Facility Name
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-number-header sortable-header" data-column="facility_number" scope="col" data-order="asc">
                    Facility Number
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center request-facility-requestor-header sortable-header" data-column="last_name" scope="col" data-order="desc">
                    Requestor
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center request-facility-course-section-header sortable-header" data-column="course" scope="col" data-order="desc">
                    Course and Section
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-student-or-client-header sortable-header" data-column="role" scope="col" data-order="desc">
                    Student/Client
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-start-schedule-header sortable-header" data-column="start_date_time_sched" scope="col" data-order="asc">
                    Start Time Schedule
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-end-schedule-header sortable-header" data-column="end_date_time_sched" scope="col" data-order="asc">
                    End Time Schedule
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-purpose-header sortable-header" data-column="purpose" scope="col" data-order="asc">
                    Purpose
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>

                <th class="text-center appointment-facility-status-header sortable-header" data-column="purpose" scope="col" data-order="asc">
                    Status
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody id="table-body">
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
<!-- View purpose modal -->
<div id="viewPurposeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewPurposeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPurposeModalLabel">Purpose of Appointment</h5>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view purpose modal -->
<!-- Create reason for rejected status modal -->
<div id="createReasonModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createReasonModalLabel">Create Reason</h5>
            </div>
            <div class="modal-body">
                <form id="createReasonForm">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason:</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" maxlength="255"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitReasonBtn">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- End of reason for rejection modal -->
<!-- Modal for displaying reason for cancellation -->
<div class="modal fade" id="viewReasonModal" tabindex="-1" role="dialog" aria-labelledby="viewReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewReasonModalLabel">Reason for Cancellation</h5>
            </div>
            <div class="modal-body">
                <p id="cancellationReasonText" style= "overflow-wrap: break-word;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view reason modal -->
    <br><br><br>

    <div class="container-fluid text-center p-4">
            <h3>Edit Facility</h3>
    </div>
    <hr>
    
<div class="table-responsive">
    <table class="table text-center table-hover table-bordered">
        <thead>
            <tr>
                <th>Facility ID</th>
                <th>Facility Name</th>
                <th>Availability</th>
                <th>Facility Number</th>
                <th>Facility Type ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch the facility data from the database
            $query = "SELECT * FROM facility";
            $result = mysqli_query($connection, $query);

            // Iterate over the rows and display the data in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['facility_id'] . '</td>';
                echo '<td>' . $row['facility_name'] . '</td>';
                echo '<td>' . $row['availability'] . '</td>';
                echo '<td>' . $row['facility_number'] . '</td>';
                echo '<td>' . $row['facility_type_id'] . '</td>';
                echo '<td>' .
                    '<button class="btn btn-primary" onclick="editFacility(' . $row['facility_id'] . ')">' .
                    '<i class="fa fa-edit"></i> Edit' .
                    '</button>' .
                    '</td>';
                echo '</tr>';
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </tbody>
    </table>
</div>


    <!-- Edit Facility Modal -->
    <div class="modal fade" id="editFacilityModal" tabindex="-1" role="dialog" aria-labelledby="editFacilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFacilityModalLabel">Edit Facility Details</h5>

            </div>
            <div class="modal-body">
                <!-- Add your form fields for editing the facility here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
            </div>
        </div>
    </div>

        
    <script>
       function editFacility(facilityId) {
        // Get the modal element
        var modal = document.getElementById('editFacilityModal');

        // Perform the necessary actions to edit the facility with the provided ID
        // For example, make an AJAX request to fetch the facility data and populate the form fields in the modal

        // Make an AJAX request to fetch the facility data
        $.ajax({
            url: 'tables/administrative/fetch_admin_facility.php',
            method: 'POST',
            data: {
                facilityId: facilityId
            },
            success: function(response) {
                // Parse the JSON response
                var data = JSON.parse(response);

                // Populate the form fields in the modal with the fetched facility data
                var modalBody = modal.querySelector('.modal-body');
                modalBody.innerHTML = '';

                // Add your form fields and populate them with the fetched facility data
                modalBody.innerHTML += '<table class="table table-bordered">' +
                    '<tr>' +
                    '<td><label for="facilityName">Facility Name:</label></td>' +
                    '<td><input type="text" id="facilityName" name="facilityName" value="' + data.facilityName + '" class="form-control"></td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><label for="availability">Availability:</label></td>' +
                    '<td>' +
                    '<select id="availability" name="availability" class="form-control">' +
                    '<option value="Available"' + (data.availability === 'Available' ? ' selected' : '') + '>Available</option>' +
                    '<option value="Unavailable"' + (data.availability === 'Unavailable' ? ' selected' : '') + '>Unavailable</option>' +
                    '</select>' +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><label for="facilityNumber">Facility Number:</label></td>' +
                    '<td><input type="text" id="facilityNumber" name="facilityNumber" value="' + data.facilityNumber + '" class="form-control"></td>' +
                    '</tr>' +
                    '</table>';

                // Show the modal
                var bootstrapModal = new bootstrap.Modal(modal);
                bootstrapModal.show();

                // Handle the Save Changes button click event
                var saveChangesBtn = modal.querySelector('.btn-primary');
                saveChangesBtn.addEventListener('click', function() {
                    // Get the updated values from the form fields
                    var updatedFacilityName = document.getElementById('facilityName').value;
                    var updatedAvailability = document.getElementById('availability').value;
                    var updatedFacilityNumber = document.getElementById('facilityNumber').value;

                    // Call the function to update the facility data
                    updateFacilityData(facilityId, updatedFacilityName, updatedAvailability, updatedFacilityNumber);
                });
            },
            error: function() {
                console.log('Error occurred while fetching facility data.');
            }
        });
    }

        function updateFacilityData(facilityId, facilityName, availability, facilityNumber) {
            
        // Make an AJAX request to update the facility data in the database
        $.ajax({
            url: 'tables/administrative/update_admin_facility.php',
            method: 'POST',
            data: {
            facilityId: facilityId,
            facilityName: facilityName,
            availability: availability,
            facilityNumber: facilityNumber
            },
            success: function(response) {
            // Handle the success response
                console.log('Facility updated successfully.');

                // Hide the modal
                var modal = document.getElementById('editFacilityModal');
                var bootstrapModal = bootstrap.Modal.getInstance(modal);
                bootstrapModal.hide();


                // Reload the page to refresh the table
                location.reload();
            },
            error: function() {
            // Handle the error response
            console.log('Error occurred while updating facility.');
            }
        });
    }

    </script>



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

    function handlePagination(page, searchTerm = '', column = 'appointment_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');

        // Make an AJAX request to fetch the equipment requests
        $.ajax({
            url: 'tables/administrative/fetch_facility.php',
            method: 'POST',
            data: {
                page: page,
                searchTerm: searchTerm,
                column: column,
                order: order
            },
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
                    for (var i = 0; i < data.appointment_facility.length; i++) {
                        var appointment = data.appointment_facility[i];

                        var courseSection = appointment.course && appointment.section ? appointment.course + " | " + appointment.section : "Not Applicable";

                        var row = '<tr>' +
                            '<td><input type="checkbox" name="request-checkbox" value="' + appointment.appointment_id + '"></td>' +
                            '<td class="text-center">' + appointment.appointment_id + '</td>' +
                            '<td class="text-center">' + appointment.facility_name + '</td>' +
                            '<td class="text-center">' + appointment.facility_number + '</td>' +
                            '<td class="text-center">' + appointment.last_name + ", " + appointment.first_name + " " + appointment.middle_name + " " + appointment.extension_name + '</td>' +
                            '<td class="text-center">' + courseSection + '</td>' +
                            '<td class="text-center">' + appointment.role + '</td>' +
                            '<td class="text-center">' + new Date(appointment.start_date_time_sched).toLocaleString('en-US', {
                                month: 'long',
                                day: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                            }) + '</td>' +
                            '<td class="text-center">' + new Date(appointment.end_date_time_sched).toLocaleString('en-US', {
                                month: 'long',
                                day: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                            }) + '</td>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<a href="#" class="btn-link" style="text-decoration: none;" onclick="openPurposeModal(\'' + appointment.purpose + '\')">See Purpose</a>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill ' + getStatusBadgeClass(appointment.status_name) + '">' + appointment.status_name + '</span>' +
                            '</td>';
                            
                            if (appointment.status_name === 'Cancelled') {
                                row += '<td class="text-center"><a href="#" class="btn btn-primary btn-sm view-reason" data-status="' + appointment.status_name + '" data-request-id="' + appointment.appointment_id + '"><i class="fa-solid fa-eye"></i> View Reason </a></td>';
                            } else if (appointment.status_name === 'Rejected') {
                                row += '<td class="text-center"><a href="#" class="btn btn-primary btn-sm create-reason" data-status="' + appointment.status_name + '" data-request-id="' + appointment.appointment_id + '"><i class="fa-solid fa-pen-to-square"></i> Create Reason </a></td>';
                            } else {
                                row += '<td></td>';
                            }

                            row += '</tr>';
                            tableBody.innerHTML += row;
                    }
                } else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="12">No Transactions</td></tr>';
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
                // Call the function to disable checkboxes initially
                updateCheckboxStatus();
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
    sortableHeaders.forEach(function(sortableHeader) {
        sortableHeader.addEventListener('click', function() {
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
    handlePagination(1, '', 'appointment_id', 'desc');

    $(document).ready(function() {
        $('#search-button').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'appointment_id', 'desc');
        });

        $('#filterButton').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterStatus(), 'appointment_id', 'desc');
        });


         // Create Reason button click listener
         $(document).on('click', '.create-reason', function(event) {
                var requestId = event.target.getAttribute('data-request-id');
                
                // Set the request ID and office in the modal
                $('#createReasonModal').data('request-id', requestId);
                
                // Show the modal
                $('#createReasonModal').modal('show');
            });

        // Submit Reason button click listener
        $('#submitReasonBtn').on('click', function() {
                var requestId = $('#createReasonModal').data('request-id');
                var reason = $('#reason').val();
                
                // Make an AJAX request to update the purpose in the database
                $.ajax({
                    url: 'tables/administrative/update_create_reason_facility.php', // Your PHP script to handle the update
                    method: 'POST',
                    data: {
                        request_id: requestId,
                        reason: reason
                    },
                    success: function(response) {
                        // Handle success response
                        
                        // Close the modal
                        $('#createReasonModal').modal('hide');
                        
                        // Refresh the table
                        handlePagination(1, '', 'appointment_id', 'desc');
                    },
                    error: function() {
                        // Handle error
                        console.log('Error occurred while updating reason.');
                    }
                });
            });

            $(document).on('click', '.create-reason', function(event) {
            var requestId = event.target.getAttribute('data-request-id');
            var office = event.target.getAttribute('data-office');
            
            // Set the request ID 
            $('#createReasonModal').data('request-id', requestId);
            
            // Fetch the existing purpose and populate the textarea
            $.ajax({
                url: 'tables/administrative/fetch_reason_facility.php', // Your PHP script to fetch the existing purpose
                method: 'POST',
                data: {
                    request_id: requestId
                },
                success: function(response) {
                    // Update the textarea with the existing purpose
                    $('#reason').val(response);
                    
                    // Show the modal
                    $('#createReasonModal').modal('show');
                },
                error: function() {
                    // Handle error
                    console.log('Error occurred while fetching existing purpose.');
                }
            });
        });

        // Update status button listener
        $('#update-status-button').on('click', function() {
            var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
            var requestIds = checkedCheckboxes.map(function() {
                return $(this).val();
            }).get();
            var statusId = $('#update-status').val(); // Get the selected status ID

            $.ajax({
                url: 'tables/administrative/update_appointment_facility.php',
                method: 'POST',
                data: { requestIds: requestIds, statusId: statusId }, // Include the selected status ID in the data
                success: function(response) {
                    // Handle the success response
                    console.log('Status updated successfully');

                    // // Update facility availability if status is "Released"
                    // if (statusId === '5') { // Assuming "Released" status has ID 2
                    //     updateFacilityAvailability(requestIds);
                    // }

                    // Refresh the table after status update
                    handlePagination(1, '', 'appointment_id', 'desc');
                },
                error: function() {
                    // Handle the error response
                    console.log('Error occurred while updating status');
                }
            });

            // function updateFacilityAvailability(requestIds) {
            //     $.ajax({
            //         url: 'tables/administrative/update_facility_availability.php', // Modify the URL accordingly
            //         method: 'POST',
            //         data: { requestIds: requestIds }, // Include relevant data to identify facilities
            //         success: function(response) {
            //             // Handle the success response
            //             console.log('Facility availability updated');
            //             location.reload();
            //         },
            //         error: function() {
            //             // Handle the error response
            //             console.log('Error occurred while updating facility availability');
            //         }
            //     });
            // }

            
        });


        // Checkbox change listener
        $('input[name="request-checkbox"]').on('change', function() {
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
        });

        // Checkbox change listener using event delegation
        $(document).on('change', 'input[name="request-checkbox"]', function() {
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
        });
    });

    //Function to disable checkbox on cancelled status
    function updateCheckboxStatus() {
    var checkboxes = $('input[name="request-checkbox"]');

        checkboxes.each(function() {
            var row = $(this).closest('tr');
            var statusCell = row.find('.rounded-pill');
            var status = statusCell.text().trim().toLowerCase();

            // Disable the checkbox based on specific statuses
            if ( status === 'cancelled') 
            {
                $(this).prop('disabled', true);
            } else {
                $(this).prop('disabled', false);
            }
        });
    }

    // Event Listener for View Reason Button
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('view-reason')) {
            var requestId = event.target.getAttribute('data-request-id');
            openViewReasonModal(requestId);
        }
    });

    // Function to Open View Reason Modal
    function openViewReasonModal(requestId) {
        // Make an AJAX request to fetch the reason for cancellation
        $.ajax({
            url: 'tables/administrative/get_facility_cancel_reason.php',
            method: 'POST',
            data: { request_id: requestId },
            success: function (response) {
                // Update the modal content with the reason for cancellation
                $('#cancellationReasonText').text(response);

                // Open the View Reason modal
                $('#viewReasonModal').modal('show');
            },
            error: function (error) {
                console.error('Error fetching cancellation reason:', error.responseText);
            }
        });
    }

    function filterStatus() {
        var filterByStatusVal = $('#filterByStatus').val();

        switch (filterByStatusVal) {
            case '1':
                return ' pending';
            case '2':
                return ' for receiving';
            case '3':
                return ' for evaluation';
            case '4':
                return ' ready for pickup';
            case '5':
                return ' released';
            case '6':
                return ' rejected';
            case '7':
                return ' cancelled';
            default:
                return '';
        }
    }

    function openPurposeModal(purpose) {
        var modalBody = document.getElementById('viewPurposeModal').querySelector('.modal-body');
        modalBody.innerHTML = purpose;

        $('#viewPurposeModal').modal('show');
    }
</script>
