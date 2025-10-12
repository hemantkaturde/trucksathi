<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Device order
            </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">GPS Device</a></li>
               <li class="breadcrumb-item active">Device order</li>
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
        <!-- <div class="row">
            <div class="col-12 m-1">
                <a href="<?php echo base_url().'category/addnew_category'; ?>"><button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add Category</button></a>
            </div>
        </div> -->
      <div class="card">
         <div class="card-body p-10">
            <div class="table-responsive">
               <table id="view_device_order" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                  <thead>
                     <tr>
                        <th>User</th>
                        <th>Mobile No.</th>
                        <th>Device</th>
                        <th>Theft Protection</th>
                        <th>Theft Protection amount</th>
                        <th>Device count</th>
                        <th>Device amount</th>
                        <th>GST %</th>
                        <th>GST value</th>
                        <th>Grand Total</th>
                        <th>Order No.</th>
                        <th>Created Date</th>
                        <?php //if(userpermission('cm_edit') || userpermission('cm_del')) { ?>
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