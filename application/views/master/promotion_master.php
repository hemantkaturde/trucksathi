<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title; ?> Master
            </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Masters</a></li>
               <li class="breadcrumb-item active"><?php echo $title; ?> Master</li>
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
                <a href="<?php echo base_url().'add-promotion'; ?>"><button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add Promotion</button></a>
            </div>
        </div>
      <div class="card">
         <div class="card-body p-10">
            <div class="table-responsive">
               <table id="view_promotion" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                  <thead>
                     <tr>
                        <th>Promotion banner</th>
                        <th>Promotion Title</th>
                        <th>URL</th>
                        <th>Status</th>
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