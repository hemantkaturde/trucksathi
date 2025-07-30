var btype_id = $("#btype_id").val();
console.log(btype_id);
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
                console.log(data);
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