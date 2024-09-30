<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry Form</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { width: 300px; margin: 0 auto; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .data-table th, .data-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .data-table th { background-color: #f2f2f2; }
        .filter-container { margin-top: 20px; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Submit Your Data</h2>
    <form action="process.php" method="POST">
        <label for="reference">Reference Number:</label><br>
        <input type="text" id="reference" name="reference" required><br><br>

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="amount">Amount:</label><br>
        <input type="number" id="amount" name="amount" required><br><br>

        <input type="submit" value="Submit">
    </form>

    <div class="filter-container">
        <h3>Filter Entries</h3>
        <form action="" method="GET">
            <label for="filter">Filter by Reference Number:</label><br>
            <input type="text" id="filter" name="filter" placeholder="Enter reference"><br><br>
            <input type="submit" value="Filter">
        </form>
    </div>

    <?php
    // Display the filtered entries (will be handled in the PHP code later)
    include 'process.php';
    
 try {
    // Create a PDO instance (same connection as above)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if a filter is applied
    if (isset($_GET['filter']) && !empty($_GET['filter'])) {
        $filter = $_GET['filter'];
        $stmt = $pdo->prepare("SELECT * FROM entries WHERE reference LIKE :filter");
        $stmt->execute([':filter' => '%' . $filter . '%']);
    } else {
        // Select all entries if no filter is applied
        $stmt = $pdo->query("SELECT * FROM entries");
    }

    // Display entries
    echo "<table class='data-table'>";
    echo "<tr><th>Reference</th><th>Username</th><th>Amount</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['reference']) . "</td>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
 } catch (PDOException $e) {
    echo "Error fetching entries: " . $e->getMessage();
}
?>

    ?>
</div>

</body>
</html>
