<?php
require_once('DB.php');
$post = $_POST;
$db = new DB;
$connect = $db::query();

if (isset($post['order_id'])) {
    $orderId = $post['order_id'];
    if ($connect === 0) {
        echo 'Ошибка получения данных';
    }
    else{
        $order = $connect->prepare("
        SELECT o1.`order_id`, o2.`order_status`
        FROM `orders` o1
        INNER JOIN `orders` o2 ON o2.`order_id` = o1.`order_id`
        WHERE o1.`order_id` = :orderId");
        $order->execute([
            ':orderId' => $orderId
        ]);
        $result = $order->fetchAll();
        is_null($result)  ?

        sendJson([
            'status' => 'fail',
            'message' => "Заказ с ID `$orderId` не найден"
        ]) :
        sendJson([
            'status' => 'success',
            'order_id' => $order['order_id'],
            'order_status' => $order['status'],
        ]);
    }
}

function sendJson($array)
{
    print_r(json_encode($array));
}