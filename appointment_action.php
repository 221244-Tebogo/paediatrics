include_once 'class/Appointment.php';

$appointment = new Appointment();

if(!empty($_POST['action']) && $_POST['action'] == 'listAppointment') {
	$appointment->listAppointment();
}