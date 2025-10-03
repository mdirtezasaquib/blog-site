<?php
include 'config.php';
include 'head.php';

$result = $conn->query("SELECT * FROM contact_messages ORDER BY submitted_at DESC"); // latest first
$messages = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Messages</title>
<style>
  body { font-family: Arial; padding: 20px; background: #f9f9f9; }
  h2 { color: #F37600; margin-bottom: 20px; text-align: center; }
  .search-export { display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 20px; gap:10px; }
  .search-export input { padding: 10px; border-radius: 8px; border: 1px solid #ccc; width: 250px; max-width: 100%; }
  .search-export button { padding: 10px 20px; border: none; border-radius: 8px; background: #F37600; color: #fff; cursor: pointer; }
  table { border-collapse: collapse; width: 100%; background: #fff; border-radius: 8px; overflow: hidden; }
  th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
  th { background: #F37600; color: #fff; }
  tr:nth-child(even) { background: #f9f9f9; }
  @media(max-width:768px){
    table, thead, tbody, th, td, tr { display: block; }
    tr { margin-bottom: 15px; }
    th { text-align: right; }
    td { text-align: right; padding-left: 50%; position: relative; }
    td::before { 
      content: attr(data-label); 
      position: absolute; 
      left: 15px; 
      width: 45%; 
      font-weight: bold; 
      text-align: left; 
    }
  }
</style>
</head>
<body>

<h2>Contact Messages</h2>

<div class="search-export">
  <input type="text" id="searchInput" placeholder="Search messages...">
  <button id="exportBtn">Export to Excel</button>
</div>

<table id="contactTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Submitted At</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($messages as $msg):
        ?>
        <tr>
            <td data-label="#"><?= $i++ ?></td>
            <td data-label="Full Name"><?= htmlspecialchars($msg['full_name']) ?></td>
            <td data-label="Email"><?= htmlspecialchars($msg['email']) ?></td>
            <td data-label="Subject"><?= htmlspecialchars($msg['subject']) ?></td>
            <td data-label="Message"><?= htmlspecialchars($msg['message']) ?></td>
            <td data-label="Submitted At"><?= $msg['submitted_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
  // -------------------- Search Function --------------------
  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#contactTable tbody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(filter) ? '' : 'none';
    });
  });

  // -------------------- Export to Excel --------------------
  function downloadCSV(csv, filename) {
    const csvFile = new Blob([csv], {type: "text/csv"});
    const downloadLink = document.createElement("a");
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
  }

  document.getElementById('exportBtn').addEventListener('click', function() {
    const rows = document.querySelectorAll("#contactTable tr");
    let csv = [];
    rows.forEach(row => {
      const cols = row.querySelectorAll("th, td");
      const rowData = [];
      cols.forEach(col => rowData.push('"' + col.innerText + '"'));
      csv.push(rowData.join(","));
    });
    downloadCSV(csv.join("\n"), "contact_messages.csv");
  });
</script>

</body>
</html>
