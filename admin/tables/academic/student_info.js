$('.user-details-link').on('click', function(event) {
    var userId = event.target.getAttribute('data-user-id');
    populateStudentInfoModal(userId);
});

function populateStudentInfoModal(userId) {
    $.ajax({
        url: 'tables/academic/show_student_info.php',
        method: 'POST',
        data: { user_id: userId },
        success: function(response) {
            var userDetails = JSON.parse(response);
            var modalTitle = document.getElementById('viewUserDetailsModalLabel');
            var modalBody = document.querySelector('#viewUserDetailsModal .modal-body');

            modalTitle.innerText = 'Student Information';

            modalBody.innerHTML = `
                <div class="row">
                    <div class="col-6">
                        <div class="m-0">
                            <p class="fs-5 m-0"><strong>Name</strong></p>
                            <p class="mx-2">${userDetails.last_name + ", " + userDetails.first_name + " " + userDetails.middle_name + " " + userDetails.extension_name}</p>
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
                            <p class="mx-2">${userDetails.year_and_section === null || "" ? 'N/A' : userDetails.year_and_section}</p>
                        </div>
                        </div>
                    <div class="col-6">
                        <div class="m-0">
                            <p class="fs-5 m-0"><strong>Email</strong></p>
                            <p class="mx-2">${userDetails.email}</p>
                        </div>
                        <div class="m-0">
                            <p class="fs-5 m-0"><strong>Contact Number</strong></p>
                            <p class="mx-2">${userDetails.contact_no}</p>
                        </div>
                    </div>
                </div>
            `;

            $("#viewUserDetailsModal").modal("show");
        },
        error: function() {
            console.log('Error occurred while fetching student information.');
        }
    });
}