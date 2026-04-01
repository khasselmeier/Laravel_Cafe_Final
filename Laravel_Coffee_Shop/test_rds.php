<?php
$host='database-laravel-cafe.cjsumq8skg4q.us-east-2.rds.amazonaws.com';
$port=3306;
$db='laravel';
$user='admin';
$password='ymeW.m[37TlES)_G<lW7OtzF46s4';
$conn = null;

try {
    $conn = mysqli_init();
    mysqli_ssl_set($conn, NULL, NULL, "C:/certs/global-bundle.pem", NULL, NULL);
    if (!mysqli_real_connect($conn, $host, $user, $password, $db, $port, NULL, MYSQLI_CLIENT_SSL)) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
    $r = mysqli_query($conn, "SELECT VERSION()");
    if (!$r) {
        throw new Exception("Query failed: " . mysqli_error($conn));
    }
    $row = mysqli_fetch_row($r);
    echo "Database version: " . $row[0] . "\n";
} catch (Exception $e) {
    echo "Database error: " . $e->getMessage() . "\n";
} finally {
    if ($conn) {
        mysqli_close($conn);
    }
}
