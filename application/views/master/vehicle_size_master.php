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
        <div class="col-md-5 col-sm-12">

            <div class="card">
                <div class="card-body p-10">
                    <form method="post" id="vehiclesizeform">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label">Vehicle Size<span class="text-danger form-required">*</span></label>
                                <input type="text" class="form-control" value="<?php echo (isset($vehiclesizedetails)) ? $vehiclesizedetails[0]['vsize_name']: '' ?>" id="vsize_name" name="vsize_name" placeholder="Enter vehicle size">
                            </div>
                            <?php if(isset($vehiclesizedetails)){ ?>
                                <input type="hidden" name="vsize_id" id="vsize_id" value="<?php echo (isset($vehiclesizedetails)) ? $vehiclesizedetails[0]['vsize_id']:'' ?>" >
                            <?php } ?>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary"><?php echo (isset($vehiclesizedetails)) ? 'UPDATE': 'SAVE' ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-7 sol-sm-12">
            <div class="card">
                <div class="card-body p-10">
                    <div class="table-responsive">
                    <table id="view_vehiclesize" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                        <thead>
                            <tr>
                                <th>Vehicle size</th>
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
      </div>
   </div>
</section>
<!-- /.content -->
 <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>