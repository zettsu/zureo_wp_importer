<?php

/**
 * Class ZureoImporter
 */
class ZureoImporter {

    protected $service = "http://multijuegos5674.zureodns.com:82/ServicioSincronizacion/ServicioSincronizacion.svc/SincronizarArticulos?token=MULTIJUEGOS&empid=1";
    private $pieces = 100;
    private $debug = false;

    /**
     * @param string  $from Date from start sync default one is 1900/01/01
     * @param integer $qty  Quantity of products getted for each query
     * @param integer $to   Default 0 until no more records appear or specify a number or rocords getted
     *
     * @return array $results array of products returned
     */
    public static function firstRun($from = "1900/01/01", $qty = 200,  $to = 0)
    {
        $records = true;
        $start = 0;

        $results = [];

        $end = $qty;

        self::debug("getProducts function - from => {$from}, qty => {$qty}, to => {$to} ");

        do {
            $arr = self::getProducts($from, $start, $end);
            self::debug("getProducts function start => {$start}, end => {$end} ");

            if(empty($arr)) {
                $records = true;
            }else{
                if(count($arr) < $qty) {
                    $records = false;
                }

                $results = array_merge($results, $arr);
            }

            $start = $end;
            $end += $qty;

            if($to != 0 && $end < $to){
                $records = false;
            }
        }while($records);

        return $results;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }


    /**
     * @param $date_from
     * @param int $from
     * @param int $to
     * @param bool $json
     * @return array
     */
    public static function getProducts($date_from, $from = 0, $to = 100, $json = false): array
    {
        $products_url = self::service;

        $products_url .= "&fecha={$date_from}";
        $products_url .= "&desde={$from}";
        $products_url .= "&hasta={$to}";

        self::debug("getProducts function - url {$products_url}");

        try{
            $results = wp_remote_retrieve_body( wp_remote_get($products_url) );

            if($json) {
                $results = json_encode($results, true);
            }

            return $results;
        }catch (Exception $exception){
            self::debug("getProducts function - exception {$exception->getMessage()}");
            return [];
        }

    }


    public static function getModifiedPeriod($from, $to, $qty = 100) {

        $begin = new DateTime( $from );
        $end   = new DateTime( $to );

        $modified_on_date_range = [];
        $extracted_products = [];

        for($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $products = self::getProducts($i->format('Y/m/d'));

            foreach ($products as $product) {
                if(date("d/m/Y", strtotime($product['FechaModificado'])) == $i->format('d/m/Y')) {
                    $extracted_products[] = $product;
                }
            }

            $modified_on_date_range = array_merge($modified_on_date_range, $extracted_products);
        }

        return $modified_on_date_range;
    }

    public static function getTodayUpdates() {
        $now = date('Y/m/d');
        self::debug("getTodayUpdates function, date getted {$now}.");

        return self::getProducts($now, 0, 10);
    }


    public function debug($msg)
    {
        if($this->debug) {
            $now = date('Y-m-d H:i:s');
            echo "[{$now}] - {$msg} \n";
        }
    }


    public static function getImages($art_id, $name)
    {
        $name_file = sanitize_title($name)
        $post_id = 0;

        $get_tempral_files =


        $imageData = base64_decode($imageData);
        $source = imagecreatefromstring($imageData);
        $imageSave = imagejpeg(null,$name_file,100);
        //imagedestroy($source);

        $images = array('filename1.png');

        for($i = 0; $i < 10; $i++) {
            $attachment = array(
                'post_mime_type' => 'image/jpeg',
                'post_title' => $name,
                'post_content' => 'my description',
                'post_status' => 'inherit'
            );
            $image_id = wp_insert_attachment($attachment, $images[$i], $post_id);
            $image_data = wp_generate_attachment_metadata($image_id, $images[$i]);
            wp_update_attachment_metadata($image_id, $image_data);
        }

    }
}