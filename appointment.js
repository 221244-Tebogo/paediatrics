var appointmentRecords = $('#appointmentListing').DataTable({
	"lengthChange": false,
	"processing":true,
	"serverSide":true,		
	"bFilter": false,
	'serverMethod': 'post',		
	"order":[],
	"ajax":{
		url:"appointment_action.php",
		type:"POST",
		data:{action:'listAppointment'},
		dataType:"json"
	},
	"columnDefs":[
		{
			"targets":[0, 8, 9, 10],
			"orderable":false,
		},
	],
	"pageLength": 10
});