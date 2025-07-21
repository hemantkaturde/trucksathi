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
					 { "width": "8%", "targets": 4 },
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

