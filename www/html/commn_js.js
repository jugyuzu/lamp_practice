
'use strict';
$(document).ready(function() {
    //selectが変わったら
    $('#line_up').on('change',function(){
        $.ajax({
            //change_line_up.phpに
            url:'change_line_up.php',
            //id="line_up"のvalueとid="item_num"のvalueを
            //line_upはなんの順か、item_numは何件取得するか
            data:{line_up: $('#line_up').val(),
                 item_num: $('#item_num').val()
            },
            //getで
            method: 'GET',
            //json形式で送る
            dataType:'json'
        }).done(function(data){
            for(let i=0; i<data.length; i++){
                //class="card_header"の　i　番目にdata[i]['name']を書き込む
                $('.card-header').eq(i).text(data[i]['name']);
                //class="card_body"の i番目の< img >の src を変更
                $('.card-body').eq(i).children('img').attr('src',"/assets/images/"+data[i]['image']);
                //data[i]['price']に3桁ごとに , を入れる
                let price = data[i]['price'].replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                //class='item_price'の i 番目　に値段を書き込む
                $('.item_price').eq(i).text(price+'円');
                //stockが0よりあるなら
                if(data[i]['stock'] > 0){
                    // i 番目のclass名cart_formのクラス名item_noneを消す
                    $('.cart_form').eq(i).removeClass('item_none');
                    //　i 番目のclass="cart_item_id"のvalueにdata[i]['item_id]を入力
                    $('.cart_item_id').eq(i).val(data[i]['item_id']);
                    //　i 番目のclass="text-danger"を消す
                    $('.text-danger').eq(i).remove();
                }else{
                    //i　番目のclass="cart_form"を消す
                    $('.cart_form').eq(i).addClass("item_none");
                    //<figcaption>に p ~ を書き込む
                    $('figcaption').eq(i).append('<p class="text-danger">現在売り切れです。</p>');
                }
            }   
        }).fail(function(){
            window.alert('ファイル読み込み失敗');
        })
    })
    $(window).on('scroll', function(){
        //webページ全体の高さを取得
        let doch = $(document).innerHeight();
        //windowの高さを取得
        let winh = $(window).innerHeight();
        //webページの高さからwindowの高さをひく
        let bottom = doch - winh;
        //現在のスクロール量が高さの差分より同じか大きければ
        if(bottom <= $(window).scrollTop()){
            //#count(現在のページ)を取得
            let page= parseInt($('#count').val());
            //#all_item(総ページ数)を取得
            let all_item = parseInt($('#all_item').val());
            //現在のページと総ページが同じなら抜ける
            if(page >= all_item){
                window.alert('全ての商品が表示済みです');
                return;
            }
            $.ajax({
                //get_item_limit.phpに
                url:'get_item_limit.php',
                //id='line_up'(どの順で取得するか)
                data: {line_up: $('#line_up').val(),
                //id='item_num'(何件目から取得するか)
                       item_num: $('#item_num').val()
                    },
                method:'GET',
                dataType:'json',
            }).done(function(data){ 
                let page= parseInt($('#count').val());
                //現在のページにプラス1ページ
                page = page + 1;
                $('#count').val(page);
                //#item_numを取得。何件目から書き換えるかに使える
                let num= parseInt($('#item_num').val());
                for(let i=0; i<data.length; i++){
                    //0番目のclass='col-6'を複製して、class="row"に追加する
                    $('.col-6').eq(0).clone(true).appendTo('.row');
                    //num+i　番目のclass="card-header"の名前を書き換える
                    $('.card-header').eq(num+i).text(data[i]['name']);
                    let price = data[i]['price'].replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                    //値段を入力
                    $('.item_price').eq(num+i).text(price+'円');
                    //画像を変更
                    $('.card-body').eq(num+i).children('img').attr('src',"/assets/images/"+data[i]['image']);
                    if(data[i]['stock'] > 0){
                        //item_idを変える
                        $('.cart_item_id').eq(num+i).val(data[i]['item_id']);
                    }else{
                        //item_noneを追加してdisplay:none;で消す
                        $('.cart_form').eq(num+i).addClass('item_none');
                        //現在売り切れですを表示する
                        $('figcaption').eq(num+i).append('<p class="text-danger">現在売り切れです。</p>');
                    }
                }
                //4件分足して記入
                num=num+4;
                $('#item_num').val(num);
            }).fail(function(){
                window.alert('ファイル読み込み失敗');
            })
        }
    })
})