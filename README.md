# attendance_management_system
# create dbh_inc.php inside includes folder
# paste following code and edit

```
<?php

$host = 'localhost';
$dbname = 'technicians_attendance_system';
$dbusername = 'YOUR_USERNAME';
$dbpassword = 'YOUR_PASSWORD';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
```
