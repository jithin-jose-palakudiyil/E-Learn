var url_prefix ='question-category';
$(function() 
{ 
    if( $("#QuestionCategory_form").length)
    { 
        $('.select').select2(); 
        $('.styled').uniform(); 
        $("#QuestionCategory_form").validate({
            ignore: 'input[type=hidden]', // ignore hidden fields
            errorClass: 'validation-error-label',  successClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element) {  
                if (element.attr("name") == "status" ){  $("#status_err").html(error); } 
                else { error.insertAfter(element); }   
            }, 
            rules: {  
                'name':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'slug':{required:true, normalizer: function(value) { return $.trim(value);  } }, 
                'status':{required:true, normalizer: function(value) { return $.trim(value);  } }, 

            }
        });
    /* ------------------------------------------------------------------------- */ 
    /* ----------------------------- generate slug------------------------------ */ 
    /* ------------------------------------------------------------------------- */
    
    $("#name").keyup(function() {  $("#slug").val(generate_slug($("#name").val())); });
  
     }   
     
/* ------------------------------------------------------------------------- */ 
/* -------------------------------- dataTable ------------------------------ */ 
/* ------------------------------------------------------------------------- */ 

    if($('#question_category_list').length)
    {    
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

            var url=$('#question_category_list').attr('data-url');
            $('#question_category_list').DataTable
            ({
                processing: true,
                serverSide: true, 
                ajax: url,
                columns: [ 
                            {
                                data: "name", sortable: true,
                                render: function (data, type, full) {  return  full.name; } 
                            },
                            {
                                data: "slug", sortable: true, 
                                render: function (data, type, full) {  return full.slug; } 
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
        
});


/* ************************************************************************** */  
/* ************************Generate Slug*************************** */  
/* ************************************************************************** */ 

function generate_slug(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    $slug = trimmed.replace(/ /g, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}

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

 