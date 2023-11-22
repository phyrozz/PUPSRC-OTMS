var currentUserId;
var currentServiceName;

$('.edit-remarks-btn').on('click', function() {
    var userId = $(this).data('user-id');
    var serviceName = $(this).data('service');
    currentUserId = userId;
    currentServiceName = serviceName;
    populateRemarksModal(userId, serviceName);
});

$('#save-remarks-btn').on('click', function() {
    var remarksText = $("#edit-remarks-field").val();
    updateRemarks(currentUserId, currentServiceName, remarksText);
});

function updateRemarks(userId, serviceName, remarksText) {
    $.ajax({
        url: 'tables/academic/update_remarks.php',
        method: 'POST',
        data: { user_id: userId, service_name: serviceName, remarks_text: remarksText },
        success: function() {
            console.log('Remarks updated successfully.')
        },
        error: function() {
            console.log('Error occurred while retrieving data.');
        }
    });
}

// Function to populate the edit modal
function populateEditRemarksModal(userId, serviceName) {
    $.ajax({
        url: 'tables/academic/edit_remarks.php',
        method: 'POST',
        data: { user_id: userId, service_name: serviceName },
        success: function(response) {
            var remarksText = JSON.parse(response);
            var modalTitle = document.getElementById('editRemarksModalLabel');
            var modalBody = document.querySelector('#editRemarksModal .modal-body');

            modalTitle.innerText = 'Edit Remarks';

            modalBody.innerHTML = `
                <div class="row">
                    <textarea id="edit-remarks-field" name="edit-remarks-field" class="form-control" rows="4" style="resized: none;">${remarksText.remarks === null ? "" : remarksText.remarks}</textarea>
                </div>
            `;

            $("#editRemarksModal").modal("show");
        },
        error: function() {
            console.log('Error occurred while retrieving data.');
        }
    });
}
