var currentUserId;
var currentServiceName;

$('.edit-note-btn').on('click', function() {
    var userId = $(this).data('user-id');
    var serviceName = $(this).data('service');
    currentUserId = userId;
    currentServiceName = serviceName;
    populateEditNoteModal(userId, serviceName);
});

$('#save-note-btn').on('click', function() {
    var noteText = $("#edit-note-field").val();
    updateNote(currentUserId, currentServiceName, noteText);
});

function updateNote(userId, serviceName, noteText) {
    $.ajax({
        url: 'tables/academic/update_note.php',
        method: 'POST',
        data: { user_id: userId, service_name: serviceName, note_text: noteText },
        success: function() {
            console.log('Note updated successfully.')
        },
        error: function() {
            console.log('Error occurred while retrieving data.');
        }
    });
}

// Function to populate the edit modal
function populateEditNoteModal(userId, serviceName) {
    $.ajax({
        url: 'tables/academic/edit_note.php',
        method: 'POST',
        data: { user_id: userId, service_name: serviceName },
        success: function(response) {
            var noteText = JSON.parse(response);
            var modalTitle = document.getElementById('editNoteModalLabel');
            var modalBody = document.querySelector('#editNoteModal .modal-body');

            modalTitle.innerText = 'Edit Remarks';

            modalBody.innerHTML = `
                <div class="row">
                    <textarea id="edit-note-field" name="edit-note-field" class="form-control" rows="4" style="resized: none;">${noteText.note === null ? "" : noteText.note}</textarea>
                </div>
            `;

            $("#editNoteModal").modal("show");
        },
        error: function() {
            console.log('Error occurred while retrieving data.');
        }
    });
}
