//Dashboard Widgets

//Model actions
function dismiss_model(element) {
    $('#' + element).modal('toggle');
}

//Date Comparsions
function compare_with_other_date(date1, date2, lable1 = "other date", lable2 = "other date") {
    var first_date = new Date($("#"+date1).val());
    var second_date = new Date($("#"+date2).val());

    if(first_date > second_date){
        $("#"+date2).val("");
        // $("#"+date2).text("");
        toastr.warning(lable2 + " should be greater than " + lable1);
    }
}

//File validation
function valid_ext(element) {
    var img_ext = $(element).val().split('.').pop().toLowerCase();
    if ($.inArray(img_ext, ['pdf', 'doc', 'docx', 'csv', 'xslx', 'xlsx']) == -1) {
        $(element).val('');
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'invalid format',
    });
    }
    if(element.files.length >0 && element.files[0].size > 10000000) {
        toastr.error("Please upload file less than 10MB.");
        $(element).val('');
    }
}

//File validation
function valid_ext_with_image(element) {
    var img_ext = $(element).val().split('.').pop().toLowerCase();
    if ($.inArray(img_ext, ['pdf', 'doc', 'docx', 'csv', 'xslx', 'xlsx', 'jpeg', 'jpg', 'png']) == -1) {
        $(element).val('');
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'invalid format',
    });
    }
    if(element.files.length >0 && element.files[0].size > 10000000) {
        toastr.error("Please upload file less than 10MB.");
        $(element).val('');
    }
}

function valid_ext_image_only(element) {
    var img_ext = $(element).val().split('.').pop().toLowerCase();
    if ($.inArray(img_ext, ['jpeg', 'jpg', 'png']) == -1) {
        $(element).val('');
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'invalid format',
    });
    }
    if(element.files.length >0 && element.files[0].size > 10000000) {
        toastr.error("Please upload file less than 10MB.");
        $(element).val('');
    }
}

function valid_ext_video_only(element) {
    var img_ext = $(element).val().split('.').pop().toLowerCase();
    if ($.inArray(img_ext, ['mp4', 'mkv', 'avi']) == -1) {
        $(element).val('');
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'invalid format',
    });
    }
    if(element.files.length >0 && element.files[0].size > 10000000) {
        toastr.error("Please upload file less than 10MB.");
        $(element).val('');
    }
}

//File validation
function delete_confirm() {
    confirm("Are you confirm to delete!");
}

//Phone plugin
function intiPhonePlugin(className) {
    if (className.length !== 0) {
        for (var i = 0; i < className.length; i++) {
            var slides = document.getElementsByClassName(className[i]);
            if (slides.length !== 0) {
                for (var z = 0; z < slides.length; z++) {
                    var input = slides[z];
                    input.addEventListener('click', digitValidate(input));
                    var iti = window.intlTelInput(input, {
                        separateDialCode: true
                    });
                    iti.setCountry("pk");
                }
            }
        }
    }
};

//DataTable plugin
function intiDataTablePlugin(className) {
    if ($("." + className).length) {
        var elements = $('.' + className);
        for(var i=0;i<elements.length; i++){
            var element = elements.eq(i);
            $(element).DataTable();
        }
    }
};

//Tinymce plugin
function intiTinymcePlugin(className) {
    if ($("." + className).length) {
        tinymce.init({
            selector: 'textarea.' + className,
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            },
            height: 300,
            menubar: true,
            branding: false,
            dataType: "jsonp",
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount', 'image'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    }
};

//Init Select 2
if ($(".select-2").length) {
    $('.select-2').selectize();
}


$(".js-disabled-multi-select").select2();
$(".js-example-disabled-multi").select2();

if ($(".js-disabled-multi-select").length) {
    $(".js-disabled-multi-select").prop("disabled", true);
    // $(".js-example-disabled-multi").prop("disabled", true);
}

if ($(".select-2-multi").length) {
    $(".select-2-multi").selectize({
        create: false,
        delimiter: ',',
        hideSelected: true,
        plugins: ['remove_button']
    });
}

if ($(".select2-multi").length) {
    $(".select2-multi").select2();
}

//Init Date Picker
if ($(".date_picker").length) {
    intiDatePickerPlugin('date_picker');
}

//Init Date Time Picker
if ($(".date_time_picker").length) {
    intiDateTimePickerPlugin('date_time_picker');
}

//Init Tinymce
if ($(".tinymce-editor").length) {
    intiTinymcePlugin('tinymce-editor');
}

//no spave validation jquery
jQuery.validator.addMethod("noSpace", function(value, element) {
    return value.indexOf(" ") < 0 && value != "";
  }, "No space please and don't leave it empty");

function intiTinymceNewPlugin(className) {
    if ($("." + className).length) {
        tinymce.init({
            selector: 'textarea.' + className,
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            },
            height: 200,
            menubar: true,
            branding: false,
            dataType: "jsonp",
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount', 'image'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            // content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    }
};

function showPassword(element_id) {
    var x = document.getElementById(element_id);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

//DatePicker plugin
function intiDatePickerPlugin(className) {
    if ($("." + className).length) {
        var elements = $('.' + className);
        for(var i=0;i<elements.length; i++){
            var element = elements.eq(i);
            if(!element.data('date_picker')) {
                element.attr('type', "text");
                element.datepicker('destroy').datepicker({
                    uiLibrary: 'bootstrap4',
                    dateFormat: 'yy-mm-dd'
                });
                element.prop('readonly', true);
            }
        }
    }
};

//CurrentDatePicker plugin
function intiCurrentDatePickerPlugin(className) {
    if ($("." + className).length) {
        var elements = $('.' + className);
        for(var i=0;i<elements.length; i++){
            var element = elements.eq(i);
            if(!element.data('date_picker')) {
                element.attr('type', "text");
                element.datepicker({
                    uiLibrary: 'bootstrap4',
                    dateFormat: 'yy-mm-dd',
                });
            }
            element.prop('readonly', true);
        }
    }
};

//DateTimePicker plugin
function intiDateTimePickerPlugin(className) {
    if ($("." + className).length) {
        var elements = $('.' + className);
        for(var i=0;i<elements.length; i++){
            var element = elements.eq(i);
            if(!element.data('date_time_picker')) {
                element.attr('type', "text");
                element.datetimepicker('destroy').datetimepicker({
                    uiLibrary: 'bootstrap4',
                    format:false,
                });
                element.prop('readonly', true);
            }
        }
    }
};

//Allow digits only to type
function digitValidate(element) {
    element.value = element.value.replace(/\D/g,'');
    function inputValidate() {
        element.value = element.value.replace(/\D/g,'');
    }

    element.addEventListener('input', inputValidate);
    element.addEventListener('onkeypress', inputValidate);
    element.addEventListener('onkeyup', inputValidate);
    element.addEventListener('onkeydown', inputValidate);
    element.addEventListener('onchange', inputValidate);
}

//remove element
function removeDiv(element) {
    $('#' + element).remove();
}

//Ajax formdata to ajax
function getAllFieldsInFormDataFormat(form) {
    var form_data = new FormData();
    var $textfields = $('#'+form + ' :input[type=text]');
    var $passwordfields = $('#'+form + ' :input[type=password]');
    var $urlfields = $('#'+form + ' :input[type=url]');
    var $datefields = $('#'+form + ' :input[type=date]');
    var $datetime_localfields = $('#'+form + ' :input[type=datetime-local]');
    var $checkboxfields = $('#'+form + ' :input[type=checkbox]');
    var $radiofields = $('#'+form + ' :input[type=radio]');
    var $hiddenfields = $('#'+form + ' :input[type=hidden]');
    var $select = $('#'+form + ' select');
    var $numberfields = $('#'+form + ' :input[type=number]');
    var $emailfields = $('#'+form + ' :input[type=email]');
    var $filefields = $('#'+form + ' :input[type=file]');
    var $textareafields = $('#'+form + ' textarea');

    $textfields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $passwordfields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $urlfields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $datefields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $datetime_localfields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $checkboxfields.each(function() {
        if(this.checked == true) {
            form_data.append(this.name, $(this).val());
        }
    });
    $radiofields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $hiddenfields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $select.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $numberfields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $emailfields.each(function() {
        form_data.append(this.name, $(this).val());
    });
    $filefields.each(function() {
        form_data.append(this.name, $(this).prop('files')[0]);
    });
    $textareafields.each(function() {
        form_data.append(this.name, $(this).val());
    });

    return form_data;
}

function checkBoxValidation(checkBox) {
    if (checkBox.checked == true){
        checkBox.value = 1;
    } else {
        checkBox.value = 0;
    }
}

mobile_mask();
phone_mask();
cnic_mask();

function mobile_mask()
{
    var items_mobile_mask = document.getElementsByClassName('mobile_mask');
    Array.prototype.forEach.call(items_mobile_mask, function(element)
    {
        var mobileMask = new IMask(element,
        {
            mask: '+{92}(000)0000000',
            placeholder:
            {
                show: 'always'
            }
        });
    });
}

function phone_mask()
{
    var items_phone_mask = document.getElementsByClassName('phone_mask');
    Array.prototype.forEach.call(items_phone_mask, function(element)
    {
        var phoneMask = new IMask(element,
        {
            mask: '+{92}(00)00000000',
            placeholder:
            {
                show: 'always'
            }
        });
    });
}

function cnic_mask()
{
    var cnic_mask = document.getElementsByClassName('cnic_mask');

    Array.prototype.forEach.call(cnic_mask, function(element)
    {
        var cnicMask = new IMask(element,
        {
            mask: '00000-0000000-0',
            placeholder:
            {
                show: 'always'
            }
        });
    });
}

function pkr_currency_mask()
{
    var pkr_currency = document.getElementsByClassName('pkr_currency_mask');

    // Array.prototype.forEach.call(pkr_currency, function(element)
    // {
    //     var pkrCurrencyMask = new IMask(element,
    //     {
    //         mask: '$num',
    //         blocks: {
    //             num: {
    //             // nested masks are available!
    //             mask: Number,
    //             thousandsSeparator: ' '
    //             }
    //         }
    //     });
    // });
}

function number_mask()
{
    var number_mask = document.getElementsByClassName('number_mask');
}

//owl carosuel
function initOwlCarosuel(element) {
    $(element).owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        autoplay: true,
        autoplayTimeout: '2000',
        responsive: {
            0: {
            items: 1
            },
            600: {
            items: 2
            },
            1000: {
            items: 3
            }
        }
    });
}

function initBlogOwlCarosuel(element) {
    var owl = $(element).owlCarousel({
        nav: true,
        loop: true,
        dots: false,
        margin: 5,
        autoplay: true,
        autoplayTimeout: '3000',
        navContainer: '#nav',
        autoplayHoverPause:true,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:2,
                nav:true
            },
            1200:{
                items:4,
                nav:true
            },
            1366:{
                items:4,
                nav:true
            },
            1440:{
                items:4,
                nav:true
            }
        }
    });

    return owl;
}

function initEventOwlCarosuel(element) {
    var owl = $(element).owlCarousel({
        nav: true,
        loop: true,
        dots: false,
        margin: 5,
        autoplay: true,
        autoplayTimeout: '3000',
        navContainer: '#nav',
        autoplayHoverPause:true,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:4,
                nav:true
            },
            1200:{
                items:4,
                nav:true
            },
            1366:{
                items:4,
                nav:true
            },
            1440:{
                items:4,
                nav:true
            }
        }
    });

    return owl;
}

function initInnovationOwlCarosuel(element) {
    var owl = $(element).owlCarousel({
        nav: true,
        loop: true,
        dots: false,
        margin: 5,
        autoplay: true,
        autoplayTimeout: '3000',
        navContainer: '#nav',
        autoplayHoverPause:true,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:3,
                nav:true
            },
            1200:{
                items:3,
                nav:true
            },
            1366:{
                items:3,
                nav:true
            },
            1440:{
                items:3,
                nav:true
            }
        }
    });

    return owl;
}

function initEmployeesOwlCarosuel(element) {
    var owl = $(element).owlCarousel({
        nav: true,
        loop: true,
        dots: false,
        margin: 5,
        // autoWidth:true,
        autoplay: true,
        autoplayTimeout: '3000',
        navContainer: '#nav',
        autoplayHoverPause:true,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ],
        responsive:{
            0:{
                items:1
            },
            767:{
                items:1,
                nav:true
            }
        }
    });

    return owl;
}

//Get File to element
const srcToFile = async (src, fileName, element_id) => {
    const response = await axios.get(src + "#toolbar=0", {
        responseType: "blob",
    });
    var fileName = src.replace(/^.*[\\\/]/, '');
    const mimeType = response.headers["content-type"];
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(new File([response.data], fileName, { type: mimeType, }));//your file(s) reference(s)
    document.getElementById(element_id).files = dataTransfer.files;
};

function dataURLtoFile(dataurl, filename) {

    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }

    return new File([u8arr], filename, {type:mime});
}

const base64ToFile = async (id, element_id) => {
    // For Live Server
    var base_url = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '') + "/";
    //For Localhost
    if(base_url.includes("localhost")) {
        base_url = "http://localhost/hec_administrative/public/";
    }

    var form_data = new FormData();
    form_data.append('id', id);
    form_data.append("_token", $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        url: base_url + "get-image-blob",
        method:"POST",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success:function(res) {
            try {
                const obj = JSON.parse(res);
                if(obj.success == true) {
                    var fileName = obj.data.name;
                    const mimeType = obj.data.type;

                    var file = dataURLtoFile("data:"+ mimeType + ";base64," + obj.data.image, fileName);
                    console.log(file);

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);//your file(s) reference(s)
                    document.getElementById(element_id).files = dataTransfer.files;
                }
                else {
                    console.log("obj.message");
                }
            } catch (error) {
                console.log(error);
            }
        }
    });
};

//base64 to image
function getImageBlob(id, element) {
    if(id) {
        // For Live Server
        var base_url = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: '') + "/";
        //For Localhost
        if(base_url.includes("localhost")) {
            base_url = "http://localhost/hec_administrative/public/";
        }

        $("#" + element).attr("src", base_url + "assets/img/placeholder.jpg");
        $("#" + element).attr("alt", "loading");
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append("_token", $('meta[name="csrf-token"]').attr('content'));

        axios.post(
            base_url + "get-image-blob",
            form_data
        ).then(function (response) {
            const obj = response.data;
            if (obj.success == true) {
                var elms = document.querySelectorAll("[id='" + element + "']");

                for (var i = 0; i < elms.length; i++) {
                    elms[i].setAttribute("src", "data:" + obj.data.type + ";base64," + obj.data.image);
                    elms[i].setAttribute("alt", obj.data.name);
                }
            }
            else {
                console.log(obj.message);
                $("#" + element).attr("src", base_url + "assets/img/placeholder.jpg");
                $("#" + element).attr("alt", "loading");
            }
        })
        .catch(function (error) {
            $("#" + element).attr("src", base_url + "assets/img/placeholder.jpg");
            $("#" + element).attr("alt", "loading");
            console.log(error.message);
        });
    }
}

//read more
function convertToReadMore(className) {
    var maxLength = 60;
    $("."+className).each(function() {
        var myStr = $(this).text();
        if ($.trim(myStr).length > maxLength) {
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append('<span class="c-more-text">' + newStr + " " + removedStr + '</span>');
            $(this).append(' <a href="javascript:void(0);" class="c-read-more" onclick="readMoreModal(this)">read more...</a>');
        }
    });
}

function readMoreModal(elemt) {
    $("#staticBackdrop").modal('show');
    $("#staticBackdropBody").html($(elemt).siblings(".c-more-text").html());
}

// Confirm Delete SweetAlert2
function deleteConfirmSweetAlert(form,data){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
}

// Something Went Wrong SweetAlert2
function somethingWentWrongSweetAlert(msg){
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: msg,
    })
}

// Success SweetAlert2
function successSweetAlert(msg){
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: msg,
    })
}

// Save Confirm SweetAlert2
function saveConfirmSweetAlert(form){
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Save',
        denyButtonText: `Don't save`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            form.submit();
            //Swal.fire('Saved!', '', 'success')
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    })
}

// Delete Using Axios
function deleteByAxios(elmt,url){
    Swal.fire({
        icon: 'question',
        title: 'Are you sure?',
        showDenyButton: true,
        // showCancelButton: true,
        confirmButtonText: 'Delete',
        denyButtonText: `Don't Delete`,
    }).then((result) => {
        if (result.isConfirmed) {
            $('#processing-spinner').show();

            axios.post(
                url
            ).then(function (response) {
                const obj = response.data;
                if(obj.success == true) {
                    $('#processing-spinner').hide();
                    $("#"+elmt).remove();
                    successSweetAlert(obj.message);
                }
                else {
                    $('#processing-spinner').hide();
                    somethingWentWrongSweetAlert(obj.message);
                    $('#processing-spinner').hide();
                }
            })
            .catch(function (error) {
                $('#processing-spinner').hide();
                console.log(error);
                somethingWentWrongSweetAlert(error.response.data.message);
            });
        }
    });
}
