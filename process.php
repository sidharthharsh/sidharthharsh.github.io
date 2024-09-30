<?php
// Database connection details
$host = 'localhost';
$dbname = 'entries';
$username = 'root';
$password = 'classmate123@';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from form
        $reference = $_POST['reference'];
        $username = $_POST['username'];
        $amount = $_POST['amount'];

        try {
            // Insert data into the database
            $stmt = $pdo->prepare("INSERT INTO entries (reference, username, amount) VALUES (:reference, :username, :amount)");
            $stmt->bindParam(':reference', $reference);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();

            echo "Data submitted successfully!";
        } catch (PDOException $e) {
            // Check if the error is due to a duplicate entry
            if ($e->getCode() == 23000) {
                // 23000 is the SQLSTATE code for integrity constraint violations (including UNIQUE constraint violations)
                echo "Error: Reference number already exists. Please use a unique reference number.";
            } else {
                // Other database errors
                echo "Error: " . $e->getMessage();
            }
        }
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
