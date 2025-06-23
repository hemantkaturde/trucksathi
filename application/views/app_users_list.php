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
         <div class="card-body p-0">
            <div class="table-responsive">
               <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                     <tr>
                        <th class="w-1">S.No</th>
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
                  
                  <?php if(!empty($appuserslist)){  $count=1;
                        foreach($appuserslist as $appuserslist){
                        ?>
                     <tr>
                        <td> <?php echo output($count); $count++; ?></td>
                        <td> <?php echo output($appuserslist['name']); ?></td>
                        <td> <?php echo output($appuserslist['mobile']); ?></td>
                        <td> <?php echo output($appuserslist['pincode']); ?></td>
                        <td> <?php echo output($appuserslist['category_head']); ?></td>
                        <td>  <span class="badge <?php echo ($appuserslist['kyc_status']=='1') ? 'badge-success' : 'badge-danger'; ?> "><?php echo ($appuserslist['kyc_status']=='1') ? 'Active' : 'Inactive'; ?></span>  </td>
                        <td>
                           <?php //if(userpermission('cm_edit')) { ?>
                           <a class="icon" href="<?php echo base_url(); ?>app_users/editapp_users/<?php echo output($appuserslist['id']); ?>">
                           <i class="fa fa-edit"></i>
                           </a>
                           <?php  //} 
                           //if(userpermission('cm_del')) { ?> 
                              | <a data-toggle="modal" href="" onclick="confirmation('<?php echo base_url(); ?>app_users/delete_app_users','<?= output($appuserslist['id']); ?>')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
                            
                           <?php //} ?>
                        </td>
                     </tr>    
                     <?php }  } ?>
                  </tbody>
               </table>
              
            </div>
         </div>
         <!-- /.card-body -->
      </div>
   </div>
</section>
<!-- /.content -->