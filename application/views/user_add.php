    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo (isset($userdetails))?'Edit User':'Add User' ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">User</a></li>
                        <li class="breadcrumb-item active"><?php echo (isset($userdetails))?'Edit User':'Add User' ?>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" id="vehicle_add" class="card basicvalidation"
                action="<?php echo base_url();?>users/<?php echo (isset($userdetails))?'updateuser':'insertuser'; ?>">
                <div class="card-body">


                    <div class="row">
                        <?php if(isset($userdetails)) { ?>
                        <input type="hidden" name="basic[u_id]" id="u_id"
                            value="<?php echo (isset($userdetails)) ? $userdetails[0]['u_id']:'' ?>">
                        <?php } ?>
                        <div class="col-sm-4 col-md-3">
                            <label class="form-label">Name</label>
                            <div class="form-group">
                                <input type="text" name="basic[u_name]" id="u_name" required="true" class="form-control"
                                    placeholder="Name"
                                    value="<?php echo (isset($userdetails)) ? $userdetails[0]['u_name']:'' ?>">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <label class="form-label">Email</label>
                            <div class="form-group">
                                <input type="text" name="basic[u_email]" id="u_email" required="true"
                                    class="form-control" placeholder="Email"
                                    value="<?php echo (isset($userdetails)) ? $userdetails[0]['u_email']:'' ?>">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <label class="form-label">User Name</label>
                            <div class="form-group">
                                <input type="text" name="basic[u_username]" id="u_username" required="true"
                                    class="form-control" placeholder="User Name"
                                    value="<?php echo (isset($userdetails)) ? $userdetails[0]['u_username']:'' ?>">
                            </div>
                        </div>
                        <?php if(!isset($userdetails[0]['u_password'])) { ?>
                        <div class="col-sm-4 col-md-3">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="text" name="basic[u_password]" required="true"
                                    value="<?php echo (isset($userdetails)) ? $userdetails[0]['u_password']:'' ?>"
                                    class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(isset($userdetails[0]['u_isactive'])) { ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="u_isactive" class="form-label">User Status</label>
                                <select id="u_isactive" name="basic[u_isactive]" class="form-control " required="">
                                    <option value="">Select User Status</option>
                                    <option
                                        <?php echo (isset($userdetails) && $userdetails[0]['u_isactive']==1) ? 'selected':'' ?>
                                        value="1">Active</option>
                                    <option
                                        <?php echo (isset($userdetails) && $userdetails[0]['u_isactive']==0) ? 'selected':'' ?>
                                        value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <?php } ?>
                    </div>
                    <hr>
                    <div class="form-label"><b>User Permission's </b></div><br>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 table-responsive">
                            <table class="table no-border">
                                <tr>
                                    <td><label class="form-label">Device Master</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['dm_list'])) { echo ($userdetails[0]['dm_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[dm_list]" class="custom-control-input"
                                                id="dm_list">
                                            <label class="custom-control-label" for="dm_list">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['dm_list'])) { echo ($userdetails[0]['dm_edit']==1 ? 'checked' : ''); } ?>
                                                name="permissions[dm_edit]" class="custom-control-input"
                                                id="dm_edit">
                                            <label class="custom-control-label" for="dm_edit">Edit</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['dm_del'])) { echo ($userdetails[0]['dm_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[dm_del]" class="custom-control-input" id="dm_del">
                                            <label class="custom-control-label" for="dm_del">Delete</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['dm_list'])) { echo ($userdetails[0]['dm_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[dm_add]" class="custom-control-input" id="dm_add">
                                            <label class="custom-control-label" for="dm_add">Add New</label>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><label class="form-label">Category Master</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['cm_list'])) { echo ($userdetails[0]['cm_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[cm_list]" class="custom-control-input"
                                                id="cm_list">
                                            <label class="custom-control-label" for="cm_list">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['cm_list'])) { echo ($userdetails[0]['cm_edit']==1 ? 'checked' : ''); } ?>
                                                name="permissions[cm_edit]" class="custom-control-input"
                                                id="cm_edit">
                                            <label class="custom-control-label" for="cm_edit">Edit</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['cm_del'])) { echo ($userdetails[0]['cm_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[cm_del]" class="custom-control-input" id="cm_del">
                                            <label class="custom-control-label" for="cm_del">Delete</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['cm_list'])) { echo ($userdetails[0]['cm_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[cm_add]" class="custom-control-input" id="cm_add">
                                            <label class="custom-control-label" for="cm_add">Add New</label>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><label class="form-label">Vehicle</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_list]" class="custom-control-input" id="lr_vech_list">
                                            <label class="custom-control-label" for="lr_vech_list">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_list_view']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_list_view]" class="custom-control-input"
                                                id="lr_vech_list_view">
                                            <label class="custom-control-label" for="lr_vech_list_view">Detail View</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_list_edit']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_list_edit]" class="custom-control-input"
                                                id="lr_vech_list_edit">
                                            <label class="custom-control-label" for="lr_vech_list_edit">Edit</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_add]" class="custom-control-input" id="lr_vech_add">
                                            <label class="custom-control-label" for="lr_vech_add">Add</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_del]" class="custom-control-input" id="lr_vech_del">
                                            <label class="custom-control-label" for="lr_vech_del">Delete</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Vehicle Group</label></td>
                                    
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_group']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_group]" class="custom-control-input" id="lr_vech_group">
                                            <label class="custom-control-label" for="lr_vech_group">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_group_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_group_add]" class="custom-control-input"
                                                id="lr_vech_group_add">
                                            <label class="custom-control-label" for="lr_vech_group_add">Add New</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_group_action']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_group_action]" class="custom-control-input"
                                                id="lr_vech_group_action">
                                            <label class="custom-control-label" for="lr_vech_group_action">Delete</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Driver</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_drivers_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_drivers_list]" class="custom-control-input"
                                                id="lr_drivers_list">
                                            <label class="custom-control-label" for="lr_drivers_list">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_drivers_list_edit']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_drivers_list_edit]" class="custom-control-input"
                                                id="lr_drivers_list_edit">
                                            <label class="custom-control-label" for="lr_drivers_list_edit">Edit</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_driver_del'])) { echo ($userdetails[0]['lr_driver_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_driver_del]" class="custom-control-input" id="lr_driver_del">
                                            <label class="custom-control-label" for="lr_driver_del">Delete</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_drivers_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_drivers_add]" class="custom-control-input" id="lr_drivers_add">
                                            <label class="custom-control-label" for="lr_drivers_add">Add New</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Bookings</label></td>
                                    
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_trips_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_trips_list]" class="custom-control-input" id="lr_trips_list">
                                            <label class="custom-control-label" for="lr_trips_list">All Bookings</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_trips_list_edit']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_trips_list_edit]" class="custom-control-input"
                                                id="lr_trips_list_edit">
                                            <label class="custom-control-label" for="lr_trips_list_edit">Edit</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_trips_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_trips_add]" class="custom-control-input" id="lr_trips_add">
                                            <label class="custom-control-label" for="lr_trips_add">Add New</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_booking_del'])) { echo ($userdetails[0]['lr_booking_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_booking_del]" class="custom-control-input" id="lr_booking_del">
                                            <label class="custom-control-label" for="lr_booking_del">Delete</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Customer</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_cust_list'])) { echo ($userdetails[0]['lr_cust_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_cust_list]" class="custom-control-input" id="lr_cust_list">
                                            <label class="custom-control-label" for="lr_cust_list">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_cust_edit'])) { echo ($userdetails[0]['lr_cust_edit']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_cust_edit]" class="custom-control-input" id="lr_cust_edit">
                                            <label class="custom-control-label" for="lr_cust_edit">Edit</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_cust_add'])) { echo ($userdetails[0]['lr_cust_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_cust_add]" class="custom-control-input" id="lr_cust_add">
                                            <label class="custom-control-label" for="lr_cust_add">Add New</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_cust_del'])) { echo ($userdetails[0]['lr_cust_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_cust_del]" class="custom-control-input" id="lr_cust_del">
                                            <label class="custom-control-label" for="lr_cust_del">Delete</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Fuel</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_fuel_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_fuel_list]" class="custom-control-input" id="lr_fuel_list">
                                            <label class="custom-control-label" for="lr_fuel_list">Fuel List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_fuel_edit']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_fuel_edit]" class="custom-control-input" id="lr_fuel_edit">
                                            <label class="custom-control-label" for="lr_fuel_edit">Edit</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_fuel_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_fuel_add]" class="custom-control-input" id="lr_fuel_add">
                                            <label class="custom-control-label" for="lr_fuel_add">Add New</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_fuel_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_fuel_del]" class="custom-control-input" id="lr_fuel_del">
                                            <label class="custom-control-label" for="lr_fuel_del">Delete</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Reminder</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_reminder_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_reminder_list]" class="custom-control-input"
                                                id="lr_reminder_list">
                                            <label class="custom-control-label" for="lr_reminder_list">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_reminder_delete']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_reminder_delete]" class="custom-control-input"
                                                id="lr_reminder_delete">
                                            <label class="custom-control-label" for="lr_reminder_delete">Delete</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_reminder_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_reminder_add]" class="custom-control-input"
                                                id="lr_reminder_add">
                                            <label class="custom-control-label" for="lr_reminder_add">Add New</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_reminder_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_reminder_del]" class="custom-control-input"
                                                id="lr_reminder_del">
                                            <label class="custom-control-label" for="lr_reminder_del">Delete</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Income Expense</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_ie_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_ie_list]" class="custom-control-input" id="lr_ie_list">
                                            <label class="custom-control-label" for="lr_ie_list">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_ie_edit']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_ie_edit]" class="custom-control-input" id="lr_ie_edit">
                                            <label class="custom-control-label" for="lr_ie_edit">Edit</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_ie_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_ie_add]" class="custom-control-input" id="lr_ie_add">
                                            <label class="custom-control-label" for="lr_ie_add">Add New</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_ie_del']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_ie_del]" class="custom-control-input" id="lr_ie_del">
                                            <label class="custom-control-label" for="lr_ie_del">Delete</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Maintenace</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_maintenace']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_maintenace]" class="custom-control-input" id="lr_maintenace">
                                            <label class="custom-control-label" for="lr_maintenace">Maintenace</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_maintenace_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_maintenace_add]" class="custom-control-input"
                                                id="lr_maintenace_add">
                                            <label class="custom-control-label" for="lr_maintenace_add">Maintenace Add</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Availablity</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_vech_availablity']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_vech_availablity]" class="custom-control-input"
                                                id="lr_vech_availablity">
                                            <label class="custom-control-label" for="lr_vech_availablity">Availablity</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Tracking</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_tracking']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_tracking]" class="custom-control-input" id="lr_tracking">
                                            <label class="custom-control-label" for="lr_tracking">History Tracking</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_liveloc']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_liveloc]" class="custom-control-input" id="lr_liveloc">
                                            <label class="custom-control-label" for="lr_liveloc">Live Location</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Geofence</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_geofence_add']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_geofence_add]" class="custom-control-input"
                                                id="lr_geofence_add">
                                            <label class="custom-control-label" for="lr_geofence_add">Add</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_geofence_list']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_geofence_list]" class="custom-control-input"
                                                id="lr_geofence_list">
                                            <label class="custom-control-label" for="lr_geofence_list">All List</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_geofence_delete']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_geofence_delete]" class="custom-control-input"
                                                id="lr_geofence_delete">
                                            <label class="custom-control-label" for="lr_geofence_delete">Delete</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_geofence_events']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_geofence_events]" class="custom-control-input"
                                                id="lr_geofence_events">
                                            <label class="custom-control-label" for="lr_geofence_events">Events</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Reports</label></td>                                    
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_reports']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_reports]" class="custom-control-input" id="lr_reports">
                                            <label class="custom-control-label" for="lr_reports">View Reports</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="form-label">Settings</label></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1"
                                                <?php if(isset($userdetails[0]['lr_vech_list'])) { echo ($userdetails[0]['lr_settings']==1 ? 'checked' : ''); } ?>
                                                name="permissions[lr_settings]" class="custom-control-input" id="lr_settings">
                                            <label class="custom-control-label" for="lr_settings">All Settings</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <?php echo (isset($userdetails))?'Update User':'Add User' ?></button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->