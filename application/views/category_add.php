    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo (isset($categorydetails))?'Edit Category Master':'Add Category Master' ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>/category">Category Masters</a></li>
              <li class="breadcrumb-item active"><?php echo (isset($categorydetails))?'Edit Category':'Add Category' ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       	<form method="post" id="category_add" class="card" enctype="multipart/form-data" action="<?php echo base_url();?>category/<?php echo (isset($categorydetails))?'updatecategory':'insertcategory'; ?>">  
          <div class="card-body"> 
                  <div class="row">
                    <?php if(isset($categorydetails)) { ?>
                      <input type="hidden" name="cat_id" id="cat_id" value="<?php echo (isset($categorydetails)) ? $categorydetails[0]['cat_id']:'' ?>" >
                    <?php } ?>
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label class="form-label">Category Head<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($categorydetails)) ? $categorydetails[0]['category_head']:'' ?>" id="category_head" name="category_head" placeholder="Category Head">
                      </div>
                    </div>
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label class="form-label">Category Subhead<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($categorydetails)) ? $categorydetails[0]['category_subhead']:'' ?>" id="category_subhead" name="category_subhead" placeholder="Category Subhead">
                      </div>
                    </div>
                
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Category Image<span class="text-danger form-required">*</span></label>
                        <?php if(isset($categorydetails)){ ?> 
                            <input type="file" class="form-control" value="<?php echo (isset($categorydetails)) ? $categorydetails[0]['category_icon']:'' ?>" id="category_icon" name="category_icon" placeholder="Device Image">
                            <img class="img-fluid" style="width: 40px; padding-top:5px" src="<?= base_url(); ?>uploads/category/<?= (isset($categorydetails)) ? $categorydetails[0]['category_icon']:''; ?>">
                            <input type="hidden" required="true" class="form-control" value="<?php echo (isset($categorydetails)) ? $categorydetails[0]['category_icon']:'' ?>" id="category_icon_old" name="category_icon_old" placeholder="Device Image">
                            <input type="hidden" id="updated_by" name="updated_by" value="<?php echo $_SESSION['session_data']['u_id']; ?>">
                        <?php }else{ ?>
                            <input type="file" required="true" class="form-control" value="<?php echo (isset($categorydetails)) ? $categorydetails[0]['category_icon']:'' ?>" id="category_icon" name="category_icon" placeholder="Device Image">
                            <input type="hidden" id="created_by" name="created_by" value="<?php echo $_SESSION['session_data']['u_id']; ?>">
                        <?php } ?>
                      </div>
                    </div>

                    <?php if(isset($categorydetails[0]['status'])) { ?>
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-control " required="">
                          <option value="">Select Category Status</option> 
                          <option <?php echo (isset($categorydetails) && $categorydetails[0]['status']==1) ? 'selected':'' ?> value="1">Active</option> 
                          <option <?php echo (isset($categorydetails) && $categorydetails[0]['status']==0) ? 'selected':'' ?> value="0">Inactive</option> 
                        </select>
                      </div>
                      </div>

                    <?php } ?>
                    

                </div>
                 <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d h:i:s'); ?>">
  
      <div class="modal-footer">

                  <button type="submit" class="btn btn-primary"> <?php echo (isset($categorydetails))?'Update Category':'Add Category' ?></button>
      </div>
    </div>
    </form>
             </div>
    </section>
    <!-- /.content -->



