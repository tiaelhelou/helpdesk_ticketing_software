<?php

include('..\ConnecttoDb\my_db.php');

session_start();
$id = $_SESSION['ID'];
//ticket_title = $_SESSION['title'];

$title = $_POST['ticket_title'];
//$reason = $_POST['status_reason'];


echo $title;
$query = $mysqli->prepare("SELECT id_ticket FROM tickets WHERE ticket_title = ?;");
$query->bind_param('s',$title);
$query->execute();
$id_result = $query->get_result();
$row = mysqli_fetch_row($id_result);
$ticket_id = $row[0];


$query = $mysqli->prepare("
			UPDATE ticket_statuses
			SET ticket_status = 'Closed'
			WHERE tickets_id_ticket = ?
		;" );
$query->bind_param('i',$ticket_id);
$query->execute();

//header("Location:..\dashboardemployee.php");

?>