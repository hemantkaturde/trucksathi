<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Certificate
            </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">GPS Device Order</a></li>
               <li class="breadcrumb-item active">Certificate</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
        <div class="row">
            <div class="col-12 m-1">
                <?php if($check['count'] > $check['rows'] ){ ?>
                    <a href="<?php echo base_url().'device/certificate_add/'.$this->uri->segment(3); ?>"><button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add New</button></a>
                <?php } ?>
            </div>
        </div>
      <div class="card">
         <div class="card-body p-10">
            <div class="table-responsive">
               <table id="certificate_data" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                  <thead>
                     <tr>
                        <th>Certificate No.</th>
                        <th>Date</th>
                        <th>Owner Name</th>
                        <th>Veh Registration No.</th>
                        <!-- <th>Serial Number</th> -->
                        <th>Chassis No.</th>
                        <th>Engine Number</th>
                        <!-- <th>Status</th> -->
                        <?php //if(userpermission('dm_edit') || userpermission('dm_del')) { ?>
                        <th>Action</th>
                        <?php //} ?>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
              
            </div>
         </div>
         <!-- /.card-body -->
      </div>
   </div>
</section>
<!-- /.content -->

<script>
    var cid = <?php echo $this->uri->segment(3); ?>;

		$(document).ready(function() {
            var dt = $('#certificate_data').DataTable({
	            "columnDefs": [ 
	                 { className: "details-control", "targets": [ 0 ] },
	                 { "width": "10%", "targets": 0 },
	                 { "width": "10%", "targets": 1 },
					 { "width": "10%", "targets": 2 },
	                 { "width": "10%", "targets": 3 },
					 { "width": "10%", "targets": 4 },
					 { "width": "10%", "targets": 5 },
					 { "width": "10%", "targets": 6 },
					//  { "width": "10%", "targets": 7 },
					//  { "width": "10%", "targets": 8 },
					//  { "width": "10%", "targets": 9 },
	            ],
	            responsive: true,
	            "oLanguage": {
	                "sEmptyTable": "<i>No certificate List Found.</i>",
	            }, 
	            "bSort" : false,
	            "bFilter":true,
	            "bLengthChange": true,
	            "iDisplayLength": 15,   
	            "bProcessing": true,
	            "serverSide": true,
	            "ajax":{
                    url :"<?php echo base_url();?>device/fetchCertificatelist",
					data: {"id": cid},
                    type: "post",
	            },
	        });
	    });
</script>