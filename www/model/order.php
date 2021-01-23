<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//order_masterから注文履歴を取得
    function get_order_history($db,$user){
        $sql="SELECT 
                m.order_id, 
                m.created 
            FROM 
                order_master AS m 
            JOIN 
                order_content AS c 
            ON 
                m.order_id=c.order_id 
            WHERE
                m.user_id=:user
            GROUP BY 
                m.order_id
            ORDER BY 
                m.created DESC";
            
        $paramas=[':user'=>$user];
        $items = fetch_all_query($db,$sql,$paramas);
        return get_order_sum($db,$user,$items);
    }
//order_masterとcontentから注文番号ごとの合計を出す
    function get_order_sum($db,$user,$items){
        $sql="SELECT 
                m.order_id, 
                SUM(c.price*c.amount) AS total
            FROM 
                order_master AS m 
            JOIN 
                order_content AS c 
            ON 
                m.order_id=c.order_id   
            WHERE 
                user_id=:user
            GROUP BY 
                m.order_id
            ORDER BY 
                m.created DESC";

        $paramas=[':user'=>$user];
        $sum = fetch_all_query($db,$sql,$paramas);
        return insert_sum($items,$sum);
    }
//itemsに合計金額を代入
    function insert_sum($items,$sum){
        for ($i=0; $i<count($sum); $i++){
            $items[$i]['total']=$sum[$i]['total'];
        }
        return $items;
    }

//注文番号、購入日時、合計金額
    function get_order_content($db,$user,$id){
        $sql="SELECT 
            m.order_id,
            m.created
            FROM 
                order_master AS m 
            JOIN 
                order_content AS c 
            ON 
                m.order_id=c.order_id 
            WHERE
                m.user_id=:user AND m.order_id=:id
            GROUP BY
                m.order_id";
        $paramas=[':user'=>$user, ':id'=>$id];
        $values=fetch_all_query($db, $sql, $paramas);
        return get_order_sum_item($db,$user,$id,$values);
    }
//合計金額を挿入
    function get_order_sum_item($db,$user,$id,$values){
        $sql="SELECT 
                m.order_id, 
                SUM(c.price*c.amount) AS total
            FROM 
                order_master AS m 
            JOIN 
                order_content AS c 
            ON 
                m.order_id=c.order_id   
            WHERE 
                user_id=:user AND c.order_id=:id
            GROUP BY 
                m.order_id";
        $paramas=[':user'=>$user, ':id'=>$id];
        $sum=fetch_all_query($db, $sql, $paramas);
        return insert_sum($values,$sum);
    }
//商品名、購入時の商品価格、購入数、小計
    function get_order_items($db,$user,$id){
        $sql="SELECT 
            m.order_id,
            c.name,
            c.price,
            c.amount,
            c.price*c.amount AS subtotal
        FROM 
            order_master AS m 
        JOIN 
            order_content AS c 
        ON 
            m.order_id=c.order_id 
        WHERE
            m.user_id=:user AND m.order_id=:id";
        $paramas=[':user'=>$user, ':id'=>$id];
        return fetch_all_query($db, $sql, $paramas);
    }
?>
