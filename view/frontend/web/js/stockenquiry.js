define(
    ['jquery','Magento_Ui/js/modal/modal','mage/url'],
    function ($,modal,urlBuilder) {
                    $(".enquiry-product-stock").on(
                        'click',
                        function () {
                            event.preventDefault();
                            var datatitle = $(this).attr("data-title");
                            var options = {
                                type: 'popup',
                                responsive: true,
                                innerScroll: true,
                                title: datatitle,
                                buttons: [],
                                modalClass: 'custom_popup_box'
                            };
                            var popup = modal(options, $('#popup-modalpdp'));
                            jQuery(".error").remove();
                            $("#popup-modalpdp").modal("openModal");
                            savedata();
                        }
                    );
        function savedata()
        {
            $("#submit_stockenquire").click(
                function () {
                     jQuery(".error").remove();
                     var pid = $('#pid').val();
                     var product_url = $('#product_url').val();
                     var product_name = $('#pname').val();
                     var product_sku = $('#sku').val();
                     var first_name = $('#fname').val();
                     var last_name = $('#lname').val();
                     var email = $('#email').val();
                    if (!first_name) {
                        var datamessage = 'first name is required';
                        jQuery('#fname').after('<div class="error">' + datamessage + '</div>');
                    }
                    if (!last_name) {
                        var datamessage = 'last name is required';
                        jQuery('#lname').after('<div class="error">' + datamessage + '</div>');
                    }
                    if (!email) {
                        var datamessage = 'email is required';
                        jQuery('#email').after('<div class="error">' + datamessage + '</div>');
                    }
                    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                    if (!pattern.test(email) && email) {
                        var datamessage = 'not a valid e-mail address';
                        jQuery('#email').after('<div class="error">' + datamessage + '</div>');
                    }
                    if (!first_name || !last_name || !email || !pattern.test(email)) {
                        return false;
                    }
                    var saveproducturl = urlBuilder.build('notifystockavailability/product/save');
                    $.ajax(
                        {
                            url: saveproducturl,
                            type: 'POST',
                            showLoader: true,
                            cache: false,
                            dataType: 'json',
                            data: {
                                pid:pid,
                                product_name: product_name,
                                product_sku: product_sku,
                                first_name: first_name,
                                last_name: last_name,
                                email: email,
                                product_url:product_url,
                            },
                            complete: function (response) {
                                var dataresponse = response.responseJSON;
                                var success = dataresponse.success;
                                var successm = dataresponse.messages;
                                var pagereloadtime = dataresponse.pagereloadtime;
                                if (success == 200) {
                                    jQuery('#responcedata').append('');
                                    jQuery('#formdata').hide();
                                    jQuery('#responcedata').append('<span class="success">' + successm + '</span>');
                                    setTimeout(
                                        function () {
                                            location.reload();},
                                        pagereloadtime
                                    );
                                } else {
                                    jQuery('#responcedata').append('');
                                    jQuery('#responcedata').append('<span class="error">' + successm + '</span>');
                                }
                            },
                            error: function (xhr, status, errorThrown) {
                                jQuery('#responcedata').append('');
                                jQuery('#responcedata').append('<span class="error">Error happens. Try again.</span>');
                            }
                        }
                    );
                }
            )
        }
    }
);