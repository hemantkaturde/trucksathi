<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update certificate</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>/device">GPS Device Order</a></li>
              <li class="breadcrumb-item active">Update certificate</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <style>
        hr{
            border-color: #fff;
            height: 25px;
            box-shadow: 0 10px 10px -10px #333;
        }
    </style>
    <?php error_reporting(E_ALL);
ini_set('display_errors', 1);
 //$count = $certDetails[0]['device_count']; ?>
    <section class="content">
        <div class="container-fluid">
       	<form method="post" id="order_certificate_update" class="card" enctype="multipart/form-data" action="<?php echo base_url();?>device/certificate_update">  
            <input type="hidden" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d h:i:s'); ?>">
            <input type="hidden" id="dc_orderid" name="dc_orderid" value="<?php echo $certDetails[0]['dc_orderid']; ?>">
            <input type="hidden" id="dc_userid" name="dc_userid" value="<?php echo $certDetails[0]['dc_userid']; ?>">
            <input type="hidden" id="dc_deviceid" name="dc_deviceid" value="<?php echo $certDetails[0]['dc_deviceid']; ?>">
            <input type="hidden" id="dc_id" name="dc_id" value="<?php echo $certDetails[0]['dc_id']; ?>">
            <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Certificate No.<span class="text-danger form-required">*</span></label>
                                <input type="text" required="true" class="form-control" id="dc_cerificate_no" name="dc_cerificate_no" value="<?php echo isset($certDetails)?$certDetails[0]['dc_cerificate_no']:'' ?>" placeholder="Enter certificate no">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Certificate Date<span class="text-danger form-required">*</span></label>
                                <input type="text" required="true" class="form-control date" id="dc_certificate_date" name="dc_certificate_date" value="<?php echo isset($certDetails)?date('d-m-Y', strtotime($certDetails[0]['dc_certificate_date'])):'' ?>" placeholder="Enter certificate date"/>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3"><h5 class="text-bold text-primary">Vehicle Details</h5></div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Owner's Name<span class="text-danger form-required">*</span></label>
                                <input type="text" required="true" class="form-control" id="dc_owner_name" name="dc_owner_name" value="<?php echo isset($certDetails)?$certDetails[0]['dc_owner_name']:'' ?>" placeholder="Enter owner's name">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Vehicle Registration No.<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_vehicle_reg_no" name="dc_vehicle_reg_no" value="<?php echo isset($certDetails)?$certDetails[0]['dc_vehicle_reg_no']:'' ?>" placeholder="Enter vehicle registation no">
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Chassis No.<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_chassis_no" name="dc_chassis_no" value="<?php echo isset($certDetails)?$certDetails[0]['dc_chassis_no']:'' ?>" placeholder="Enter chassis no">
                        </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Engine No.<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_engine_no" name="dc_engine_no" value="<?php echo isset($certDetails)?$certDetails[0]['dc_engine_no']:'' ?>" placeholder="Enter engine no">
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Vehicle Type<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_vehicle_type" name="dc_vehicle_type" value="<?php echo isset($certDetails)?$certDetails[0]['dc_vehicle_type']:'' ?>" placeholder="Enter vehicle type">
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Model/Make<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_vehicle_model" name="dc_vehicle_model" value="<?php echo isset($certDetails)?$certDetails[0]['dc_vehicle_model']:'' ?>" placeholder="Enter Model">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3"><h5 class="text-bold text-primary">Device Details</h5></div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Device IMEI/Serial No.<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_device_serial_no" name="dc_device_serial_no" value="<?php echo isset($certDetails)?$certDetails[0]['dc_device_serial_no']:'' ?>" placeholder="Enter device serial no">
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Make & Model of Device<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_device_model" name="dc_device_model" value="<?php echo isset($certDetails)?$certDetails[0]['dc_device_model']:'' ?>" placeholder="Enter model of device">
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Device Type<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_device_type" name="dc_device_type" value="<?php echo isset($certDetails)?$certDetails[0]['dc_device_type']:'' ?>" placeholder="Enter device type">
                        </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Date of Installation<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control date" id="dc_installation_date" name="dc_installation_date" value="<?php echo isset($certDetails)?$certDetails[0]['dc_installation_date']:'' ?>" placeholder="Enter date of installation">
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Installed By(Technician Name)<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_installed_by" name="dc_installed_by" value="<?php echo isset($certDetails)?$certDetails[0]['dc_installed_by']:'' ?>" placeholder="Enter Technician Name">
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Fitted At(Workshop/Dealer)<span class="text-danger form-required">*</span></label>
                            <input type="text" required="true" class="form-control" id="dc_fitted_at" name="dc_fitted_at" value="<?php echo isset($certDetails)?$certDetails[0]['dc_fitted_at']:'' ?>" placeholder="Enter Workshop/Dealer">
                        </div>
                        </div>
                    </div>
            </div>
            <!-- <hr> -->
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> UPDATE</button>
            </div>
        </form>
        </div>
    </section>
    <!-- /.content -->
