$(document).ready(function () {
    "use strict";
    try {
        $(".tab-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            autoFocus: true,
            titleTemplate: '<span class="number">#index#<\/span> <span class="title">#title#<\/span>',
            labels: {
                finish: "Submit"
            },
            onFinished: function (event, currentIndex) {
                event.preventDefault();

                let route = jQuery('.tab-wizard').attr('action');
                let form_id = jQuery('.tab-wizard').attr('id');

                try {
                    let instance;
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                } catch (exception) {
                    console.log('ck_editor_library_not_found')
                }

                let formData = new FormData(document.getElementById(form_id));

                ajax_form_post(route, formData, form_id)

            }
        });
    } catch (exception) {
        console.log('steps_library_not_found')
    }
});

$('.single-form').on('submit', function(event){
    event.preventDefault();

    let route = jQuery('.single-form').attr('action');
    let form_id = jQuery('.single-form').attr('id');
    let formData = new FormData(document.getElementById(form_id));

    ajax_form_post(route, formData, form_id)

})

function ajax_form_post(route, formData, form_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: route,
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $('#global-loader').show();
        },
        success: function (response) {
            console.log(response)
            toastr.success(response.message);
            let method_name = formData.get('_method');

            if (method_name !== 'PUT' && method_name !== 'DELETE') {
                jQuery(".form-control").val('');
                jQuery(".input-amount-field").val(0);
                jQuery(".select2").click();
                var source = jQuery('#image-source').val()
                jQuery(".preview").attr('src', source);
            }
        },
        complete: function () {
            $('#global-loader').hide();
        },
        error: function (data) {
            toastr.error(data.responseJSON.message);
        }
    });
}

function ajax_post(route, data, set_data_id) {
    "use strict";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: route,
        data: data,
        beforeSend: function () {
            $('#global-loader').show();
        },
        success: function (response) {
            console.log(response)
            if (response.message) {
                toastr.success(response.message);
            }
            if (response.view) {
                $('#' + set_data_id).empty().html(response.view)
            }
        },
        complete: function () {
            $('#global-loader').hide();
        },
    });
}

function ajax_get(route, params, id_array) {
    "use strict";
    $.get({
        url: route,
        dataType: 'json',
        data: params,
        beforeSend: function () {
            $('#global-loader').show();
        },
        success: function (response) {
            id_array.forEach(function (id, index) {
                console.log(id+index)
                $('#' + id).empty().html(response[index])
            });
        },
        complete: function () {
            $('#global-loader').hide();
        },
    });
}

function read_image(input, id) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

//select2 data
$(document).ready(function () {
    "use strict"
    try {
        $('.js-basic-single').select2();
    } catch (exception) {
        console.log('select2_library_not_found')
    }
});

//ckeditor
$(document).ready(function () {
    "use strict"
    try {
        $('.description').ckeditor({
            contentsLangDirection: 'ltr',
        });
    } catch (exception) {
        console.log('ck_editor_library_not_found')
    }
});



//pagination
$(document).ready(function () {
    "use strict"
    try {
        $(".pagination").on('click', 'ul a', function (e) {
            /*e.preventDefault();
            ajax_get($(this).attr('href'),'',['table-rows','pagination']);*/
        });
    } catch (exception) {
        console.log('table_library_not_found')
    }
});

//variant attributes
$(document).ready(function () {
    "use strict"
    $('#variant-attributes').on('change', function () {
        let data = $('#variant-attributes').select2('data');
        let array = [];
        data.forEach(function (item) {
            array.push(item.text)
        });
        let data_obj = {
            'variant_attributes': array
        };
        if (array.length > 0) {
            let base_url = $('meta[name="base-url"]').attr('content');
            ajax_post(base_url + '/ajax/variant-attribute-options', data_obj, 'variant-attributes-options')
        }
    });
});

//disble enter
$(document).ready(function () {
    "use strict"
    $('form input').on('keypress', function(e) {
        return e.which !== 13;
    });
});
