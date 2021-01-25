<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <script>
            $(window).on('load', function () {
                $(window).scroll(function(e){
                //$('#test_submit').on('click',function(){
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
                            $('#display').append('<p>並べ替え</p>',ul);
                    })
                })
            })
        </script>
        <style>
            #display{
                position: absolute;top:900px;
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
        <div id='display'>これはテストです</div>
        <div id='ball'></div>
    </body>
</html>