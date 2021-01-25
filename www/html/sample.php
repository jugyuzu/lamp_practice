<?php

    //$array = ['りんご','みかん','バナナ'];
    
    //print json_encode($array);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //postで送られてきたデータdata:{キー（今回は「submit」）：値「今回は$('セレクタ')」}
        //post＄＿POST['キー'];今回はsubmit
        $test = $_POST['submit'];
        if($test === 'priceup'){
            $array = ['お高い','重い', '価値がある'];
            print json_encode($array);
        }else{
            $array = ['お安い', '軽い', '価値が低い'];
            print json_encode($array);
        }
    }
?>