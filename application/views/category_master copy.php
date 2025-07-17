<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Category Master
            </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Masters</a></li>
               <li class="breadcrumb-item active">Category Master</li>
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
                <a href="<?php echo base_url().'category/addnew_category'; ?>"><button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add Category</button></a>
            </div>
        </div>
      <div class="card">
         <div class="card-body p-0">
            <div class="table-responsive">
               <table class="table card-table table-vcenter text-nowrap">
                  <thead>
                     <tr>
                        <th class="w-1">S.No</th>
                        <th>Category Icon</th>
                        <th>Category Head</th>
                        <th>Category Subhead</th>
                        <th>Status</th>
                        <?php if(userpermission('cm_edit') || userpermission('cm_del')) { ?>
                        <th>Action</th>
                        <?php } ?>
                     </tr>
                  </thead>
                  <tbody>
                  
                  <?php if(!empty($categorylist)){  $count=1;
                        foreach($categorylist as $categorylist){
                        ?>
                     <tr>
                        <td> <?php echo output($count); $count++; ?></td>
                        <td><?php if($categorylist['category_icon']!='') { ?>
                           <img class="img-fluid" style="width: 30px;" src="<?= base_url(); ?>uploads/category/<?= ucwords($categorylist['category_icon']); ?>">
                        <?php } ?></td>
                        <td> <?php echo output($categorylist['category_head']); ?></td>
                        <td> <?php echo output($categorylist['category_subhead']); ?></td>
                        <td>  <span class="badge <?php echo ($categorylist['status']=='1') ? 'badge-success' : 'badge-danger'; ?> "><?php echo ($categorylist['status']=='1') ? 'Active' : 'Inactive'; ?></span>  </td>
                        <td>
                           <?php //if(userpermission('cm_edit')) { ?>
                           <a class="icon" href="<?php echo base_url(); ?>category/editcategory/<?php echo output($categorylist['cat_id']); ?>">
                           <i class="fa fa-edit"></i>
                           </a>
                           <?php  //} 
                           //if(userpermission('cm_del')) { ?> |
                              <a data-toggle="modal" href="" onclick="confirmation('<?php echo base_url(); ?>category/deletecategory','<?= output($categorylist['cat_id']); ?>')" data-target="#deleteconfirm" class="icon text-danger" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
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