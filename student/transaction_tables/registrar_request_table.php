<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center doc-request-id-header sortable-header" data-column="request_code" scope="col" data-order="desc">
                    Request Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-office-header sortable-header" data-column="office_name" scope="col" data-order="desc">
                    Office
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-description-header sortable-header" data-column="services" scope="col" data-order="desc">
                    Request
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-amount-header sortable-header" data-column="schedule" scope="col" data-order="desc">
                    Schedule
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-status-header sortable-header" data-column="status_name" scope="col" data-order="desc">
                    Status
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table rows will be generated dynamically using JavaScript -->
        </tbody>
    </table>
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

    // This function gives each office names on the Office column of the table links that will redirect them to their respective offices
    function generateUrlToOfficeColumn(officeName) {
        switch (officeName) {
            case 'Guidance Office':
                return 'http://localhost/student/guidance.php';
            case 'Registrar Office':
                return 'http://localhost/student/registrar.php';
            case 'Academic Office':
                return 'http://localhost/student/academic.php';
            case 'Accounting Office':
                return 'http://localhost/student/accounting.php';
            case 'Administrative Office':
                return 'http://localhost/student/administrative.php';
        }
    }

    function handlePagination(page, searchTerm = '', column = 'reg_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'transaction_tables/fetch_registrar_request.php',
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
                    for (var i = 0; i < data.registrar_requests.length; i++) {
                        var registrar = data.registrar_requests[i];
                        var scheduleButton = '';

                        // Add schedule button if the status is "Pending"
                        if (registrar.status_name === 'Pending') {
                            var schedulePageRedirect = getSchedulePageRedirect(registrar.services);
                            scheduleButton = '<a href="' + schedulePageRedirect + '" class="btn btn-primary">Schedule Now</a>';
                        }

                        var row = '<tr>' +
                            '<td>' + registrar.request_code + '</td>' +
                            '<td><a href="' + generateUrlToOfficeColumn(registrar.office_name) + '">' + registrar.office_name + '</a></td>' +
                            '<td>' + registrar.services + '</td>' +
                            // '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)).toLocaleString() : 'Not yet scheduled') + '</td>' +
                            '<td>' + registrar.schedule + '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill doc-request-status-cell ' + getStatusBadgeClass(registrar.status_name) + '">' + registrar.status_name + '</span>' +
                            '</td>'
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }  else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="5">No Transactions</td></tr>';
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
    handlePagination(1, '', 'reg_id', 'desc');

    $(document).ready(function() {
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'request_id', 'desc');
        });
    });
</script>