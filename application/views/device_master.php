<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Device Master
            </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Masters</a></li>
               <li class="breadcrumb-item active">Device Master</li>
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
                <a href="<?php echo base_url().'device/addnew_device'; ?>"><button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add Device</button></a>
            </div>
        </div>
      <div class="card">
         <div class="card-body p-0">
            <div class="table-responsive">
               <table id="driverslisttbl" class="table card-table table-vcenter text-nowrap">
                  <thead>
                     <tr>
                        <th class="w-1">S.No</th>
                        <th>Device Image</th>
                        <th>Device Name</th>
                        <th>Model Number</th>
                        <th>Serial Number</th>
                        <th>Price </th>
                        <th>Description</th>
                        <th>Status</th>
                        <?php if(userpermission('dm_edit') || userpermission('dm_del')) { ?>
                        <th>Action</th>
                        <?php } ?>
                     </tr>
                  </thead>
                  <tbody>
                  
                  <?php if(!empty($devicelist)){  $count=1;
                        foreach($devicelist as $devicelists){
                        ?>
                     <tr>
                        <td> <?php echo output($count); $count++; ?></td>
                        <td><?php if($devicelists['device_image']!='') { ?>
                           <img class="img-fluid" style="width: 30px;" src="<?= base_url(); ?>uploads/device_image/<?= ucwords($devicelists['device_image']); ?>">
                        <?php } ?></td>
                        <td> <?php echo output($devicelists['device_name']); ?></td>
                        <td> <?php echo output($devicelists['model_number']); ?></td>
                        <td><?php echo output($devicelists['serial_number']); ?></td>
                        <td> <?php echo output($devicelists['price']); ?></td>
                        <td><?php echo output($devicelists['description']); ?></td>
                        <td>  <span class="badge <?php echo ($devicelists['status']=='1') ? 'badge-success' : 'badge-danger'; ?> "><?php echo ($devicelists['status']=='1') ? 'Active' : 'Inactive'; ?></span>  </td>
                        <td>
                           <?php //if(userpermission('dm_edit')) { ?>
                           <a class="icon" href="<?php echo base_url(); ?>device/editdevice/<?php echo output($devicelists['id']); ?>">
                           <i class="fa fa-edit"></i>
                           </a>
                           <?php  //} 
                           //if(userpermission('lr_driver_del')) { ?> |
                              <a data-toggle="modal" href="" onclick="confirmation('<?php echo base_url(); ?>device/deletedevice','<?= output($devicelists['id']); ?>')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
                           </a> 
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