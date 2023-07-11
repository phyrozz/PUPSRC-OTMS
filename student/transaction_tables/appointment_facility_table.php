<table id="transactions-table" class="table table-hover hidden">
    <thead>
        <tr class="table-active">
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
            <!-- <th class="text-center doc-request-schedule-header sortable-header" data-column="4" scope="col" data-order="asc">
                Schedule
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th> -->
            <th class="text-center appointment-facility-start-schedule-header sortable-header" data-column="4" scope="col" data-order="asc">
                Start Time Schedule
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center appointment-facility-end-schedule-header sortable-header" data-column="5" scope="col" data-order="asc">
                End Time Schedule
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center appointment-facility-status-header sortable-header" data-column="6" scope="col" data-order="asc">
                Status
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <!-- <th class="text-center doc-request-status-header" scope="col">
                Generate Slip
            </th> -->
        </tr>
    </thead>
    <tbody id="table-body">
        <!-- Table rows will be generated dynamically using JavaScript -->
    </tbody>
</table>
<div id="pagination" class="container-fluid p-0">
    <nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be generated dynamically using JavaScript -->
            </ul>
        </div>
    </nav>
</div>
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
                            '<td class="text-center">' + appointmentFacility.appointment_id + '</td>' +
                            '<td class="text-center">' +  appointmentFacility.facility_name + '</td>' +
                            '<td class="text-center">' +  appointmentFacility.facility_number + '</td>' +
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
                            '<span class="badge rounded-pill ' + getStatusBadgeClass(appointmentFacility.status_name) + '">' + appointmentFacility.status_name + '</span>' +
                            '</td>' +

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
