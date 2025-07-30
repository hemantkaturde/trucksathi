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
                    <form method="post" id="bTypeform">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label">Body type<span class="text-danger form-required">*</span></label>
                                <input type="text" class="form-control" value="<?php echo (isset($btypedetails)) ? $btypedetails[0]['btype_name']: '' ?>" id="btype_name" name="btype_name" placeholder="Enter Body Type">
                            </div>
                            <input type="hidden" name="btype_id" id="btype_id" value="<?php echo (isset($btypedetails)) ? $btypedetails[0]['btype_id']:'' ?>" >
                            
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary"><?php echo (isset($btypedetails)) ? 'UPDATE': 'SAVE' ?></button>
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
                    <table id="view_bodytype" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                        <thead>
                            <tr>
                                <th>Body Type</th>
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