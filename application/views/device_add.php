<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.css">
<style>
  .form-check-input { margin-left: 1.25rem; }
</style>
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
                          <label class="form-label">Device Title<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['device_name']:'' ?>" id="device_name" name="device_name" placeholder="Device Title">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                          <label class="form-label">Device Type<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['device_type']:'' ?>" id="device_type" name="device_type" placeholder="Device Type">
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
                       <label class="form-label">Years</label>
                        <select class="form-control" required="true" id="years" placeholder="Years"  name="years">
                          <option value="">--Please Select--</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==1) ? 'selected':'' ?> value="1">1 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==2) ? 'selected':'' ?> value="2">2 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==3) ? 'selected':'' ?> value="3">3 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==4) ? 'selected':'' ?> value="4">4 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==5) ? 'selected':'' ?> value="5">5 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==6) ? 'selected':'' ?> value="6">6 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==7) ? 'selected':'' ?> value="7">7 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==8) ? 'selected':'' ?> value="8">8 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==9) ? 'selected':'' ?> value="9">9 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==10) ? 'selected':'' ?> value="10">10 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==11) ? 'selected':'' ?> value="11">11 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==12) ? 'selected':'' ?> value="12">12 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==13) ? 'selected':'' ?> value="13">13 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==14) ? 'selected':'' ?> value="14">14 Years</option>
                          <option <?php echo (isset($devicedetails) && $devicedetails[0]['years']==15) ? 'selected':'' ?> value="15">15 Years</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <div class="form-check">
                          <label class="form-label">Theft Protection</label>
                          <input class="form-check-input" name="is_theft_pro" id="is_theft_pro" type="checkbox" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['is_theft_pro']:'0' ?>" <?php echo (isset($devicedetails) && $devicedetails[0]['is_theft_pro']==1) ? 'checked':'' ?>>
                        </div>

                         <!-- <label class="form-label">Theft Protection<span class="text-danger form-required">*</span></label> -->
                          <!-- <input type="checkbox" required="true" size="2" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['theft_pro_amount']:'' ?>" id="theft_pro" name="theft_pro" placeholder="Enter Theft Protection"> -->
                      </div>
                      <div class="form-group">
                         <label class="form-label">Theft Protection amount<span class="text-danger form-required">*</span></label>
                          <input type="text" required="true" class="form-control" value="<?php echo (isset($devicedetails)) ? $devicedetails[0]['theft_pro_amount']:'' ?>" id="theft_pro_amount" name="theft_pro_amount" placeholder="Enter Theft Protection amount">
                      </div>

                    </div>

                    <div class="col-sm-6 col-md-8">
                      <div class="form-group">
                       <label class="form-label">Description</label>
                        <textarea class="form-control textarea" rows="5" required="true" id="description" autocomplete="off" placeholder="Description"  name="description"><?php echo (isset($devicedetails)) ? $devicedetails[0]['description']:'' ?></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      
                    </div>

                    <div class="col-sm-6 col-md-4">
                      
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
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote({
      height: 180,
    })
  })
</script>
<script>
    $('#is_theft_pro').change(function () {
         var chk = $("#is_theft_pro")
         var IsChecked = chk[0].checked
         if (IsChecked) {
          IsChecked = 1;
          chk.attr('checked', 'checked')
         } 
         else {
          IsChecked =0;
          chk.removeAttr('checked')                            
         }
          chk.attr('value', IsChecked)
     });
</script>