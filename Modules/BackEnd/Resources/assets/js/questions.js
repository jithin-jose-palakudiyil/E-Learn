var url_prefix ='questions';
$(function() 
{ 
    if( $("#Question_form").length)
    { 
        $('.select').select2(); 
        $('.styled').uniform(); 
         // Primary
    $(".control-primary").uniform({
        wrapperClass: 'border-primary-600 text-primary-800'
    });

        $("#Question_form").validate({
            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'validation-error-label',  successClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element) {  
                if (element.attr("name") == "status" ){  $("#status_err").html(error); } 
                else if (element.attr("name") == "category_id" ){  $("#category_id_err").html(error); } 
                else if (element.attr("name") == "correct" ){  $("#error_correct").html(error); } 
                else { error.insertAfter(element); }   
            }, 
            rules: {  
                'category_id':{required:true, normalizer: function(value) { return $.trim(value);  } },
                'question':{required:true, normalizer: function(value) { return $.trim(value);  } },  
                'status':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'answer[1]':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'correct':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                

            }
        });
     }   
     
/* ------------------------------------------------------------------------- */ 
/* -------------------------------- dataTable ------------------------------ */ 
/* ------------------------------------------------------------------------- */ 

    if($('#questions_list').length)
    {   
        $('.select').select2(); 
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{ 
                orderable: false,
                width: '100px' 
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });


        $(document.body).on("change","#category_id",function()
        {
            var value =  $(this).val();
            if(value)
            {
               
                var field = 'category_id';
                var uri = window.location.toString();
                if (uri.indexOf("?") > 0) {
                    var clean_uri = uri.substring(0, uri.indexOf("?"));
                    window.history.replaceState({}, document.title, clean_uri);
                }
                location.hash = field+"="+value;
                
                
                var noHashURL = window.location.href.replace('#', '?');
                 window.history.replaceState('', document.title, noHashURL) 
//               window.location.hash.replace("#", "");
                $('#questions_datatable').show();
                var url=$('#questions_list').attr('data-url');
                if ( $.fn.dataTable.isDataTable( '#questions_list' ) ) 
                {
                    $('#questions_list').DataTable().destroy();
                }
             
                $('#questions_list').DataTable
                ({
                processing: true,
                serverSide: true, 
                "ajax": {
                        url: url,
                        data: { "category_id": value }
                    },
                columns: [ 
                            {
                                data: "question", sortable: true,
                                render: function (data, type, full) {  return  full.question; } 
                            }, 
                            {
                                data: "status", sortable: true,  
                                render: function (data, type, full) 
                                { 
                                    if(full.status=="1")  { return '<span class="label label-success">Active</span>';  }
                                    else  { return '<span class="label label-default">Disable</span>'; }
                                } 
                            }, 
                            {
                                 data: "null","searchable": false, sortable: false,className: "text-center",
                                render: function (data, type, full)
                                {  
                                    var d="Onclick='return ConfirmDelete("+full.id+");'";
                                    var  u  = '<ul class="icons-list">\n\
                                    <li class="text-primary-600" style="margin-right: 15px">\n\
                                    <a href="'+base_url+'/'+admin_prefix+'/'+url_prefix+'/'+full.id+'/edit">\n\
                                    <i class="icon-pencil7"></i></a></li>\n\
                                    <li class="text-danger-600" style="margin-right: 15px" '+d+' >\n\
                                    <a href="#"><i class="icon-trash"></i>\n\
                                    </a>\n\
                                    </li>\n\
                                     </ul>';
                                    return u;
                                } 
                            }
                ] 
            });
            }
            else{ $('#questions_datatable').hide(); }
        });
 

        }
        
        
        
        
        
        /* ------------------------------------------------------------------------- */ 
        /* --------------------------------- add more  ----------------------------- */ 
        /* ------------------------------------------------------------------------- */   
  
        $(document.body).on("click",".add_options",function()
        { 
            $(".answer_options tbody tr:last").clone().hide().appendTo('.answer_options:last').show('slow'); //taken clone of the last
            $(".table_row:last").find(".radio label input").remove();
            $(".table_row:last").find(".radio label").html('  <input type="radio" name="correct[]" class="control-primary correct" >');  
            $(".control-primary").uniform({  wrapperClass: 'border-primary-600 text-primary-800' });
            var  rem_btn = '  <button type="button" class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded remove_options"><i class="icon-close2"></i></button>';
           $(".table_row:last .rem_btn").html(rem_btn);
            $(".table_row:last").find(".answer").val('');
            $('.answer_options tbody tr').each(function(index){
                index = parseInt(index)+1; 
                $(this).attr('id','table_row_'+index);
                $(this).find(".answer").attr('name','answer['+(index)+']');
               
                $(this).find(".correct").attr('name','correct');
                $(this).find(".correct").val(index);
                $(this).find(".remove_options").attr('data-row',index);
//                $(this).find(".number_row").html(index);
                $(this).find(".answer").rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } );
            });
            
           
  
        });  
        
        /* ------------------------------------------------------------------------- */ 
        /* --------------------------------- remove -------------------------------- */ 
        /* ------------------------------------------------------------------------- */   
  
        $(document.body).on("click",".remove_options",function()
        {
            var RowRemove = $(this).attr('data-row');
            $('#table_row_'+RowRemove).remove(); 
              $('.answer_options tbody tr').each(function(index){
                index = parseInt(index)+1; 
                $(this).attr('id','table_row_'+index);
                $(this).find(".answer").attr('name','answer['+(index)+']');
//                 $(this).find(".correct").attr('name','correct['+(index)+']');
                $(this).find(".remove_options").attr('data-row',index);
//                $(this).find(".number_row").html(index);
//                $(this).find(".seat_number").rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } );
            });
            
             $('.answer_options tbody tr .answer').each(function(index){
                 $(this).rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } );
             });
            
        });  
        
        

});



/* ************************************************************************** */  
/* ******************************* Confirm Delete *************************** */  
/* ************************************************************************** */ 
 function ConfirmDelete(id)
    {  
        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert' 
        });
       var notyConfirm =  new Noty({
                layout: 'center',
                text: 'Are you sure you want to delete it?',
                type: 'info',
                 buttons: [
                    Noty.button('Cancel', 'btn btn-light', function () {
                        notyConfirm.close();
                    }),

                    Noty.button('Yes <i class="icon-paperplane ml-2"></i>', 'btn bg-slate-600 ml-1', function () {
                        var url=base_url+'/'+admin_prefix+'/'+url_prefix+'/'+id;    
                        $.ajax
                        ({
                            type: 'DELETE',
                            url: url,
                            dataType: "json",
                            async: false,
                            headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            data :{'id':id},
                            success: function(response){  window.location.reload(); },
                            error: function (request, textStatus, errorThrown)  {  }
                            });
                            notyConfirm.close();
                        },
                        {id: 'button1', 'data-status': 'ok'}
                    )
                ]
            }).show();
           return false;
 
         
}


 


 