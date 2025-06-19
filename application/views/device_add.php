    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo (isset($devicedetails))?'Edit Device Master':'Add Device Master' ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>/device">Device Masters</a></li>
              <li class="breadcrumb-item active"><?php echo (isset($devicedetails))?'Edit Device':'Add Device' ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       	      <form method="post" id="device_add" class="card" enctype="multipart/form-data" action="<?php echo base_url();?>device/<?php echo (isset($devicedetails))?'updatedevice':'insertdevice'; ?>">  
          <div class="card-body"> 

                  <div class="row">
                     <?php if(isset($devicedetails)) { ?>
                   <input type="hidden" name="id" id="id" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['id']:'' ?>" >
                 <?php } ?>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                          <label class="form-label">Device Name<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['device_name']:'' ?>" id="device_name" name="device_name" placeholder="Device Name">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                         <label class="form-label">Model Number<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['model_number']:'' ?>" id="model_number" name="model_number" placeholder="Model Number">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                         <label class="form-label">Serial Number<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['serial_number']:'' ?>" id="serial_number" name="serial_number" placeholder="Serial Number">

                      </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                         <label class="form-label">Price<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['price']:'' ?>" id="price" name="price" placeholder="Enter Price">

                      </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Device Image<span class="text-danger form-required">*</span></label>
                        <?php if(isset($devicedetails)){ ?> 
                            <input type="file" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['device_image']:'' ?>" id="device_image" name="device_image" placeholder="Device Image">
                            <img class="img-fluid" style="width: 40px; padding-top:5px" src="<?= base_url(); ?>uploads/device_image/<?= (isset($devicedetails)) ? $devicedetails[0]['device_image']:''; ?>">
                          
                            <input type="hidden" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['device_image']:'' ?>" id="device_image_old" name="device_image_old" placeholder="Device Image">
                        <?php }else{ ?>
                            <input type="file" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['device_image']:'' ?>" id="device_image" name="device_image" placeholder="Device Image">

                        <?php } ?>
                      </div>
                    </div>
                    

                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                       <label class="form-label">Description</label>
                        <textarea class="form-control" required="true" id="description" autocomplete="off" placeholder="Description"  name="description"><?php echo (isset($devicedetails)) ? $devicedetails[0]['description']:'' ?></textarea>
                      </div>
                    </div>
                </div>
                 <input type="hidden" id="created_at" name="created_at" value="<?php echo date('Y-m-d h:i:s'); ?>">
  
      <div class="modal-footer">

                  <button type="submit" class="btn btn-primary"> <?php echo (isset($devicedetails))?'Update Device':'Add Device' ?></button>
      </div>
    </div>
    </form>
             </div>
    </section>
    <!-- /.content -->



