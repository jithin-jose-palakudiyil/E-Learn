var url_prefix ='packages';
$(function() 
{ 
    if( $("#packages_form").length)
    { 
        $('.select').select2(); 
        $('.styled').uniform(); 
         // Primary
    $(".control-primary").uniform({
        wrapperClass: 'border-primary-600 text-primary-800'
    });

        $("#packages_form").validate({
            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'validation-error-label',  successClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element) {  
                if (element.attr("name") == "status" ){  $("#status_err").html(error); } 
                else if (element.attr("name") == "category_id" ){  $("#category_id_err").html(error); } 
                else if (element.attr("name") == "package_image" ){  $("#package_image_error").html(error); } 
                else { error.insertAfter(element); }   
            }, 
            rules: {  
                'category_id':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'status':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'sets':{required:true, normalizer: function(value) { return $.trim(value);  },digits:true }, 
                'questions_in_set':{required:true, normalizer: function(value) { return $.trim(value);  },digits:true }, 
                'validity':{required:true, normalizer: function(value) { return $.trim(value);  },digits:true }, 
                'name':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'price':{required:true, normalizer: function(value) { return $.trim(value);  },number:true }, 
                'package_image':  {  required:true, fileType: { types: ["jpg", "jpeg", "png"] }, maxFileSize: { "unit": "MB",  "size": 5  }, }, 
            }
        });
        $("body").on("click", "#is_offer", function ()
        { 
           if ($(this).is(':checked')) {  
                 $('#offer_price_row').show();
                 $('#offer_price').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } ,number:true} );
           }else{
               $( "#offer_price" ).rules( "remove", "required" );
                $('#offer_price_row').hide();
           }  
        });
     }   
     
/* ------------------------------------------------------------------------- */ 
/* -------------------------------- dataTable ------------------------------ */ 
/* ------------------------------------------------------------------------- */ 

    if($('#packages_list').length)
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
                $('#packages_datatable').show();
                var url=$('#packages_list').attr('data-url');
                if ( $.fn.dataTable.isDataTable( '#packages_list' ) ) 
                {
                    $('#packages_list').DataTable().destroy();
                }
             
                $('#packages_list').DataTable
                ({
                processing: true,
                serverSide: true, 
                "ajax": {
                        url: url,
                        data: { "category_id": value }
                    },
                columns: [ 
                            {
                                data: "name", sortable: true,
                                render: function (data, type, full) {  return  full.name; } 
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
                                 data: "is_publish","searchable": false, sortable: false,className: "text-center",
                                render: function (data, type, full)
                                {  
                                    if(full.is_publish=="1")  { return '<span class="label label-success">published</span>';  }
                                    else if(full.is_publish=="2")  { var d="Onclick='return ConfirmPublish("+full.id+");'"; return '<span '+d+' class="label label-info" style="cursor:pointer;"> publish Now</span>';  }
                                    else if(full.is_publish=="3")  { return '<span class="label label-danger"> published but sets with no.of questions not matching</span>';  }
                                    else if(full.is_publish=="4")  { return '<span class="label label-danger"> not published and sets with no.of questions not matching</span>';  }
                                    return u;
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
                                    \n\<li class="text-success-600" style="margin-right: 15px"  >\n\
                                    <a href="'+base_url+'/'+admin_prefix+'/'+url_prefix+'/sets/'+full.id+'"><i class="icon-briefcase3"></i>\n\
                                    </a>\n\
                                    </li>\n\
                                     </ul>';
                                    return u;
                                } 
                            }
                        ] 
                });
            }
            else{ $('#packages_datatable').hide(); }
        }); 
    }
        
    

});



/* ************************************************************************** */  
/* ******************************* Confirm Delete *************************** */  
/* ************************************************************************** */ 
 function ConfirmDelete(id)
    {  
        Noty.overrideDefaults({
            theme: 'alert alert-success alert-styled-left p-0 bg-danger',
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

/* ************************************************************************** */  
/* ******************************* Confirm Publish *************************** */  
/* ************************************************************************** */ 
 function ConfirmPublish(id)
    {  
        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert' 
        });
       var notyConfirm =  new Noty({
                layout: 'center',
                text: 'Are you sure you want to publish it?',
                type: 'info',
                 buttons: [
                    Noty.button('Cancel', 'btn btn-light', function () {
                        notyConfirm.close();
                    }),

                    Noty.button('Yes <i class="icon-paperplane ml-2"></i>', 'btn bg-slate-600 ml-1', function () {
                        var url=base_url+'/'+admin_prefix+'/'+url_prefix+'/publish/'+id;    
                     
                        $.ajax
                        ({
                            type: 'GET',
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


 


 