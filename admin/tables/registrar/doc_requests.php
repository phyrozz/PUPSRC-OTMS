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
        <th class="text-center doc-request-description-header sortable-header" data-column="purpose" scope="col"
          data-order="desc">
          Purpose
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
        <th></th>
      </tr>
    </thead>
    <tbody id="table-body">
      <!-- Table rows will be generated dynamically using JavaScript -->
    </tbody>
  </table>
</div>
<div id="viewUserDetailsModal" class="modal fade" tabindex="-1" role="dialog"
  aria-labelledby="viewUserDetailsModalLabel" aria-hidden="true">
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
<!-- View edit modal -->
<div id="viewEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewEditModalLabel"
  aria-hidden="true">
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
<!-- Create reason for rejected status modal -->
<div id="createReasonModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createReasonModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createReasonModalLabel">Create Reason</h5>
      </div>
      <div class="modal-body">
        <form id="createReasonForm">
          <div class="mb-3">
            <label for="reason" class="form-label">Reason:</label>
            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
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
<!-- End of create reason for rejected status modal -->
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

// Function to populate the user details modal
function populateUserInfoModal(userId) {
  $.ajax({
    url: 'tables/registrar/get_user_details.php',
    method: 'POST',
    data: {
      user_id: userId
    },
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

/////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////

function populateFeedbackTextModal(feedbackText) {
  var modalTitle = document.getElementById('viewFeedbackTextModalLabel');
  var modalBody = document.querySelector('#viewFeedbackTextModal .modal-body');

  modalTitle.innerText = 'Feedback Text';

  modalBody.innerHTML = feedbackText;

  $("#viewFeedbackTextModal").modal("show");
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
    url: 'tables/registrar/fetch_doc_requests.php',
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

          // Convert the timestamp int value of request_id into a formatted datetime for the Date Requested column
          var timestamp = request.request_id;
          parsedTimestamp = parseInt(timestamp.substring(3));
          var date = new Date(parsedTimestamp * 1000);
          var formattedDate = date.toLocaleString();

          var row = '<tr id="' + request.request_id + '">' +
            '<td><input type="checkbox" name="request-checkbox" value="' + request.request_id + '"></td>' +
            '<td>' + request.request_id + '</td>' +
            '<td>' + formattedDate + '</td>' +
            '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)
              .toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
              })) : 'Not yet scheduled') + '</td>' +
            '<td><a href="#" class="user-details-link" data-user-id="' + request.user_id + '">' + request
            .last_name + ", " + request.first_name + " " + request.middle_name + " " + request
            .extension_name + '</a></td>' +
            '<td>' + request.role + '</td>' +
            '<td>' + request.request_description + '</td>' +
            '<td>' + request.purpose + '</td>' +
            // '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)).toLocaleString() : 'Not yet scheduled') + '</td>' +
            '<td>' + '₱' + request.amount_to_pay + '</td>' +
            '<td class="text-center">' +
            '<span class="badge rounded-pill ' + getStatusBadgeClass(request.status_name) + '">' + request
            .status_name + '</span>' + '</td>';

          // Don't allow edit button to appear when status is not pending
          request.status_name == "Rejected" ?
            row +=
            '<td class="" style="height: 100%"><button class="btn btn-warning btn-sm create-reason mb-2" data-status="' +
            request.status_name + '" data-request-id="' + request.request_id + '" data-office="' + request
            .office_name +
            '">Create Reason <i class="fa-solid fa-pen-to-square"></i></button>' :
            request.status_name == "Released" ?
            row += '<td class="">' :
            row += '<td>'

          // Show delete button only when status is released or rejected
          request.status_name == "Rejected" || request.status_name == "Released" ?
            row +=
            '<button class="btn btn-danger btn-sm delete-request" style="width: 100%" data-status="' +
            request.status_name + '" data-request-id="' + request.request_id + '" data-office="' + request
            .office_name +
            '">Delete</button>' +
            '</td></tr>' :
            row += '</td></tr>'

          tableBody.innerHTML += row;
        }
      } else {
        var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="9">No Transactions</td></tr>';
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

      $('.user-details-link').on('click', function(event) {
        var userId = event.target.getAttribute('data-user-id');
        populateUserInfoModal(userId);
      });

      $('.user-feedback-link').on('click', function(event) {
        var feedbackText = event.target.textContent;
        populateFeedbackTextModal(feedbackText);
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
      url: 'tables/registrar/update_create_reason_for_rejected.php', // Your PHP script to handle the update
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
        handlePagination(1, '', 'request_id', 'desc');
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

    // Set the request ID and office in the modal
    $('#createReasonModal').data('request-id', requestId);

    // Fetch the existing purpose and populate the textarea
    $.ajax({
      url: 'tables/registrar/fetch_reason_for_rejected.php', // Your PHP script to fetch the existing purpose
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

  // Create a event listener for when delete button is pressed

  $(document).on('click', '.delete-request', function() {
    var request_id = event.target.getAttribute('data-request-id');
    console.log(request_id);

    $.ajax({
      url: 'tables/registrar/delete_request.php',
      method: 'POST',
      data: {
        request_id: request_id
      },
      success: function(response) {
        // Log response
        console.log('Request successfully deleted, response:\n', response)
        // Delete row from table
        $(`#${request_id}`).hide()
        $(`#${request_id}`).remove()
      },
      error: function() {
        console.log('Error occurred while fetching existing purpose.');
      }
    })
  })

  // Update status button listener
  $('#update-status-button').on('click', function() {
    var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
    var requestIds = checkedCheckboxes.map(function() {
      return $(this).val();
    }).get();
    var statusId = $('#update-status').val(); // Get the selected status ID

    $.ajax({
      url: 'tables/registrar/update_doc_requests.php',
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