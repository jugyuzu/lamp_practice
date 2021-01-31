<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <script>
            $(window).on('load', function () {
                $(window).on('scroll', function(){
                    //変数dochにページ全体の高さを取得
                    let doch = $(document).innerHeight();
                    //ウィンドウの高さを取得
                    let winh = $(window).innerHeight();
                    let bottom = doch - winh;
                    if(bottom <=$(window).scrollTop() && !$('#move').length){
                        $.ajax({
                            //通信するurl
                            url:'sample.php',
                            //送信するデータ{キー：送りたいセレクタ.val()}
                            data: {submit: $('#test').val()},
                            //送信するメソッド
                            method: 'POST',
                            //送信するデータのタイプ
                            dataType:'json',
                        //成功したらfunctionを送信
                        }).done(function(data){
                            //変数ulに<ul>を代入
                            var ul = $('<ul>');
                            for(var i=0;i<data.length;i++){
                                //変数liに<li>を代入
                                var li = $('<li>');
                                //liにdata[0~2]を出力
                                li.html(data[i]);
                                //ulにliを追加する
                                ul.append(li);
                            }
                            //最後にid=displayにulを追加する
                            let p = $('<p id="move">並べかえ</p>');
                            p.append(ul);
                            $('#display').after(p);
                            //$('#display').remove();
                            //$('#move').after('<div id="display">ここから</div>');
                        })
                    }else if(bottom <=$(window).scrollTop()){
                        $.ajax({
                            //通信するurl
                            url:'sample.php',
                            //送信するデータ{キー：送りたいセレクタ.val()}
                            data: {submit: $('#test').val()},
                            //送信するメソッド
                            method: 'POST',
                            //送信するデータのタイプ
                            dataType:'json',
                        //成功したらfunctionを送信
                        }).done(function(data){
                            //変数ulに<ul>を代入
                            var ul = $('<ul>');
                            for(var i=0;i<data.length;i++){
                                //変数liに<li>を代入
                                var li = $('<li>');
                                //liにdata[0~2]を出力
                                li.html(data[i]);
                                //ulにliを追加する
                                ul.append(li);
                            }
                            let p = $('<p id="move">並べかえ</p>');
                            p.append(ul);
                            //最後にid=displayにulを追加する
                            $('#move').last().append(p);
                        })
                    }
                })
            })
            /*
            //bodyの一番下にdiv  #scroll_statusを挿入 appendChild(child)
            let div = "<div id='bottom'>テストです</div>"
            $("body").append(div);
            //ページトップからスクロールした距離を取得 かつ 取得した値を常に更新 scrollTop() 
            $(window).scroll(function(e){
                //div #bottomまでの距離を図る offset.top
                let obj_top = $('#bottom').offset().top;
                $('#bottom').html(obj_top);
                //トップページから#bottomまでの距離を
                let scr_count = $(window).scrollTop();
                $('#count').html(scr_count);
                //条件式 トップページからの距離がdiv#scrollまでの距離を超えたら発火
                
                if(scr_count > obj_top){
                    $.ajax({
                    //通信するurl
                    url:'sample.php',
                    //送信するデータ{キー：送りたいセレクタ.val()}
                    data: {submit: $('#test').val()},
                    //送信するメソッド
                    method: 'POST',
                    //送信するデータのタイプ
                    dataType:'json',
                //成功したらfunctionを送信
                    }).done(function(data){
                        //変数ulに<ul>を代入
                        
                        var ul = $('<ul>');
                        for(var i=0;i<data.length;i++){
                            //変数liに<li>を代入
                            var li = $('<li>');
                            //liにdata[0~2]を出力
                            li.html(data[i]);
                            //ulにliを追加する
                            ul.append(li);
                        }
                        
                        //最後にid=displayにulを追加する
                        $("#bottom").remove();
                        let new_div = "<div id='list'>並べ替え</div>"
                        $("body").append(new_div);
                        $("#list").after(ul);
                    })
                }
            })*/

            $(window).on('load', function () {
                //$(window).scroll(function(e){
                $("#test").on("change",function(e){
                    /*
                    $.ajax({
                        //通信するurl
                        url:'sample.php',
                        //送信するデータ{キー：送りたいセレクタ.val()}
                        data: {submit: $('#test').val()},
                        //送信するメソッド
                        method: 'POST',
                        //送信するデータのタイプ
                        dataType:'json',
                    //成功したらfunctionを送信
                    }).done(function(data){
                            //変数ulに<ul>を代入
                        })*/
                        let pr = 'dfdsf';
                        window.alert(pr);
                        $('#test_print').text(<?php echo 'pr'; ?>); 
                            
                })
            })
        </script>
        <style>
            body{
                min-height:1000px;
                position:relative;
            }
            #display{
                margin-top:800px
            }
        </style>
    </head>
    <body>
        <input type='text' name='price' id='price'>
        <select name="price" id="test">
            <option value="priceup">価格が高い</option>
            <option value="pricedown">価格が安い</option>
        </select>
            <button id="test_submit">送信</button>
        <?php $var='アイウエオ';?>
        <p id="test_print"><?php print $var; ?></p>
        <div id="display">ここから</div>
        <?php $var='かきくけこ'; ?>
    </body>
</html>