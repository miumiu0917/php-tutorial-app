<?php
mysqli_report( MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT );

function connect() {
  $conn = new mysqli('127.0.0.1', 'tutorial', 'password', 'tutorial');
  return $conn;
}
