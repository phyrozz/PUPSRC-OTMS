<script src='./tables/registrar/students.js'></script>
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
  <table id="transactions-table" class="table table-hover">
    <thead>
      <tr class="table-active">
        <th class="doc-request-requestor-header sortable-header" data-column="last_name" scope="col" data-order="desc">
          Student Name
        </th>
        <th class="doc-request-shelf-location-header sortable-header" data-column="shelf-location" scope="col"
          data-order="desc">
          Feedback
        </th>
        <th class="doc-request-shelf-location-header sortable-header" data-column="shelf-location" scope="col"
          data-order="desc">
          Date Sent
        </th>
      </tr>
    </thead>
    <tbody id="table-body">
      <!-- Table rows will be generated dynamically using JavaScript -->

    </tbody>
  </table>
</div>

<script>
let html = '';

$.ajax({
  url: 'tables/registrar/fetch_feedback.php',
  method: 'GET',
  success: function(response) {
    const data = JSON.parse(response);
    data.forEach((student) => {
      html += `
          <tr>
            <td>${student.name}</td>
            <td>${student.feedback_text}</td>
            <td>${student.time}</td>
          </tr>
        `
    })
    const body = document.querySelector('#table-body');
    body.innerHTML = html;
  }
})
</script>