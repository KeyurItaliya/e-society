        if ($("#login_form").length) {
            $("#login_form").validate({
                
                submitHandler: function (form) {
                    $.ajax({
                        type: 'POST',
                        url: 'process/login_process.php',
                        data: new FormData($("#login_form")[0]),
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                window.location.href = 'index.php';  
                            } else {
                                // $('.message_success').prepend(data.message);
                                document.getElementById("error_show").style.display = "block";
                            }
                        }
                    });
                }
            });
        }
             
        if ($("#reset_password").length) {
            $("#reset_password").validate({
                rules: {
                    "email": {
                        required: true,
                        email: true
                    }
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: 'POST',
                        url: 'process/forget_password.php',
                        data: new FormData($("#reset_password")[0]),
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                window.location.href="login.php";
                            } else {
                                $('.message_error').prepend(data.html)
                            }
                        }
                    });
                }
            });
        }

             $(document).ready(function(){
                $('.product_update_id').click(function(){	
                    var modal_id = $(this).data('id');
                    if(modal_id){
                        $.ajax({
                            type: 'POST',
                            url: 'process/product_update_model.php',
                            data: {
                                "modal_id" : modal_id
                            },
                            dataType: 'json',
                            success: function(data){ 
                                $('#show_data').html('');
                                $('#show_data').prepend(data.html);
                            } 
                        });
                    }
                })
            });

            $(document).on("click", '.final_update_id', function(){
                var update_id_value = $('#update_id_value').val();
                var update_img_value = $('#update_img_value').val();
                var product_name = $('#product_name').val();
                var product_price = $('#product_price').val();
                var status = $('#status').val();
                        $.ajax({
                            type: 'POST',
                            url: 'process/product_update_process.php',
                            data: {
                                "update_id_value" : update_id_value,
                                "product_name" : product_name,
                                "product_price" : product_price,
                                "update_img_value" : update_img_value,
                                "status" : status
                            },
                            dataType: 'json',
                                success: function(data){
                                    alert(data.message);
                                    window.location.href = "product.php";
                                    location.reload();
                                }
                            
                        });
                
                });
                
                if ($("#expenses_add").length) {
                    $("#expenses_add").validate({
                        
                        submitHandler: function (form) {
                            $.ajax({
                                type: 'POST',
                                url: 'process/expenses_process.php',
                                data: new FormData($("#expenses_add")[0]),
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    if (data.success) {
                                        // $('.message_success').html(data.message);  
                                        window.location.href = "expenses.php"; 
                                    } else {
                                        $('.message_success').prepend(data.error);
                                    }
                                }
                            });
                        }
                    });
                }

                if ($("#expenses_category_add").length) {
                    $("#expenses_category_add").validate({
                        
                        submitHandler: function (form) {
                            $.ajax({
                                type: 'POST',
                                url: 'process/expenses_category_process.php',
                                data: new FormData($("#expenses_category_add")[0]),
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    if (data.success) {
                                        $('.message_success').html(data.message);  
                                        location.reload(); 
                                    } else {
                                        $('.message_success').prepend(data.error);
                                    }
                                }
                            });
                        }
                    });
                }
         
                if ($("#get_id_delete").length) {
                    $("#get_id_delete").validate({
            
                        submitHandler: function (form) {
                            $.ajax({
                                type: 'POST',
                                url: 'process/delete_value.php',
                                data: new FormData($("#get_id_delete")[0]),
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    if (data.success) {
                                        $('#message_delete').html(data.message);  
                                        // location.reload(); 
                                    }
                                }
                            });
                        }
                    });
                }

                if ($("#choose_add").length) {
                    $("#choose_add").validate({
            
                        submitHandler: function (form) {
                            $.ajax({
                                type: 'POST',
                                url: 'process/choose_process.php',
                                data: new FormData($("#choose_add")[0]),
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    if (data.success) {
                                        $('.message_success').html(data.message);  
                                        location.reload(); 
                                    } else {
                                        $('.message_success').prepend(data.message);
                                    }
                                }
                            });
                        }
                    });
                }
                
                if ($("#member_add").length) {
                    $("#member_add").validate({
            
                        submitHandler: function (form) {
                            $.ajax({
                                type: 'POST',
                                url: 'process/member_add_process.php',
                                data: new FormData($("#member_add")[0]),
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    if (data.success) {
                                        $('.message_success').html(data.message);
                                    } else {
                                        $('.message_success').prepend(data.message);
                                    }
                                }
                            });
                        }
                    });
                }
                if ($("#notice_add").length) {
                    $("#notice_add").validate({
            
                        submitHandler: function (form) {
                            $.ajax({
                                type: 'POST',
                                url: 'process/notice_add_process.php',
                                data: new FormData($("#notice_add")[0]),
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    if (data.success) {
                                        $('.message_success').html(data.message);
                                    } else {
                                        $('.message_success').prepend(data.message);
                                    }
                                }
                            });
                        }
                    });
                }

                if ($("#find_tokan").length) {
                    $("#find_tokan").validate({
                        submitHandler: function (form) {
                            $.ajax({
                                type: 'POST',
                                url: 'process/token_process.php',
                                data: new FormData($("#find_tokan")[0]),
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    if (data.success) {
                                        $('#useer_data').html(data.html);
                                        $('#member_info').modal('show');		
                                    } else {
                                        $('.message_success').prepend(data.message);
                                    }
                                }
                            });
                        }
                    });
                }
              