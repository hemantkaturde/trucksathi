<?php if($pagetitle=='Category List'){ ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var dt = $('#view_supplierpo').DataTable({
	            "columnDefs": [ 
	                 { className: "details-control", "targets": [ 0 ] },
	                 { "width": "10%", "targets": 0 },
	                 { "width": "8%", "targets": 1 },
					 { "width": "15%", "targets": 2 },
	                 { "width": "10%", "targets": 3 },
					 { "width": "15%", "targets": 4 },
	                 { "width": "10%", "targets": 5 },
					 { "width": "10%", "targets": 6 },
					 { "width": "10%", "targets": 7 },
					 { "width": "15%", "targets": 8 },
					
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>No Supplier PO List Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 10,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>fetchSupplierpolist",
                    type: "post",
	            },
	        });
	    });
    </script>
<?php } ?>


