<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Invoice
            </h1>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid mb-5 row">
        <div class="col-md-4 mb-2">
            <a href="<?php echo base_url().'device/device_order'; ?>"><button type="button" class="btn btn-success"><i class="fas fa-reply"></i> Back to device order</button></a>
        </div>
        <div class="offset-md-2 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="table no-border">
                        <!-- HEADER SECTION -->
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?php echo base_url(). "assets/uploads/1741938865-truck_sathi_icon.png"; ?>" alt="LOGO">
                            </div>
                            <div class="col-md-6">
                                <h1 class="text-primary text-bold text-right">TAX INVOICE</h1>
                            </div>
                        </div>
                        <!-- ADDRESS SECTION -->
                        <div class="row pt-4">
                            <div class="col-md-8">
                                <label>TRUCKSATHI</label></br>
                                <label>F-31 , 11/143, ROYAL PLAZA</br>NEAR BUS STOP,</br>SARASWATI, Koita,</br>Patan , Gujarat</br>
                                PIN Code: 384285</br>
                                GSTIN - 24CQHPM1394N1ZD</label>
                            </div>
                            <div class="col-md-4">
                                <label>Invoice No.: #1</label></br>
                                <label>Date: <?php echo date('d-m-Y', strtotime($invoiceData[0]['created_at'])) ; ?></label>
                                <!-- <h1 class="text-primary text-bold text-right">TAX INVOICE</h1> -->
                            </div>
                            <div class="col-md-12 mt-2">
                                <h5 class="text-bold text-primary">CUSTOMER DETAILS</h5>
                                <label>
                                    Customer Name - <?php echo $invoiceData[0]['name']; ?></br>
                                    Company Name - <?php echo $invoiceData[0]['company_name']; ?></br>
                                    Address - <?php echo $invoiceData[0]['address']; ?></br>
                                    Phone - <?php echo $invoiceData[0]['mobile_number']; ?></br>
                                    Email - <?php echo $invoiceData[0]['email']; ?></br>
                                    GSTIN - 
                                </label>
                            </div>
                        </div>

                        <!-- PRODUCT SECTION -->
                        <div class="row pt-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>PRODUCT DETAILS</th>
                                                <th>QTY</th>
                                                <th>PRICE</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($invoiceData as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $value['dv_name']; ?></td>
                                                <td><?php echo $value['device_count']; ?></td>
                                                <td><?php echo '₹ '.$value['device_amount']; ?></td>
                                                <td><?php echo '₹ '.($value['device_count']*$value['device_amount']); ?></td>
                                            </tr>    
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- TOTAL AMOUNT SECTION -->
                        <div class="row pt-4">
                            <div class="offset-md-7 col-md-3">
                                <label for="">GPS PLAN AMOUNT</label>
                            </div>
                            <div class="col-md-2">
                                <label for=""><?php echo '₹ '.$invoiceData[0]['device_amount']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-md-7 col-md-3">
                                <label for="">THEFT PROTECTION COST</label>
                            </div>
                            <div class="col-md-2">
                                <label for=""><?php echo '₹ '.$invoiceData[0]['theft_protection_amount']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-md-7 col-md-3">
                                <label for="">GST (<?php echo '₹ '.round($invoiceData[0]['gst_percentage']); ?>%)</label>
                            </div>
                            <div class="col-md-2">
                                <label for=""><?php echo '₹ '.$invoiceData[0]['gst_value']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-md-7 col-md-5"><hr style="margin: 5px 0 10px;border-width: medium;border-color: grey;"></div>
                        </div>
                        <div class="row">
                            <div class="offset-md-7 col-md-3">
                                <label for="">GRAND TOTAL</label>
                            </div>
                            <div class="col-md-2">
                                <label for=""><?php echo '₹ '.$invoiceData[0]['grand_total']; ?></label>
                            </div>
                        </div>

                        <!-- BANK DETAILS SECTION -->
                        <div class="row pt-2">
                            
                            <div class="col-md-12 mt-2">
                                <h5 class="text-bold text-primary">BANK DETAILS</h5>
                                <label>
                                    Account name: TRUCK SATHI</br>
                                    Account number: 10224976303</br>
                                    Customer ID:- 6606147921</br>
                                    Branch: PATAN</br>
                                    IFSC: IDFB0042361
                                </label>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="card-footer text-center" style="background-color: rgb(60 141 188);">
                    <div class="row p-2" style="background: #164b73;border-radius: 30px;">
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