<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">App User's
            </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <!-- <li class="breadcrumb-item"><a href="#">App User's</a></li> -->
               <li class="breadcrumb-item active">App User's</li>
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
                <a href="<?php echo base_url().'app_users/addnew_app_user'; ?>"><button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add App User</button></a>
            </div>
        </div>
      <div class="card">
         <div class="card-body p-10">
            <div class="table-responsive">
               <table id="view_app_user" class="table card-table table-vcenter text-nowrap">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Mobile NO</th>
                        <th>Pincode</th>
                        <th>Category Name</th>
                        <th>KYC Status</th>
                        <?php //if(userpermission('cm_edit') || userpermission('cm_del')) { ?>
                        <th>Action</th>
                        <?php //} ?>
                     </tr>
                  </thead>
                  <tbody>
               </table>
              
            </div>
         </div>
         <!-- /.card-body -->
      </div>
   </div>
</section>
<!-- /.content -->