var btype_id = $("#btype_id").val();
var tyre_id = $("#tyre_id").val();
var capacity_id = $("#capacity_id").val();

//  INSERT - UPDATE ==== BODY TYPE ====
$('#bTypeform').validate({
        rules: {
            btype_name:"required",
        },
        submitHandler: function(form) {
        $.ajax({
            url: baseURL+"master/insert_bodyType", 
            type: "POST",             
            data: $(form).serialize(),
            success: function(data) {
                if(data == 1)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"bodyType"; }, 2000);
                    alertmessage('Body type added successfully',1);
                }else if(data == 2)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"bodyType"; }, 2000);
                    alertmessage('Body type updated successfully',1);
                }else{
                    window.setTimeout(function(){window.location.href = baseURL+"bodyType"; }, 2000);
                    alertmessage('Something went wrong',2);
                }
            }
        });
        return false;
    },
    // other options
});

//  INSERT - UPDATE ==== TYRE MASTER ====
$('#tyreform').validate({
        rules: {
            tyre_name:"required",
        },
        submitHandler: function(form) {
        $.ajax({
            url: baseURL+"master/insert_tyre", 
            type: "POST",             
            data: $(form).serialize(),
            success: function(data) {
                console.log(data);
                if(data == 1)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"tyre_master"; }, 2000);
                    alertmessage('Tyre added successfully',1);
                }else if(data == 2)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"tyre_master"; }, 2000);
                    alertmessage('Tyre updated successfully',1);
                }else{
                    window.setTimeout(function(){window.location.href = baseURL+"tyre_master"; }, 2000);
                    alertmessage('Something went wrong',2);
                }
            }
        });
        return false;
    },
    // other options
});

//  INSERT - UPDATE ==== TYRE MASTER ====
$('#capacityform').validate({
        rules: {
            capacity:"required",
        },
        submitHandler: function(form) {
        $.ajax({
            url: baseURL+"master/insert_capacity", 
            type: "POST",             
            data: $(form).serialize(),
            success: function(data) {
                console.log(data);
                if(data == 1)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"capacity"; }, 2000);
                    alertmessage('Capacity added successfully',1);
                }else if(data == 2)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"capacity"; }, 2000);
                    alertmessage('Capacity updated successfully',1);
                }else{
                    window.setTimeout(function(){window.location.href = baseURL+"capacity"; }, 2000);
                    alertmessage('Something went wrong',2);
                }
            }
        });
        return false;
    },
    // other options
});

//  INSERT - UPDATE ==== VEHICLE SIZE MASTER ====
$('#vehiclesizeform').validate({
        rules: {
            capacity:"required",
        },
        submitHandler: function(form) {
        $.ajax({
            url: baseURL+"master/insert_vehiclesize", 
            type: "POST",             
            data: $(form).serialize(),
            success: function(data) {
                console.log(data);
                if(data == 1)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"vehicle_size"; }, 2000);
                    alertmessage('Vehicle size added successfully',1);
                }else if(data == 2)
                {
                    window.setTimeout(function(){window.location.href = baseURL+"vehicle_size"; }, 2000);
                    alertmessage('Vehicle size updated successfully',1);
                }else{
                    window.setTimeout(function(){window.location.href = baseURL+"vehicle_size"; }, 2000);
                    alertmessage('Something went wrong',2);
                }
            }
        });
        return false;
    },
    // other options
});