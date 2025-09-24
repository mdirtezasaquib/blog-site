<?php
include('config.php');
include('head.php');

// Fetch appointments latest first
$sql = "SELECT * FROM appointments ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>View Appointments</title>

<!-- Bootstrap & DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    body { background: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .card { border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    h2 { color: #003d32; font-weight: 700; }
    .btn-export { background-color: #ffcc00; color: #003d32; font-weight: 600; border-radius: 8px; }
    .btn-export:hover { background-color: #ffaa00; color: #000; }
    .table th, .table td { vertical-align: middle; }
    @media(max-width:768px){ h2 { font-size:1.6rem; } }
</style>
</head>
<body>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2>Appointments</h2>
        <button id="exportBtn" class="btn btn-export mt-2"><i class="fa fa-file-excel me-1"></i> Export to Excel</button>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table id="appointmentsTable" class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Sr. No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Visited</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $sr = 1;
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$sr++."</td>";
                            echo "<td>".htmlspecialchars($row['name'])."</td>";
                            echo "<td>".htmlspecialchars($row['email'])."</td>";
                            echo "<td>".htmlspecialchars($row['phone'])."</td>";
                            echo "<td>".htmlspecialchars($row['visited'])."</td>";
                            echo "<td>".htmlspecialchars($row['subject'])."</td>";
                            echo "<td>".htmlspecialchars($row['message'])."</td>";
                            echo "<td>".htmlspecialchars($row['created_at'])."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No appointments found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- XLSX & FileSaver -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.19.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script>
$(document).ready(function () {
    // Initialize DataTable
    var table = $('#appointmentsTable').DataTable({
        "order": [], // disable default ordering
        "paging": true,
        "info": true,
        "searching": true
    });

    // Excel Export
    $("#exportBtn").click(function () {
        // Clone table to remove DataTable extra elements
        var clonedTable = $('#appointmentsTable').clone();
        clonedTable.find('thead th').each(function(i, th){
            $(th).text($(th).text()); // remove any HTML inside headers
        });

        var wb = XLSX.utils.table_to_book(clonedTable[0], {sheet:"Appointments"});
        XLSX.writeFile(wb, "Appointments.xlsx");
    });
});
</script>
</body>
</html>

<?php $conn->close(); ?>
