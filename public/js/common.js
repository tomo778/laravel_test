$(function(){

    const alertTopLeft = document.getElementById('alert-top-left');
    if (alertTopLeft != null) {
        alertTopLeft.classList.toggle('alert_none');
    }

    //フォームのsubmitを拾う
    $('.edit_btn').on('click', function(event){
        //tinymce用
        var val = $('.mce');
        jQuery.each(val, function(k,v){
            var name = $(v).attr('name');
            var c = tinyMCE.get(name).getContent();
            $(this).val(c);
        });

        //通常のアクションをキャンセルする
        event.preventDefault();
        //Formの参照を取る
        $form = $(this).parents('form:first');
        $.ajax({
             url : 'val', //Formのアクションを取得して指定する
             type: $form.attr('method'),//Formのメソッドを取得して指定する
             data: $form.serialize(),　 //データにFormがserialzeした結果を入れる
             timeout: 10000,
             beforeSend : function(xhr, settings){
             //     //Buttonを無効にする
             //     $('.edit_btn').attr('disabled' , true);
             //     //処理中のを通知するアイコンを表示する
             // $('#boxEmailSettings').append('<div class="overlay" id ="spin" name = "spin"><i class="fa fa-refresh fa-spin"></i></div>');
             },
             complete: function(xhr, textStatus){
                  //処理中アイコン削除
              $('#spin').remove();
            $('.edit_btn').attr('disabled' , false);
             },
             success: function (result, textStatus, xhr) {
             ret = jQuery.parseJSON(result);
            //Alertで送信結果を表示する
            //console.log(ret);
            if(ret.success){
                $form.submit();
            } else {
                $('.uk-alert-danger').remove();
                // const alertTopLeft = document.getElementById('alert_danger');
                // if (checkShowing(alertTopLeft) == false) {
                // 	alertTopLeft.classList.toggle('alert_none');
                // }
                    jQuery.each(ret.errors, function(k,v){
                        var html;
                        html = '<div class="uk-alert-danger" uk-alert>※';
                        html += v[0];
                        html += '</div>';
                        $('*[data-errmes="' + k +'"]').append(html);
                    });
                    $('.edit_btn').attr('disabled' , false);
                }
            },
            error : function(data){
                $('.edit_btn').attr('disabled' , false);
                console.debug(data);
            }
        });
    });
});