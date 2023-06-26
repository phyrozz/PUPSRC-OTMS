<?php

include "../../conn.php";

$result = mysqli_query($connection, 
	"SELECT reg_transaction.reg_id AS request_code, DATE_FORMAT(schedule, '%Y-%m-%d') 
	AS schedule, services, status, office_name AS office FROM reg_transaction 
	LEFT JOIN reg_services ON reg_services.services_id = reg_transaction.services_id 
	LEFT JOIN reg_status ON reg_status.status_id = reg_transaction.status_id
	LEFT JOIN offices ON offices.office_id = reg_transaction.office_id");
	

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrar Office - Your Registrar Transactions</title>
	<link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
	<link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../style.css">
	<script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
	<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script type='text/javascript' src="https://cdn.datatables.net/plug-ins/1.13.4/sorting/datetime-moment.js"></script>
	<script type='text/javascript' src="//cdn.datatables.net/plug-ins/1.13.4/sorting/natural.js"></script>
	<link href="datatables.min.css" rel="stylesheet" />
	<script type='text/javascript' src="datatables.min.js"></script>
</head>

<body>
	<div class="wrapper">
		<?php
            $office_name = "Registrar Office";
            include "../navbar.php";
            include "../../breadcrumb.php";
        ?>
		<div class="container-fluid p-4">
			<?php
			$breadcrumbItems = [
					['text' => 'Registrar Office', 'url' => '/client/registrar.php', 'active' => false],
					['text' => 'Create Request', 'active' => true],
			];

			echo generateBreadcrumb($breadcrumbItems, true);
		?>
		</div>
		<div class="container-fluid text-center p-4">
			<h1>Your Transactions</h1>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="alert alert-info" role="alert">
						<h4 class="alert-heading">
							<i class="fa-solid fa-circle-info"></i> Reminder
						</h4>
						<p class="mb-0">To view request details, click on the <i class="fa-brands fa-wpforms"></i> button on the
							table.</p>
						<p class="mb-0">You can edit and delete request during <span
								class="badge rounded-pill bg-dark">Pending</span> status.</p>
						<p>Always check the request status to follow transactions.</p>
					</div>

					<table id="transaction_table" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th class="text-center" scope="col">Request Code</th>
								<th class="text-center" scope="col">Office</th>
								<th class="text-center" scope="col">Request</th>
								<th class="text-center" scope="col">Schedule</th>
								<th class="text-center" scope="col">Status</th>
							</tr>
						</thead>
						<tbody>

							<?php
							while ($row = mysqli_fetch_assoc($result)){
								echo '<tr>';
								echo '<td>'. 'REG-' . $row["request_code"] . '</td>';
								echo '<td>'. $row["office"] . '</td>';
								echo '<td>'. $row["services"] . '</td>';
								echo '<td>'. $row["schedule"] . '</td>';
								echo '<td>'. $row["status"] . '</td>';
								echo '</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="d-flex w-100 justify-content-between p-2">
				<button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
					<i class="fa-solid fa-arrow-left"></i> Back
				</button>
				</button>
			</div>
		</div>

	</div>
	<div class="push"></div>
	</div>
	<footer
		class="footer container-fluid w-100 text-md-left text-center d-md-flex align-items-center justify-content-center bg-light flex-nowrap">
		<div>
			<small>PUP Santa Rosa - Online Transaction Management System Beta 0.1.0</small>
		</div>
		<div>
			<small><a href="https://www.pup.edu.ph/terms/" target="_blank" class="btn btn-link">Terms of Use</a>|</small>
			<small><a href="https://www.pup.edu.ph/privacy/" target="_blank" class="btn btn-link">Privacy
					Statement</a></small>
		</div>
	</footer>
	<script>
	$(document).ready(function() {
		$('.dropdown-submenu a.dropdown-toggle').on("click", function(e) {
			$(this).next('ul').toggle();
			e.stopPropagation();
			e.preventDefault();
		});

		let table = new DataTable('#transaction_table', {
			responsive: true,
			columnDefs: [{
					target: 0,
					type: 'natural',
				},
				{
					target: 4,
					type: 'datetime-moment',
				},
			]
		})
	});
	</script>


</body>

</html>