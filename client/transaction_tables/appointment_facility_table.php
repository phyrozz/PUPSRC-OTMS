<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
            <th class="text-center"></th>
                <th class="text-center appointment-facility-id-header sortable-header" data-column="1" scope="col" data-order="asc">
                    Request Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-name-header sortable-header" data-column="2" scope="col" data-order="asc">
                    Facility Name
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-number-header sortable-header" data-column="3" scope="col" data-order="asc">
                    Facility Number
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-client-header sortable-header" data-column="4" scope="client" data-order="asc">
                    Client
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <!-- <th class="text-center doc-request-schedule-header sortable-header" data-column="4" scope="col" data-order="asc">
                    Schedule
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th> -->
                <th class="text-center appointment-facility-start-schedule-header sortable-header" data-column="5" scope="col" data-order="asc">
                    Start Time Schedule
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-end-schedule-header sortable-header" data-column="6" scope="col" data-order="asc">
                    End Time Schedule
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-status-header sortable-header" data-column="7" scope="col" data-order="asc">
                    Status
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center appointment-facility-attachment-header sortable-header" data-column="9" scope="letter_content" data-order="asc">
                    Attachment
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <!-- <th class="text-center doc-request-status-header" scope="col">
                    Generate Slip
                </th> -->
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
                <h5 class="modal-title" id="viewEditModalLabel">Edit appointment</h5>
            </div>
            <div class="modal-body">
                <!-- Please add edit fields here for the Request description (either Request Clearance or Request Good Moral Document) and Scheduled Date using Flatpickr. -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view edit modal -->
<!-- Reason Modal -->
<div id="reasonModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reasonModalLabel">Reason for Rejection</h5>
            </div>
            <div class="modal-body">
                <!-- Reason content will be populated here dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Reason Modal -->

<!-- Modal for cancellation confirmation -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Cancel Appointment</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this appointment?</p>
                <form id="createReasonForm">
                    <div class="mb-3">
                        <label for="cancellationReason" class="form-label">Reason for cancellation:</label>
                        <textarea class="form-control" id="cancellationReason" name="cancellationReason" rows="3" maxlength="255"></textarea>
                        <small id="cancellationReasonHelp" class="form-text text-muted">Maximum length: 255 characters.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmCancelBtn">Confirm Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--End of Cancel Modal -->
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
            case 'Cancelled':
                return 'bg-secondary';
            default:
                return 'bg-dark';
        }
    }

    function handleDeleteRequest(appointmentIds) {
        // Make an AJAX request to delete the facility appointment
        $.ajax({
            url: 'transaction_tables/delete_facility.php',
            method: 'POST',
            data: { appointment_id: appointmentIds },
            success: function(response) {
                console.log(appointmentIds);
                console.log('Appointment deleted successfully');
                
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
                var statusCell = row.querySelector('.appointment-facility-status-cell');
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
            var appointmentIds = Array.from(checkedCheckboxes).map(function (checkbox) {
                return checkbox.value;
            });

            if (confirm('Are you sure you want to delete the selected appointment(s)?')) {
                handleDeleteRequest(appointmentIds);
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
        url: 'transaction_tables/get_appointment_facility.php',
        method: 'POST',
        data: { edit_id: editId },
        success: function(response) {
            var request = JSON.parse(response);
            var modalTitle = document.getElementById('viewEditModalLabel');
            var modalBody = document.querySelector('#viewEditModal .modal-body');

            modalTitle.innerText = 'Edit Appointment';

            modalBody.innerHTML = `
            <form id="editForm" action="" method="POST">
                <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="facility" class="form-label">Facility</label>
                                <select class="form-control" name="facility" id="facility" required>
                                    <option value="">--Select--</option>
                                    <?php
                                    $query = "SELECT facility_id, facility_name FROM facility WHERE availability = 'Available'";
                                    $result = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $facilityId = $row['facility_id'];
                                        $facilityName = $row['facility_name'];

                                        echo "<option value='$facilityId'>$facilityName</option>";
                                    }

                                    mysqli_free_result($result);
                                    ?>
                                </select>
                            </div>
                        </div>
        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="client" class="form-label">Client Type</label>
                                <select class="form-control" name="client" id="client" required>
                                    <option value="">--Select--</option>
                                    <option value="Alumni">Alumni</option>
                                    <option value="Organization">Organization</option>
                                    <option value="Visitor">Visitor</option>
                                    <option value="Guest">Guest</option>

                                </select>
                            </div>
                        </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Scheduled Date Requested</label>
                            <input type="text" class="form-control" id="startDate" name="startDate" placeholder="--Select Date--" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="endDate" class="form-label">Scheduled Date Ended</label>
                            <input type="text" class="form-control" id="endDate" name="endDate" placeholder="--Select Date--" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="startTime" class="form-label">Scheduled Time Requested</label>
                            <select class="form-control" id="startTime" name="startTime" required>
                                <option value="">--Select--</option>
                                <option value="08:00:00">8:00 AM</option>
                                <option value="08:30:00">8:30 AM</option>
                                <option value="09:00:00">9:00 AM</option>
                                <option value="09:30:00">9:30 AM</option>
                                <option value="10:00:00">10:00 AM</option>
                                <option value="10:30:00">10:30 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="11:30:00">11:30 AM</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="12:30:00">12:30 PM</option>
                                <option value="13:00:00">1:00 PM</option>
                                <option value="13:30:00">1:30 PM</option>
                                <option value="14:00:00">2:00 PM</option>
                                <option value="14:30:00">2:30 PM</option>
                                <option value="15:00:00">3:00 PM</option>
                                <option value="15:30:00">3:30 PM</option>
                                <option value="16:00:00">4:00 PM</option>
                                <option value="16:30:00">4:30 PM</option>
                                <option value="17:00:00">5:00 PM</option>
                                <option value="17:30:00">5:30 PM</option>
                                <option value="18:00:00">6:00 PM</option>
                                <option value="18:30:00">6:30 PM</option>
                                <option value="19:00:00">7:00 PM</option>
                                <option value="19:30:00">7:30 PM</option>
                                <option value="20:00:00">8:00 PM</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="endTime" class="form-label">Scheduled Time Ended</label>
                            <select class="form-control" id="endTime" name="endTime" required>
                                <option value="">--Select--</option>
                                <option value="08:00:00">8:00 AM</option>
                                <option value="08:30:00">8:30 AM</option>
                                <option value="09:00:00">9:00 AM</option>
                                <option value="09:30:00">9:30 AM</option>
                                <option value="10:00:00">10:00 AM</option>
                                <option value="10:30:00">10:30 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="11:30:00">11:30 AM</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="12:30:00">12:30 PM</option>
                                <option value="13:00:00">1:00 PM</option>
                                <option value="13:30:00">1:30 PM</option>
                                <option value="14:00:00">2:00 PM</option>
                                <option value="14:30:00">2:30 PM</option>
                                <option value="15:00:00">3:00 PM</option>
                                <option value="15:30:00">3:30 PM</option>
                                <option value="16:00:00">4:00 PM</option>
                                <option value="16:30:00">4:30 PM</option>
                                <option value="17:00:00">5:00 PM</option>
                                <option value="17:30:00">5:30 PM</option>
                                <option value="18:00:00">6:00 PM</option>
                                <option value="18:30:00">6:30 PM</option>
                                <option value="19:00:00">7:00 PM</option>
                                <option value="19:30:00">7:30 PM</option>
                                <option value="20:00:00">8:00 PM</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
            `;

            flatpickr('#startDate', {
                readonly: false,
                allowInput: true,
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
                onChange: function(selectedDates, dateStr, instance) {
                    var currentDate = new Date();
                    var selectedDate = selectedDates[0];
                    var timeSelect = document.getElementById("startTime");

                    if (selectedDate.toDateString() === currentDate.toDateString()) {
                        // Reset the selected time value when the date is changed to today
                        timeSelect.value = '';

                        // Enable all options in the time select for today's date
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            timeSelect.options[i].disabled = false;
                        }

                        // Disable past times in the time select based on the current time
                        var currentHour = currentDate.getHours();
                        var currentMinute = currentDate.getMinutes();
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            var timeValue = timeSelect.options[i].value.split(":");
                            var optionHour = parseInt(timeValue[0]);
                            var optionMinute = parseInt(timeValue[1]);
                            if (optionHour < currentHour || (optionHour === currentHour && optionMinute <= currentMinute)) {
                                timeSelect.options[i].disabled = true;
                            }
                        }
                    } else {
                        // Enable all options in the time select for other dates
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            timeSelect.options[i].disabled = false;
                        }
                    }

                updateEndTimeOptions();
                handleDateTimeChangeError();
                if (selectedDates.length > 0) {
                endDatePicker.set("minDate", selectedDates[0]);
                }
                
                }
        });

        var endDatePicker = flatpickr("#endDate", {
            readOnly: false,
            allowInput: true,
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
            onChange: function(selectedDates, dateStr, instance) {
                updateEndTimeOptions();
                handleDateTimeChangeError();
            }
        });

        // Get the date requested and date ended input elements
        const startDateInput = document.getElementById("startDate");
        const endDateInput = document.getElementById("endDate");

        // Get the time requested and time ended input elements
        const startTimeInput = document.getElementById("startTime");
        const endTimeInput = document.getElementById("endTime");

        // Function to update the options in the time ended dropdown based on selected dates
        function updateEndTimeOptions() {
            const startDateValue = startDateInput.value;
            const endDateValue = endDateInput.value;
            const startTimeValue = startTimeInput.value;
            const endTimeValue = endTimeInput.value;

            if (startDateValue === endDateValue) {
                // Loop through the options in the time ended dropdown
                for (let i = 0; i < endTimeInput.options.length; i++) {
                    const option = endTimeInput.options[i];
                    // Disable the option if its value is less than or equal to the selected time
                    option.disabled = option.value <= startTimeValue;
                }
            } else {
                // Enable all options in the time ended dropdown
                for (let i = 0; i < endTimeInput.options.length; i++) {
                    endTimeInput.options[i].disabled = false;
                }
            }
        }
        // Function to handle date and time change errors
        function handleDateTimeChangeError() {
        const startDateValue = startDateInput.value;
        const endDateValue = endDateInput.value;
        const startTimeValue = startTimeInput.value;
        const endTimeValue = endTimeInput.value;

        if (startDateValue > endDateValue) {
            // Throw an error and reset the date ended to an empty value
            endDateInput.setCustomValidity("");
        } else {
            // Clear any previous error messages
            endDateInput.setCustomValidity("");
        }

        if (startDateValue === endDateValue && startTimeValue >= endTimeValue) {
            // Reset the time ended to an empty value (without showing an error)
            endTimeInput.value = "";
        }
        }

        // Add event listener to the date requested input element
        startDateInput.addEventListener("change", function() {
            updateEndTimeOptions();
            handleDateTimeChangeError();
        });

        // Add event listener to the time requested input element
        startTimeInput.addEventListener("change", function() {
            updateEndTimeOptions();
            handleDateTimeChangeError();
        });

        // Add event listener to the date ended input element
        endDateInput.addEventListener("change", function() {
            updateEndTimeOptions();
            handleDateTimeChangeError();
        });


            
    
        
        
        
        var editForm = document.getElementById('editForm');
                editForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    updateRequest(editId);
            });

                $("#viewEditModal").modal("show");
            },
            error: function() {
                console.log('Error occurred while fetching appointment details.');
            }
        });
    }

    // Event listener for view reason buttons
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('view-reason')) {
            var requestId = event.target.getAttribute('data-request-id');
            populateReasonModal(requestId);
        }
    });


    // Function to populate the reason modal with the reason data
    function populateReasonModal(requestId) {
        $.ajax({
            url: 'transaction_tables/get_administrative_reason_facility.php', // Replace with the actual URL to fetch reason from the database
            method: 'POST',
            data: { request_id: requestId },
            success: function(response) {
                var reasonData = JSON.parse(response); // Parse the JSON response
                var reason = reasonData.admin_reason; // Extract the reason text
                console.log(reason);
                console.log('Reason Shows successfully');
                
                var modalTitle = document.getElementById('reasonModalLabel');
                var modalBody = document.querySelector('#reasonModal .modal-body');

                modalTitle.innerText = 'Reason for Rejection';

                if (reason !== null) {
                    modalBody.innerHTML = '<p style= "overflow-wrap: break-word;">' + reason + '</p>';
                } else {
                    modalBody.innerHTML = '<p>No reason provided yet.</p>';
                }

                $("#reasonModal").modal("show");
            },
            error: function() {
                console.log('Error occurred while fetching reason.');
            }
        });
    }

    // Function to update the request using AJAX
    function updateRequest(editId) {
        var form = document.getElementById('editForm');
        var formData = new FormData(form);

        formData.append('edit_id', editId);

        $.ajax({
            url: 'transaction_tables/update_appointment_facility.php',
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

    function handlePagination(page, searchTerm = '', column = 'appointment_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the equipment requests
        $.ajax({
            url: 'transaction_tables/fetch_facility_table.php',
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
                    for (var i = 0; i < data.appointment_facility.length; i++) {
                        var appointmentFacility = data.appointment_facility[i];

                        var row = '<tr>' +
                            '<td><input type="checkbox" id="' + appointmentFacility.appointment_id + '" name="' + appointmentFacility.appointment_id + '" value="' + appointmentFacility.appointment_id + '"></td>' +
                            '<td class="text-center">' + appointmentFacility.appointment_id + '</td>' +
                            '<td class="text-center">' +  appointmentFacility.facility_name + '</td>' +
                            '<td class="text-center">' +  appointmentFacility.facility_number + '</td>' +
                            '<td class="text-center">' +  appointmentFacility.client + '</td>' +
                            '<td class="text-center">' + new Date(appointmentFacility.start_date_time_sched).toLocaleString('en-US', { 
                                month: 'long',
                                day: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                                }) + '</td>' +
                           
            
                            '<td class="text-center">' + new Date(appointmentFacility.end_date_time_sched).toLocaleString('en-US', { 
                                month: 'long',
                                day: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                                }) + '</td>' +
                            // '<td class="text-center">' +
                            // scheduleButton +
                            // '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill appointment-facility-status-cell ' + getStatusBadgeClass(appointmentFacility.status_name) + '">' + appointmentFacility.status_name + '</span>' +
                            '</td>' +
                            '<td class="text-center"><a href="' + (appointmentFacility.letter_content ? "../../../client/administrative/appointment-letter/" + appointmentFacility.letter_content : "") + '" target="_blank">' + (appointmentFacility.letter_content ? "View Letter" : "") + '</a></td>' + 
                            '<td class="text-center">';

                            if (appointmentFacility.status_name === "Pending") {
                                row += '<div class="btn-container" style="display: flex;">';
                                
                                // Edit Button
                                row += '<div style="flex: 1;">';
                                row += '<button href="#" class="btn btn-primary btn-sm edit-request" data-request-id="' + appointmentFacility.appointment_id + '"><i class="fa-solid fa-pen-to-square"></i> Edit </button>';
                                row += '</div>';
                                
                                // Cancel Button
                                row += '<div style="flex: 1; margin-left: 5px;">';
                                row += '<button class="btn btn-primary btn-sm cancel-request" data-request-id="' + appointmentFacility.appointment_id + '"><i class="fa-solid fa-times"></i> Cancel </button>';
                                row += '</div>';
                                
                                row += '</div>';
                            } else if(appointmentFacility.status_name === "Rejected") {
                                row += '<a href="#" class="btn btn-primary btn-sm view-reason pe-auto" data-status="' + appointmentFacility.status_name + '" data-request-id="' +  appointmentFacility.appointment_id + '"><i class="fa-solid fa-eye"></i> Reason </a>';
                            }
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }  else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="10">No Transactions</td></tr>';
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
                // Add event listeners for edit buttons
                updateEditButtonStatus();
                //Checks for request status and hides cancelled button
                updateCancelButtonStatus();
            }
        });
    }

    function updateEditButtonStatus() {
        var editButtons = document.querySelectorAll('.edit-request');

        editButtons.forEach(function (button) {
            var row = button.closest('tr');
            var statusCell = row.querySelector('.appointment-facility-status-cell');
            var status = statusCell.textContent.trim();

            // Disable the Edit button if the status is "Rejected"
            if (status === 'Rejected' || status ===  'For Evaluation' || status === 'Ready for Pickup' || status === 'Released') {
                button.disabled = true;
            } else {
                button.disabled = false;
            }
        });
    }

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('edit-request') && !event.target.disabled) {
            var editId = event.target.getAttribute('data-request-id');
            populateEditModal(editId);
        }
    });

        //Event Listener for Cancel Button
        document.addEventListener('click', function(event) {
        if (event.target.classList.contains('cancel-request')) {
            var requestId = event.target.getAttribute('data-request-id');
            openCancelModal(requestId);
        }
    });

    function openCancelModal(requestId) {
        // Set the request ID in the modal data attribute
        $('#cancelModal').data('request-id', requestId);
        // Open the modal
        $('#cancelModal').modal('show');
    }
    
    // Event Listener for Confirm Cancel Button
    document.getElementById('confirmCancelBtn').addEventListener('click', cancelRequest);


    //Function for Cancel button
    function cancelRequest() {
        console.log('cancelRequest function called');
    var requestId = $('#cancelModal').data('request-id');
    var cancellationReason = $('#cancellationReason').val();

    // Make an AJAX request to cancel the equipment request
    $.ajax({
        url: 'transaction_tables/cancel_facility.php',
        method: 'POST',
        data: { request_id: requestId, reason: cancellationReason },
        success: function(response) {
            console.log('Request canceled successfully');
            // Close the modal
            $('#cancelModal').modal('hide');
            handlePagination(1, '');
        },
        error: function(error) {
            console.error('Error canceling request:', error.responseText);
        }
    });
}

    //Disables Cancel Button for certain statuses
    function updateCancelButtonStatus() {
    var cancelButtons = document.querySelectorAll('.cancel-request');

    cancelButtons.forEach(function (button) {
        var row = button.closest('tr');
        var statusCell = row.querySelector('.appointment-facility-status-cell');
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
    handlePagination(1, '', 'appointment_id', 'desc');

    $(document).ready(function() {
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'appointment_id', 'desc');
        });
    });
</script>
