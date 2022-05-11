var url_prefix ='questions';
$(function() 
{ 
       $('.select').select2(); 
        $('.styled').uniform(); 
         // Primary
    $(".control-primary").uniform({
        wrapperClass: 'border-primary-600 text-primary-800'
    });
    
        $("body").on("click", "#is_negative_mark", function ()
        { 
           if ($(this).is(':checked')) {  
                 $('#negative_mark_row').show();
                 $('#negative_mark').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } ,number:true} );
           }else{
               $( "#negative_mark" ).rules( "remove", "required" );
                $('#negative_mark_row').hide();
           }  
        });
        
//        alert(questions_in_set );

  $("#set_questions").validate({
            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'validation-error-label',  successClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element) {  
                if (element.attr("name") == "questions[]" ){  $("#questions_error").html(error); } 
//                else if (element.attr("name") == "sets" ){  $("#error_correct").html(error); } 
                else { error.insertAfter(element); }   
            }, 
            rules: {  
                'questions[]':{required:true, normalizer: function(value) { return $.trim(value);  }, 'chk_questions_in_set':true  }, 
                
            }
        });
          /*Password validation*/
            $.validator.addMethod("chk_questions_in_set", function(value, element) 
            {   
                var questions = $('input[name="questions[]"]:checked').length;
                 
                if(questions > questions_in_set)
                {
                    $.validator.messages.chk_questions_in_set = 'The selected questions not more than '+questions_in_set; return false;   
                }else{
                  return true;
                }
            }, $.validator.messages.chk_questions_in_set );
            /* Password validation end */

        
});


