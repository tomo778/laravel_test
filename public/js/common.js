$(function () {

    const alertTopLeft = document.getElementById('alert-top-left');
    if (alertTopLeft != null) {
        alertTopLeft.classList.toggle('alert_none');
    }
    //フォームのsubmitを拾う
    $('.edit_btn').on('click', function (event) {

        function doajax() {
            $.ajax({
                url: $form.attr('name'),
                type: $form.attr('method'),
                data: formData,
                timeout: 10000,
                // Ajaxがdataを整形しない指定
                processData: false,
                // contentTypeもfalseに指定
                contentType: false,
                success: function (result, textStatus, xhr) {
                    ret = jQuery.parseJSON(result);
                    //Alertで送信結果を表示する
                    if (ret.success) {
                        $form.submit();
                    } else {
                        $('.uk-alert-danger').remove();
                        jQuery.each(ret.errors, function (k, v) {
                            var html;
                            html = '<div class="uk-alert-danger" uk-alert>※';
                            html += v[0];
                            html += '</div>';
                            $('*[data-errmes="' + k + '"]').append(html);
                        });
                        $('.edit_btn').attr('disabled', false);
                        $('.loading').addClass('d-none');
                        $('.edit_btn').show();
                    }
                },
                error: function (data) {
                    $('.edit_btn').attr('disabled', false);
                    console.debug(data);
                }
            });
        }
        //tinymce用
        // var val = $('.mce');
        // jQuery.each(val, function(k,v){
        //     var name = $(v).attr('name');
        //     var c = tinyMCE.get(name).getContent();
        //     $(this).val(c);
        // });
        $('.loading').removeClass('d-none');
        $('.edit_btn').hide();
        event.preventDefault();
        $form = $(this).parents('form:first');
        var form = $(this).parents('form:first').get()[0];
        var formData = new FormData(form);
        setTimeout(function () {
            doajax();
        }, 500);
    });
});
