public function listAppointment(){
		
	$sqlWhere = '';
	if($_SESSION["role"] == 'patient') { 
		$sqlWhere = "WHERE a.patient_id = '".$_SESSION["userid"]."'";
	}	
	
	$sqlQuery = "SELECT a.id, d.name as doctor_name, s.specialization, a.consultancy_fee, appointment_date, a.appointment_time, a.created, a.status, p.name as patient_name, p.id as patient_id, slot.slots
		FROM ".$this->appointmentTable." a 
		LEFT JOIN ".$this->doctorTable." d ON a.doctor_id = d.id
		LEFT JOIN ".$this->patientsTable." p ON a.patient_id = p.id
		LEFT JOIN ".$this->slotsTable." slot ON slot.id = a.appointment_time
		LEFT JOIN ".$this->specializationTable." s ON a.specialization_id = s.id $sqlWhere ";
		
		
	if(!empty($_POST["search"]["value"])){
		$sqlQuery .= ' AND (a.id LIKE "%'.$_POST["search"]["value"].'%" ';
		$sqlQuery .= ' OR d.name LIKE "%'.$_POST["search"]["value"].'%" ';			
		$sqlQuery .= ' OR s.specialization LIKE "%'.$_POST["search"]["value"].'%" ';
		$sqlQuery .= ' OR a.consultancy_fee LIKE "%'.$_POST["search"]["value"].'%" ';
		$sqlQuery .= ' OR a.appointment_date LIKE "%'.$_POST["search"]["value"].'%" ';
		$sqlQuery .= ' OR a.appointment_time LIKE "%'.$_POST["search"]["value"].'%") ';					
	}
	
	if(!empty($_POST["order"])){
		$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	} else {
		$sqlQuery .= 'ORDER BY a.id DESC ';
	}
	
	if($_POST["length"] != -1){
		$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}		
	$stmt = $this->conn->prepare($sqlQuery);
	$stmt->execute();
	$result = $stmt->get_result();	
	
	$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->appointmentTable." as a $sqlWhere");
	$stmtTotal->execute();
	$allResult = $stmtTotal->get_result();
	$allRecords = $allResult->num_rows;
	
	$displayRecords = $result->num_rows;
	$records = array();		
	while ($appointment = $result->fetch_assoc()) { 				
		$rows = array();			
		$rows[] = $appointment['id'];
		$rows[] = ucfirst($appointment['patient_name']);
		$rows[] = ucfirst($appointment['doctor_name']);
		$rows[] = $appointment['specialization'];
		$rows[] = $appointment['consultancy_fee'];
		$rows[] = $appointment['slots'];
		$rows[] = $appointment['appointment_date'];	
		$rows[] = $appointment['status'];					
		$rows[] = '<button type="button" name="view" id="'.$appointment["id"].'" class="btn btn-info btn-xs view"><span class="glyphicon glyphicon-file" title="View">View</span></button>';
		if($_SESSION["role"] == 'admin' || $_SESSION["role"] == 'patient') { 
			$rows[] = '<button type="button" name="update" id="'.$appointment["id"].'" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit">Edit</span></button>';
			$rows[] = '<button type="button" name="delete" id="'.$appointment["id"].'" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete">Delete</span></button>';
		} else {
			$rows[] = '';
			$rows[] = '';
			$rows[] = '';
		}
		$records[] = $rows;
	}
	
	$output = array(
		"draw"	=>	intval($_POST["draw"]),			
		"iTotalRecords"	=> 	$displayRecords,
		"iTotalDisplayRecords"	=>  $allRecords,
		"data"	=> 	$records
	);
	
	echo json_encode($output);
}