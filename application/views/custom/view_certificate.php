<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Certificate
            </h1>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<style>
    .table-bordered td {
       border: 1px solid #dee2e6;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="container-fluid mb-5 row">
        <div class="offset-md-2 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="table no-border">
                        <!-- HEADER SECTION -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="<?php echo base_url(). "assets/uploads/1741938865-truck_sathi_icon.png"; ?>" alt="LOGO">
                                <h3 class="text-primary text-bold text-center mt-4">Proof of Fitment of GPS Vehicle Tracking System</h3>
                            </div>
                        </div>
                        <!-- ADDRESS SECTION -->
                        <div class="row pt-4">
                            <div class="col-md-8"><label>Certificate No.: <?php echo isset($certificateDetails)?$certificateDetails[0]['dc_cerificate_no']:''; ?></label></div>
                            <div class="col-md-4"><label>Date: <?php echo isset($certificateDetails)?date('d-m-Y', strtotime($certificateDetails[0]['dc_cerificate_date'])):''; ?></label></div>
                        </div>
                        
                        <!-- VEHICLE SECTION -->
                        <div class="row pt-4">
                            <div class="col-md-12">
                                <h5 class="text-bold text-primary">Vehicle Details</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm dtr-inline">
                                        <!-- <tbody> -->
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Owner’s Name:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_owner_name']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Vehicle Registration No.:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_vehicle_reg_no']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Chassis No.:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_chassis_no']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Engine No.:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_engine_no']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Vehicle Type:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_vehicle_type']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Model/Make:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_vehicle_model']:''; ?></td>
                                            </tr>
                                        <!-- </tbody> -->
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Device SECTION -->
                        <div class="row pt-4">
                            <div class="col-md-12">
                                <h5 class="text-bold text-primary">Device Details</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm dtr-inline">
                                        <!-- <tbody> -->
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Device IMEI/Serial No.:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_device_serial_no']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Make & Model of Device:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_device_model']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Device Type:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_device_type']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Date of Installation:</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?date('d-m-Y', strtotime($certificateDetails[0]['dc_installation_date'])):''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Installed By (Technician Name):</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_installed_by']:''; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:1px solid; width:50%"><label class="mb-0">Fitted At (Workshop/Dealer):</label></td>
                                                <td style="border:1px solid; width:50%"><?php echo isset($certificateDetails)?$certificateDetails[0]['dc_fitted_at']:''; ?></td>
                                            </tr>
                                        <!-- </tbody> -->
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Device SECTION -->
                        <div class="row pt-4">
                            <div class="col-md-12">
                                <h5 class="text-bold text-primary">Declaration</h5>
                                <span class="text-bold">This is to confirm that the above-mentioned GPS device has been fitted securely in the vehicle and is in proper working condition. The device has been tested for real-time tracking, data transmission, and compliance with applicable standards.</span>
                            </div>
                        </div>

                        <!-- Signature -->
                        <div class="row text-right" style="padding-top:100px">
                            <div class="col-md-12">
                                <span class="text-bold">Authorized Dealer / Installer</br>(Signature & Seal)</span>
                            </div>
                        </div>
                        
                        <!--  -->
                    </div>
                </div>
                <div class="card-footer text-center" style="background-color: rgb(60 141 188);">
                    <div class="row">
                        <div class="col-md-4"><label class="text-white mb-0"><i class="fa fa-globe mr-2"></i>trucksathi.co.in </label></div>
                        <div class="col-md-4"><label class="text-white mb-0"><i class="fa fa-phone mr-2"></i>7802915200</label></div>
                        <div class="col-md-4"><label class="text-white mb-0"><i class="fa fa-envelope mr-2"></i>trucksathi1@gmail.com</label></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->