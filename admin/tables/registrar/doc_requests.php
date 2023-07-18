<?php
// Generate a list of statuses for this table to be rendered on <select> in guidance.php
$statuses = array(
    'all' => 'All',
    '1' => 'Pending',
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
        <th class="text-center doc-request-id-header sortable-header" data-column="request_id" scope="col"
          data-order="desc">
          Request Code
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-id-header sortable-header" data-column="request_id" scope="col"
          data-order="desc">
          Date requested
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-id-header sortable-header" data-column="scheduled_datetime" scope="col"
          data-order="desc">
          Scheduled Date
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-requestor-header sortable-header" data-column="last_name" scope="col"
          data-order="desc">
          Requestor
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-student-or-client-header sortable-header" data-column="role" scope="col"
          data-order="desc">
          Student/Client
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-description-header sortable-header" data-column="request_description"
          scope="col" data-order="desc">
          Request
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-amount-header sortable-header" data-column="amount_to_pay" scope="col"
          data-order="desc">
          Amount to pay
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-status-header sortable-header" data-column="status_name" scope="col"
          data-order="desc">
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
    <button id="update-status-button" class="btn btn-primary w-50" disabled><i class="fa-solid fa-pen-to-square"></i>
      Update</button>
  </div>
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
        for (var i = 0; i < data.document_requests.length; i++) {
          var request = data.document_requests[i];
          var scheduleButton = '';

          // // Add schedule button if the status is "Pending"
          // if (request.status_name === 'Pending') {
          //     var schedulePageRedirect = getSchedulePageRedirect(request.request_description);
          //     scheduleButton = '<a href="' + schedulePageRedirect + '" class="btn btn-primary">Schedule Now</a>';
          // }

          // Convert the timestamp int value of request_id into a formatted datetime for the Date Requested column
          var timestamp = request.request_id;
          parsedTimestamp = parseInt(timestamp.substring(3));
          var date = new Date(parsedTimestamp * 1000);
          var formattedDate = date.toLocaleString();

          var row = '<tr>' +
            '<td><input type="checkbox" name="request-checkbox" value="' + request.request_id + '"></td>' +
            '<td>' + request.request_id + '</td>' +
            '<td>' + formattedDate + '</td>' +
            '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)
              .toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
              })) : 'Not yet scheduled') + '</td>' +
            '<td>' + request.last_name + ", " + request.first_name + " " + request.middle_name + " " + request
            .extension_name + '</td>' +
            '<td>' + request.role + '</td>' +
            '<td>' + request.request_description + '</td>' +
            // '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)).toLocaleString() : 'Not yet scheduled') + '</td>' +
            '<td>' + '₱' + request.amount_to_pay + '</td>' +
            '<td class="text-center">' +
            '<span class="badge rounded-pill ' + getStatusBadgeClass(request.status_name) + '">' + request
            .status_name + '</span>' + '</td>' +
            '</tr>';
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
            '<a class="page-link ' + (i == data.current_page ? 'btn-primary text-light' : 'btn-outline-primary') +
            '" href="#" onclick="handlePagination(' + i + ', \'' + searchTerm +
            '\', \'request_id\', \'desc\')">' + i + '</a>' +
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
handlePagination(1, '', 'request_id', 'desc');

$(document).ready(function() {
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
    var requestIds = checkedCheckboxes.map(function() {
      return $(this).val();
    }).get();
    var statusId = $('#update-status').val(); // Get the selected status ID

    $.ajax({
      url: 'tables/guidance/update_doc_requests.php',
      method: 'POST',
      data: {
        requestIds: requestIds,
        statusId: statusId
      }, // Include the selected status ID in the data
      success: function(response) {
        // Handle the success response
        console.log('Status updated successfully');

        // Refresh the table after status update
        handlePagination(1, '', 'request_id', 'desc');
      },
      error: function() {
        // Handle the error response
        console.log('Error occurred while updating status');
      }
    });
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

// Perform search functionality when either the Filter or Search button is pressed
function filterDocType() {
  var filterByDocTypeVal = $('#filterByDocType').val();
  if (filterByDocTypeVal == "all") {
    return '';
  }
  return ' ' + filterByDocTypeVal.toLowerCase();
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
    default:
      return '';
  }
}
</script>