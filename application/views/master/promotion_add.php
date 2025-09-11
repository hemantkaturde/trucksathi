    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo (isset($promotiondetails))?'Edit Promotion Master':'Add Promotion Master' ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>/promotion">Promotion Masters</a></li>
              <li class="breadcrumb-item active"><?php echo (isset($promotiondetails))?'Edit Promotion':'Add Promotion' ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       	<form method="post" id="category_add" class="card" enctype="multipart/form-data" action="<?php echo base_url();?>master/<?php echo (isset($promotiondetails))?'updatepromotion':'insertpromotion'; ?>">  
          <div class="card-body"> 
                  <div class="row">
                    <?php if(isset($promotiondetails)) { ?>
                      <input type="hidden" name="promo_id" id="promo_id" value="<?php echo (isset($promotiondetails)) ? $promotiondetails[0]['promo_id']:'' ?>" >
                    <?php } ?>
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label class="form-label">Title<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($promotiondetails)) ? $promotiondetails[0]['promo_title']:'' ?>" id="promo_title" name="promo_title" placeholder="Enter promotion title">
                      </div>
                    </div>
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label class="form-label">URL<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($promotiondetails)) ? $promotiondetails[0]['promo_url']:'' ?>" id="promo_url" name="promo_url" placeholder="Enter promotion URL">
                      </div>
                    </div>
                
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Banner<span class="text-danger form-required">*</span></label>
                        <?php if(isset($promotiondetails)){ ?> 
                            <input type="file" class="form-control" value="<?php echo (isset($promotiondetails)) ? $promotiondetails[0]['promo_banner']:'' ?>" id="promo_banner" name="promo_banner" placeholder="Promotion Image">
                            <img class="img-fluid" style="width: 40px; padding-top:5px" src="<?= base_url(); ?>uploads/promotion/<?= (isset($promotiondetails)) ? $promotiondetails[0]['promo_banner']:''; ?>">
                            <input type="hidden" required="true" class="form-control" value="<?php echo (isset($promotiondetails)) ? $promotiondetails[0]['promo_banner']:'' ?>" id="promo_banner_old" name="promo_banner_old" placeholder="Promotion Image">
                            <input type="hidden" id="updated_by" name="updated_by" value="<?php echo $_SESSION['session_data']['u_id']; ?>">
                        <?php }else{ ?>
                            <input type="file" required="true" class="form-control" value="<?php echo (isset($promotiondetails)) ? $promotiondetails[0]['promo_banner']:'' ?>" id="promo_banner" name="promo_banner" placeholder="Promotion Image">
                            <input type="hidden" id="created_by" name="created_by" value="<?php echo $_SESSION['session_data']['u_id']; ?>">
                        <?php } ?>
                      </div>
                    </div>

                    <?php if(isset($promotiondetails[0]['status'])) { ?>
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-control " required="">
                          <option value="">Select Category Status</option> 
                          <option <?php echo (isset($promotiondetails) && $promotiondetails[0]['status']==1) ? 'selected':'' ?> value="1">Active</option> 
                          <option <?php echo (isset($promotiondetails) && $promotiondetails[0]['status']==0) ? 'selected':'' ?> value="0">Inactive</option> 
                        </select>
                      </div>
                      </div>

                    <?php } ?>
                    

                </div>
                 <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d h:i:s'); ?>">
  
      <div class="modal-footer">

                  <button type="submit" class="btn btn-primary"> <?php echo (isset($promotiondetails))?'Update Promotion':'Add Promotion' ?></button>
      </div>
    </div>
    </form>
             </div>
    </section>
    <!-- /.content -->



