<?php
$conn = new mysqli('localhost', 'root', 'arzelzolina10', 'evsuvotes');

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
