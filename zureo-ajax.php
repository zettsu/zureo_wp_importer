<?php

include_once 'ZureoProduct.php';

function get_today_sync()
{
    $products = ZureoImporter::getTodayUpdates();

}

function get_period_sync()
{
    $now = $now = date('Y/m/d');

    $from = $_GET['from'] ?? $now;
    $to = $_GET['to'] ??  $now;
    $qty = $_GET['qty'] ??  100;

    if(!empty($from) && !empty($to)) {
        $products = ZureoImporter::getModifiedPeriod($from, $to, $qty);
        foreach ($products as $j_object) {
            $product = new ZureoProduct($j_object);
            $images = ZureoImporter::getImages($product->getIdarticulo(), $product->getNombre());
            $product_ob = ZureoProduct::toWooComerceObject($product);
        }
    }
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

add_action('wp_ajax_get_last_sync', 'get_last_sync');