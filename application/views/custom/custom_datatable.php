<?php //print_r($pagetitle); die;
		
		//if($pagetitle=='Category List'){  ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var dt = $('#view_category').DataTable({
	            "columnDefs": [ 
	                 { className: "details-control", "targets": [ 0 ] },
	                 { "width": "10%", "targets": 0 },
	                 { "width": "15%", "targets": 1 },
					 { "width": "15%", "targets": 2 },
	                 { "width": "15%", "targets": 3 },
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>No Category List Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 10,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>category/fetchCategorylist",
                    type: "post",
	            },
	        });
	    });
    </script>
<?php //} ?>

	<script type="text/javascript">
        $(document).ready(function() {
            var dt = $('#view_device').DataTable({
	            "columnDefs": [ 
	                 { "width": "10%", "targets": 0 },
					 { "width": "10%", "targets": 1 },
	                 { "width": "10%", "targets": 2 },
					 { "width": "10%", "targets": 3 },
					 { "width": "10%", "targets": 4 },
					 { "width": "10%", "targets": 5 },
					 { "width": "10%", "targets": 6 },
					//  { "width": "10%", "targets": 7 },
					 { "width": "8%", "targets": 7 },
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>No Device List Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 10,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>device/fetchDevicelist",
                    type: "post",
	            },
	        });
	    });
    </script>

	<script type="text/javascript">
        $(document).ready(function() {
            var dt = $('#view_app_user').DataTable({
	            "columnDefs": [ 
	                 { "width": "25%", "targets": 0 },
					 { "width": "15%", "targets": 1 },
	                 { "width": "15%", "targets": 2 },
					 { "width": "20%", "targets": 3 },
					 { "width": "15%", "targets": 4 },
					 { "width": "10%", "targets": 5 }
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>No Device List Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 10,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>App_users/fetchappuserslist",
                    type: "post",
	            },
	        });
	    });
    </script>

	<script type="text/javascript">
		// ====== BODY TYPE =======
        $(document).ready(function() {
            var dt = $('#view_bodytype').DataTable({
	            "columnDefs": [ 
	                 { "width": "15%", "targets": 0 },
					 { "width": "10%", "targets": 1 },
	                 { "width": "8%", "targets": 2 }
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>Body type Not Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 5,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>master/bodytypelist",
                    type: "post",
	            },
	        });
	    });

		// ====== TYRE MASTER =====
		$(document).ready(function() {
            var dt = $('#view_tyre').DataTable({
	            "columnDefs": [ 
	                 { "width": "15%", "targets": 0 },
					 { "width": "10%", "targets": 1 },
	                 { "width": "8%", "targets": 2 }
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>Tyre Data Not Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 5,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>master/tyrelist",
                    type: "post",
	            },
	        });
	    });

		// ====== CAPACITY MASTER =====
		$(document).ready(function() {
            var dt = $('#view_capacity').DataTable({
	            "columnDefs": [ 
	                 { "width": "15%", "targets": 0 },
					 { "width": "10%", "targets": 1 },
	                 { "width": "8%", "targets": 2 }
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>Capacity Data Not Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 5,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>master/capacitylist",
                    type: "post",
	            },
	        });
	    });

		// ====== VEHICLE SIZE MASTER =====
		$(document).ready(function() {
            var dt = $('#view_vehiclesize').DataTable({
	            "columnDefs": [ 
	                 { "width": "15%", "targets": 0 },
					 { "width": "10%", "targets": 1 },
	                 { "width": "8%", "targets": 2 }
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>Vehicle size Data Not Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 5,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>master/vehiclesizelist",
                    type: "post",
	            },
	        });
	    });

		$(document).ready(function() {
            var dt = $('#view_promotion').DataTable({
	            "columnDefs": [ 
	                 { className: "details-control", "targets": [ 0 ] },
	                 { "width": "10%", "targets": 0 },
	                 { "width": "15%", "targets": 1 },
					 { "width": "15%", "targets": 2 },
	                 { "width": "15%", "targets": 3 },
					 { "width": "15%", "targets": 4 },
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>No Promotion List Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 10,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>master/fetchPromotionlist",
                    type: "post",
	            },
	        });
	    });

		$(document).ready(function() {
            var dt = $('#view_device_order').DataTable({
	            "columnDefs": [ 
	                 { className: "details-control", "targets": [ 0 ] },
	                 { "width": "10%", "targets": 0 },
	                 { "width": "10%", "targets": 1 },
					 { "width": "10%", "targets": 2 },
	                 { "width": "10%", "targets": 3 },
					 { "width": "10%", "targets": 4 },
					 { "width": "10%", "targets": 5 },
					 { "width": "10%", "targets": 6 },
					 { "width": "10%", "targets": 7 },
					 { "width": "10%", "targets": 8 },
					 { "width": "10%", "targets": 9 },
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>No device order List Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 15,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>device/fetchDeviceOrderlist",
                    type: "post",
	            },
	        });
	    });
    </script>

