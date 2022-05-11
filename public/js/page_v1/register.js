$(function() 
{
    if($("#mobile").length)
    {
        $("#mobile").intlTelInput
        ({
            initialCountry: 'in',localizedCountries:'in',
            separateDialCode: true,
            nationalMode: false,
            allowDropdown: false, 
            utilsScript: base_url+"/public/plugins/intlTelInput/utils.js" // just for formatting/placeholders etc
        });
    }
      
        /* ------------------------------------------------------------------------- */ 
        /* -------------------------- form register validate ----------------------- */ 
        /* ------------------------------------------------------------------------- */
        
        if($("#register_form").length){
            $("#register_form").validate({ 
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        validClass: 'validation-valid-label',
        highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
        unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
        // Different components require proper error label placement
        errorPlacement: function(error, element)
        { 
             
//            
            if (element.attr("name") == "mobile" ){  $("#mob_error").html(error); }
            else if (element.attr("name") == "is_agree" ){  $("#is_agree_error").html(error); }
            else{  error.insertAfter(element);}      
        }, 
        rules: { 
                    'first_name':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    'mobile':{required:true, normalizer: function(value) { return $.trim(value);  }, chkMobile:true },
                    'email':{required:true, normalizer: function(value) { return $.trim(value);  }, 'chkEmail':true },
                    'password':{required:true, normalizer: function(value) { return $.trim(value);  },minlength: 8 },
                    'confirm_password':{required:true, normalizer: function(value) { return $.trim(value);  },'chkPassword':true },
                    'is_agree':{required:true, normalizer: function(value) { return $.trim(value);  } },
                    
                    
                 } 
        });
                           
            /*email validation*/
            $.validator.addMethod("chkEmail", function(value, element) 
            {   
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
                {
                    //check email address exist or not  
                    var obj;
                    var url=base_url+'/ValidateEmail';  
                    $.ajax
                    ({
                        type: 'GET',
                        url: url,
                        dataType: "json",
                        async: false,
                        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data :{'email':value,},
                        success: function(response)
                        {   obj =  $.parseJSON(JSON.stringify(response));  
                        },  error: function (request, textStatus, errorThrown)  {  $.validator.messages.chkEmail='Somthing went wrong.'; }
                    }); 

                    if(obj.status) {  return true;     }
                    else  { $.validator.messages.chkEmail = obj.error; return false;   }    
                } 
                else  {  $.validator.messages.chkEmail = 'Please enter a valid email address';  return false; }
            }, $.validator.messages.chkEmail );
            /* email validation end */
        
            /* Mobile validation */
            $.validator.addMethod("chkMobile", function(value, element) 
            { 
                var intlNumber = $("#mobile").intlTelInput("getNumber");     
                $("#mobile").intlTelInput("setNumber", intlNumber);
                var valid= $("#mobile").intlTelInput("isValidNumber"); 
                if(valid){
                    // check mobile number already exist or not
    //                var intlNumber = $("#mobile").intlTelInput("getNumber"); 

                    var obj;
                    var url=base_url+'/ValidateMobile';  
                    $.ajax
                    ({
                        type: 'GET',
                        url: url,
                        dataType: "json",
                        async: false,
                        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data :{'mobile':$("#mobile").val()},
                        success: function(response)
                        {   obj =  $.parseJSON(JSON.stringify(response));  
                        },  error: function (request, textStatus, errorThrown)  {  $.validator.messages.chkMobile='Somthing went wrong.'; }
                    }); 
                    if(obj.status) {  return true;     }
                    else  { $.validator.messages.chkMobile = obj.error; return false;   }  
                }else { $.validator.messages.chkMobile='Please enter a valid mobile number.'; return false; }

            }, $.validator.messages.chkMobile );
            /* Mobile validation end */

            /*Password validation*/
            $.validator.addMethod("chkPassword", function(value, element) 
            {   
                var ConfirmPassword = $('input[name="confirm_password"]').val();
                var txtPassword = $('input[name="password"]').val();
                if(txtPassword == ConfirmPassword){ return true; }
                else  { $.validator.messages.chkPassword = 'The password  and confirm password is not matching'; return false;   }  

            }, $.validator.messages.chkPassword );
            /* Password validation end */

        }
        /* ---------------------------------------------------------------------- */ 
        /* -------------------------- form otp validate ------------------------- */ 
        /* ---------------------------------------------------------------------- */
        if($("#otp_form").length)
        { 
         
            $("#otp_form").validate({ 
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element)
            { 
                    error.insertAfter(element);          
                 
            }, 
            rules: { 
                        'otp':{required:true, normalizer: function(value) { return $.trim(value);  },digits: true, minlength: 4,maxlength: 4  },
                      

                     } 
            });
            
            
            
 
  
  
      
    
    
    
    if (sessionStorage.getItem("counter")) { 
        if(sessionStorage.getItem("counter") == 0)
        {
            sessionStorage.removeItem("counter");
        }
    } 
    else { sessionStorage.setItem("counter", 120); }
    
  timer(sessionStorage.getItem("counter"));  
  
  
   $(document).on("click","#ResendCode",function() {
         
          
                var url=base_url+'/otp-resend';  
                $.ajax
                ({
                    type: 'GET',
                    url: url,
                    dataType: "json",
                    async: false,
                    headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data :{'resend':1,},
                    success: function(response)
                    {  
                        var obj =  $.parseJSON(JSON.stringify(response)); 
                        if(obj.status)
                        {
                            $("#some_div").show();
                            $("#ResendCode").hide();
                            sessionStorage.setItem("counter", 120);
                            timer(sessionStorage.getItem("counter"));
                        }
                        
                        if(obj.resend_msg)
                        {
                            $("#otp_message").html(obj.resend_msg) 
                        }
                      
                    },  error: function (request, textStatus, errorThrown)  {}
                }); 
                
                
    });
     
    }
  
});
 
 
 
 let timerOn = true;

function timer(remaining) {  
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('some_div').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
         sessionStorage.setItem("counter", remaining);
    }, 1000);
    return;
  }
  else
  {
      $("#ResendCode").show(); 
      $("#some_div").hide();
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
 
 
}





 
   
    
 
//    timer(sessionStorage.getItem("counter"));
//    document.getElementById('divCounter').innerHTML = value;
//
//    var counter = function () {
//      if (value >= 10) {
//        sessionStorage.setItem("counter", 0);
//        value = 0;
//      } else {
//        value = parseInt(value) + 1;
//        sessionStorage.setItem("counter", value);
//      }
//      document.getElementById('divCounter').innerHTML = value;
//    };
//
//    var interval = setInterval(counter, 1000);
