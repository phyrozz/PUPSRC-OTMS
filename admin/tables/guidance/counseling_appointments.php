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
                Student/Client
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

                        var row = '<tr>' +
                            '<td><input type="checkbox" id="' + schedules.counseling_id + '" name="' + schedules.counseling_id + '" value="' + schedules.counseling_id + '"></td>' +
                            '<td>' + schedules.counseling_id + '</td>' +
                            '<td>' + formattedDate + '</td>' +
                            '<td>' + schedules.last_name + ", " + schedules.first_name + " " + schedules.middle_name + " " + schedules.extension_name + '</td>' +
                            '<td>' + schedules.role + '</td>' +
                            '<td>' + schedules.appointment_description + '</td>' +
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
    handlePagination(1, '', 'request_id', 'desc');

    $(document).ready(function() {
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'request_id', 'desc');
        });
    });
</script>
