<?php

include_once 'ZureoProduct.php';
include_once 'ZureoImporter.php';

function get_today_sync()
{
    $products = ZureoImporter::getTodayUpdates();
    foreach ($products as $j_object) {
        echo json_encode($j_object);
        $product = new ZureoProduct($j_object);
        //$images = ZureoImporter::getImages($product->getIdarticulo(), $product->getNombre());
        $product_ob = ZureoProduct::toWooComerceObject($product);
    }

    die();
}

function get_period_sync()
{
    $now = $now = date('Y/m/d');

    $from = !empty($_GET['start_date']) ? date("Y/m/d", strtotime($_GET['start_date'])) : $now;
    $to = !empty($_GET['end_date']) ? date("Y/m/d", strtotime($_GET['end_date'])) : $now;
    $qty = $_GET['qty'] ??  100;

    if(!empty($from) && !empty($to)) {
        $products = ZureoImporter::getModifiedPeriod($from, $to, $qty);

        foreach ($products as $j_object) {
            $product = new ZureoProduct($j_object);
            $product_ob = ZureoProduct::toWooComerceObject($product);
            ZureoImporter::getImages($product->getIdarticulo(), $product->getNombre(), $product_ob);
        }
    }

    die();
}

function get_last_sync() {
    try{
        $products = ZureoImporter::firstRun();

        foreach ($products as $j_object) {
            $product = new ZureoProduct($j_object);
            $product_ob = ZureoProduct::toWooComerceObject($product);
        }
    }catch (Exception $e) {
        var_dump($e);
    }

    die();
}

add_action('wp_ajax_get_today_sync', 'get_today_sync');
add_action('wp_ajax_get_period_sync', 'get_period_sync');



