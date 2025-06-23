    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo (isset($appuserdetails))?'Edit App User':'Add App User' ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>/category">App Users</a></li>
              <li class="breadcrumb-item active"><?php echo (isset($appuserdetails))?'Edit App User':'Add App User' ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       	<form method="post" id="myform" class="card">  
          <div class="card-body"> 
                  <div class="row">
                    <?php if(isset($appuserdetails)) { ?>
                      <input type="hidden" name="id" id="id" value="<?php echo (isset($appuserdetails)) ? $appuserdetails[0]['id']:'' ?>" >
                    <?php } ?>
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label class="form-label">Name<span class="text-danger form-required">*</span></label>
                          <input type="text"  class="form-control" value="<?php echo (isset($appuserdetails)) ? $appuserdetails[0]['name']:'' ?>" id="name" name="name" placeholder="Enter Name">
                      </div>
                    </div>
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label class="form-label">Mobile No<span class="text-danger form-required">*</span></label>
                          <input type="number"  class="form-control" value="<?php echo (isset($appuserdetails)) ? $appuserdetails[0]['mobile']:'' ?>" id="mobile" name="mobile" placeholder="Enter Mobile Number">
                      </div>
                    </div>

                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label class="form-label">Pincode<span class="text-danger form-required">*</span></label>
                          <input type="number" class="form-control" value="<?php echo (isset($appuserdetails)) ? $appuserdetails[0]['pincode']:'' ?>" id="pincode" name="pincode" placeholder="Enter Pincode">
                      </div>
                    </div>

                    
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label for="category_id" class="form-label">Category Name</label>
                        <select id="category_id" name="category_id" class="form-control " >
                          <option value="">--Select Here--</option> 
                          <?php if(!empty($categoryData)){
                            foreach ($categoryData as $key => $value) { ?>
                                <option <?php echo (isset($appuserdetails) && $appuserdetails[0]['category_id']==$value['cat_id']) ? 'selected':'' ?> value="<?php echo (isset($appuserdetails) && $appuserdetails[0]['category_id']==$value['cat_id']) ? $appuserdetails[0]['category_id'] : $value['cat_id'] ?>"><?php echo $value['category_head'] ?></option> 
                           <?php } } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-sm-12 offset-md-3 col-md-6">
                      <div class="form-group">
                          <label for="kyc_status" class="form-label">KYC Status</label>
                        <select id="kyc_status" name="kyc_status" class="form-control " required="">
                          <option value="">KYC Status</option> 
                          <option <?php echo (isset($appuserdetails) && $appuserdetails[0]['kyc_status']==1) ? 'selected':'selected' ?> value="1">Active</option> 
                          <option <?php echo (isset($appuserdetails) && $appuserdetails[0]['kyc_status']==0) ? 'selected':'' ?> value="0">Inactive</option> 
                        </select>
                      </div>
                    </div>
                </div>
  
      <div class="modal-footer">
                  <button type="submit" class="btn btn-primary"> <?php echo (isset($appuserdetails))?'Update User':'Add User' ?></button>
      </div>
    </div>
    </form>
             </div>
    </section>
    <!-- /.content -->

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script>
    var baseURL = "<?php echo base_url(); ?>";
    $('#myform').validate({
        rules: {
            name:"required",
            mobile:"required",
            pincode:"required",
            category_id:"required",
        },
        submitHandler: function(form) {
        $.ajax({
            url: baseURL+"app_users/insertApp_user", 
            type: "POST",             
            data: $(form).serialize(),
            success: function(data) {
                // console.log(data);
                if(data == 1)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"app_users"; }, 2000);
                    alertmessage('App User created successfully',1);
                }else if(data == 2)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"app_users"; }, 2000);
                    alertmessage('App User updated successfully',1);
                }else{
                    window.setTimeout(function(){window.location.href = baseURL+"app_users"; }, 2000);
                    alertmessage('Something went wrong',2);
                }
            }
        });
        return false;
    },
    // other options
});
</script>
