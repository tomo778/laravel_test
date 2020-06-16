$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const alertTopLeft = document.getElementById('alert-top-left');
    if (alertTopLeft != null) {
        alertTopLeft.classList.toggle('alert_none');
    }

    $('.edit_btn').on('click', function (event) {
        //関数
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
        event.preventDefault();
        $('.loading').removeClass('d-none');
        $('.edit_btn').hide();
        $form = $(this).parents('form:first');
        var form = $(this).parents('form:first').get()[0];
        var formData = new FormData(form);
        setTimeout(function () {
            doajax();
        }, 500);
    });

    $('input:checkbox[name="checkbox-all"]').on('click', function (event) {
        if ($(this).val() == 0) {
            $('input:checkbox[name="checkbox-val"]').prop('checked', true);
            $(this).val(1);
        } else {
            $('input:checkbox[name="checkbox-val"]').prop('checked', false);
            $(this).val(0);
        }
    });

    $('#form-select').on('change', function (event) {
        var r = $('option:selected').val();
        $('#form-select').val(0);
        var mes = {
            1: { "mes": "公開にしても宜しいですか？" },
            2: { "mes": "非公開にしても宜しいですか？" },
            3: { "mes": "削除しても宜しいですか？" },
        };
        var result = window.confirm(mes[r].mes);
        if (result) {
            var vals = new Array();
            $('input:checkbox[name="checkbox-val"]:checked').each(function () {
                vals.push($(this).val());
            });
            $.ajax({
                url: "/admin/product/" + "checkbox",
                type: 'post',
                data: {
                    mode: r,
                    vals: vals
                },
                timeout: 10000,
                success: function (result, textStatus, xhr) {
                    location.reload();
                },
                error: function (data) {
                    console.debug(data);
                }
            });
        }
    });
});
