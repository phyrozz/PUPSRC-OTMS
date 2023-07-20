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
        <th class="text-center doc-request-id-header sortable-header" data-column="request_id" scope="col"
          data-order="desc">
          Course
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-id-header sortable-header" data-column="scheduled_datetime" scope="col"
          data-order="desc">
          Year
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-requestor-header sortable-header" data-column="last_name" scope="col"
          data-order="desc">
          Student Name
          <i class="sort-icon fa-solid fa-caret-down"></i>
        </th>
        <th class="text-center doc-request-shelf-location-header sortable-header" data-column="shelf-location"
          scope="col" data-order="desc">
          Shelf Location
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
let html = '';
students.map((student) => {
  html += `
          <tr>
            <td>${student.Course}</td>
            <td>${student.Year}</td>
            <td>${student.Name}</td>
            <td>${student["Shelf Location"]}</td>
          </tr>
        `
})
const body = document.querySelector('#table-body');
body.innerHTML = html;
</script>