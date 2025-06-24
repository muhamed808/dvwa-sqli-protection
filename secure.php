<?php
if (isset($_REQUEST['Submit'])) {
    // Get input from user
    $id = $_REQUEST['id'];

    switch ($_DVWA['SQLI_DB']) {
        case MYSQL:
            // Create database connection
            $conn = new mysqli(
                $_DVWA['db_server'],
                $_DVWA['db_user'],
                $_DVWA['db_password'],
                $_DVWA['db_database'],
                (int)$_DVWA['db_port']
            );

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Detect suspicious input using regex pattern
            if (preg_match("/('|--|#|;|=| or |union|select)/i", $id)) {
                // Show warning to user
                echo "<pre>🚨 Warning: Suspicious input detected. This may be a hacking attempt.</pre>";

                // Log the suspicious input with timestamp and IP
                $log_entry = date("Y-m-d H:i:s") . " - IP: " . $_SERVER['REMOTE_ADDR'] . " - Suspicious input: " . $id . "\n";
                file_put_contents(__DIR__ . "/hacking_attempts.log", $log_entry, FILE_APPEND);

                // Stop further execution to block the attack
                exit();
            }

            // Prepare the SQL statement safely
            $stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE user_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch and append results to $html
            while ($row = $result->fetch_assoc()) {
                $first = htmlspecialchars($row["first_name"]);
                $last  = htmlspecialchars($row["last_name"]);
                $html .= "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";
            }

            $stmt->close();
            $conn->close();
            break;

        // You can add SQLite case here if needed
    }
}
?>
