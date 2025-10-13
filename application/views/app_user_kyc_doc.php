<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">KYC Document
            </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <!-- <li class="breadcrumb-item"><a href="#">App User's</a></li> -->
               <li class="breadcrumb-item active">KYC Document</li>
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
            <?php if($appuserdetails[0]['category_head']=='Driver'){ ?>

                    <!-- USER PHOTO -->
                    <div class="col-4">
                        <div class="card card-primary image">
                            <div class="card-header"><h3 class="card-title">User Photo</h3></div>
                            <div class="card-body p-10">
                                <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/user_photo/'.$appuserdetails[0]['user_photo']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'USER PHOTO : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                                    <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/user_photo/'.$appuserdetails[0]['user_photo']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="USER PHOTO"/>
                                </a>
                            </div>
                        </div>
                    </div>


                  <!-- ADDHAR CARD -->
                    <div class="col-4">
                        <div class="card card-primary image">
                            <div class="card-header"><h3 class="card-title">Addhar Card</h3></div>
                            <div class="card-body p-10">
                                <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/aadhar_card/'.$appuserdetails[0]['aadhar_card']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'Adhar Card : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                                    <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/aadhar_card/'.$appuserdetails[0]['aadhar_card']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="ADDHAR CARD"/>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PAN CARD -->
                    <div class="col-4">
                        <div class="card card-primary image">
                            <div class="card-header"><h3 class="card-title">Pan Card</h3></div>
                            <div class="card-body p-10">
                                <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/pan_card/'.$appuserdetails[0]['pan_card']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'Pan Card : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                                    <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/pan_card/'.$appuserdetails[0]['pan_card']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="PAN CARD"/>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- LICENCE -->
                    <div class="col-4">
                        <div class="card card-primary image">
                            <div class="card-header"><h3 class="card-title">Licence</h3></div>
                            <div class="card-body p-10">
                                <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/licence/'.$appuserdetails[0]['licence']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'Licence : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                                    <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/licence/'.$appuserdetails[0]['licence']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="Licence"/>
                                </a>
                            </div>
                        </div>
                    </div>

           <?php }  ?>


           <?php if($appuserdetails[0]['category_head']=='Owner'){ ?>


              <!-- USER PHOTO -->
                    <div class="col-4">
                        <div class="card card-primary image">
                            <div class="card-header"><h3 class="card-title">User Photo</h3></div>
                            <div class="card-body p-10">
                                <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/user_photo/'.$appuserdetails[0]['user_photo']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'USER PHOTO : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                                    <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/user_photo/'.$appuserdetails[0]['user_photo']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="USER PHOTO"/>
                                </a>
                            </div>
                        </div>
                    </div>


                  <!-- ADDHAR CARD -->
                    <div class="col-4">
                        <div class="card card-primary image">
                            <div class="card-header"><h3 class="card-title">Addhar Card</h3></div>
                            <div class="card-body p-10">
                                <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/aadhar_card/'.$appuserdetails[0]['aadhar_card']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'Adhar Card : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                                    <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/aadhar_card/'.$appuserdetails[0]['aadhar_card']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="ADDHAR CARD"/>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PAN CARD -->
                    <div class="col-4">
                        <div class="card card-primary image">
                            <div class="card-header"><h3 class="card-title">Pan Card</h3></div>
                            <div class="card-body p-10">
                                <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/pan_card/'.$appuserdetails[0]['pan_card']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'Pan Card : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                                    <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/pan_card/'.$appuserdetails[0]['pan_card']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="PAN CARD"/>
                                </a>
                            </div>
                        </div>
                    </div>


            <!-- RC BOOK -->
            <div class="col-4">
                <div class="card card-primary image">
                    <div class="card-header"><h3 class="card-title">RC BOOK</h3></div>
                    <div class="card-body p-10">
                        <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/rc_book/'.$appuserdetails[0]['rc_book']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'RC Book : '.$appuserdetails[0]['rc_book']:'' ?>">
                            <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/rc_book/'.$appuserdetails[0]['rc_book']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="RC Book"/>
                        </a>
                    </div>
                </div>
            </div>


           <?php } ?>
          

            <!-- PAN CARD -->
            <!-- <div class="col-4">
                <div class="card card-primary image">
                    <div class="card-header"><h3 class="card-title">Pan Card</h3></div>
                    <div class="card-body p-10">
                        <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/pan_card/'.$appuserdetails[0]['pan_card']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'Pan Card : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                            <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/pan_card/'.$appuserdetails[0]['pan_card']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="PAN CARD"/>
                        </a>
                    </div>
                </div>
            </div> -->

            <!-- LICENCE -->
            <!-- <div class="col-4">
                <div class="card card-primary image">
                    <div class="card-header"><h3 class="card-title">Licence</h3></div>
                    <div class="card-body p-10">
                        <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/licence/'.$appuserdetails[0]['licence']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'Licence : '.$appuserdetails[0]['aadhar_card']:'' ?>">
                            <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/licence/'.$appuserdetails[0]['licence']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="Licence"/>
                        </a>
                    </div>
                </div>
            </div> -->

            <!-- GST -->
            <!-- <div class="col-4">
                <div class="card card-primary image">
                    <div class="card-header"><h3 class="card-title">GST</h3></div>
                    <div class="card-body p-10">
                        <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/gst/'.$appuserdetails[0]['gst']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'GST : '.$appuserdetails[0]['gst']:'' ?>">
                            <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/gst/'.$appuserdetails[0]['gst']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="gst"/>
                        </a>
                    </div>
                </div>
            </div> -->

            <!-- RC BOOK -->
            <!-- <div class="col-4">
                <div class="card card-primary image">
                    <div class="card-header"><h3 class="card-title">RC BOOK</h3></div>
                    <div class="card-body p-10">
                        <a href="<?php echo (isset($appuserdetails)) ? base_url().'uploads/rc_book/'.$appuserdetails[0]['rc_book']:'' ?>" data-toggle="lightbox" data-title="<?php echo (isset($appuserdetails)) ? 'RC Book : '.$appuserdetails[0]['rc_book']:'' ?>">
                            <img src="<?php echo (isset($appuserdetails)) ? base_url().'uploads/rc_book/'.$appuserdetails[0]['rc_book']:'' ?>" class="img-fluid-thumbnail img-fluid mb-2" alt="RC Book"/>
                        </a>
                    </div>
                </div>
            </div> -->

            <!--  -->

        </div>
   </div>
</section>
<!-- /.content -->
