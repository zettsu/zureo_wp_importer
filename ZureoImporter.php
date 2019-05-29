<?php

/**
 * Class ZureoImporter
 */
class ZureoImporter {

    const service = "http://multijuegos5674.zureodns.com:82/ServicioSincronizacion/ServicioSincronizacion.svc/SincronizarArticulos?token=MULTIJUEGOS&empid=1";
    private $pieces = 100;
    const debug = false;

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

        self::debugLog("getProducts function - from => {$from}, qty => {$qty}, to => {$to} ");

        do {
            $arr = self::getProducts($from, $start, $end);
            self::debugLog("getProducts function start => {$start}, end => {$end} ");

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
     * @param $date_from
     * @param int $from
     * @param int $to
     * @param bool $json
     * @return mixed
     */
    public static function getProducts($date_from, $from = 0, $to = 100, $json = false)
    {
        $products_url = self::service;

        $products_url .= "&fecha={$date_from}";
        $products_url .= "&desde={$from}";
        $products_url .= "&hasta={$to}";

        self::debugLog("getProducts function - url {$products_url}");

        try{
            $results = wp_remote_retrieve_body( wp_remote_get($products_url) );

            if(!empty($results)) {
                $results = json_decode($results, true);
            }else{
                $results = [];
            }

            return $results;
        }catch (Exception $exception){
            self::debugLog("getProducts function - exception {$exception->getMessage()}");
            return [];
        }

    }


    public static function getModifiedPeriod($from, $to, $qty = 100) {
        $begin = new DateTime($from);
        $end= new DateTime($to);

        $modified_on_date_range = [];
        $extracted_products = [];

        for($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $products = self::getProducts($i->format('Y/m/d'));
            foreach ($products as $product) {
                $fecha_mod = explode(" ",$product['FechaModificado']);

                if($begin->format('Y/m/d') > $fecha_mod[0] && $fecha_mod[0] < $end->format('Y/m/d')) {
                    $extracted_products[] = $product;
                }

            }

            $modified_on_date_range = array_merge($modified_on_date_range, $extracted_products);
        }

        return $modified_on_date_range;
    }

    public static function getTodayUpdates() {
        $now = date('Y/m/d');
        self::debugLog("getTodayUpdates function, date getted {$now}.");

        return self::getProducts($now, 0, 10);
    }


    public function debugLog($msg)
    {
        if(debug) {
            $now = date('Y-m-d H:i:s');
            echo "[{$now}] - {$msg} \n";
        }
    }


    public static function getImages($art_id, $name, $woo_obj)
    {
        $name_file = sanitize_title($name);
        $post_id = 0;

        $service_images = "http://multijuegos5674.zureodns.com:82/ServicioSincronizacion/ServicioSincronizacion.svc/SincronizarImagenesArticulo?token=MULTIJUEGOS&empid=1&";
        $service_images .= "artid={$art_id}";


        $results = wp_remote_retrieve_body( wp_remote_get($service_images) );

        if(!empty($results)) {
            $results = json_decode($results, true);

            $imageData = base64_decode($results[0]['Thumbnail']);
            if(!empty($imageData))
            {
                self::save_image($imageData,$art_id );
            }

        }

    }

    /**
     * Save the image on the server.
     */
    function save_image( $base64_img, $title ) {

	// Upload dir.
	$upload_dir  = wp_upload_dir();
	$upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;

	$img             = str_replace( 'data:image/png;base64,', '', $base64_img );
	$img             = str_replace( ' ', '+', $img );
	$decoded         = base64_decode( $img );
	$filename        = $title . '.jpeg';
	$file_type       = 'image/jpeg';
	$hashed_filename = md5( $filename . microtime() ) . '_' . $filename;

	// Save the image in the uploads directory.
	$upload_file = file_put_contents( $upload_path . $hashed_filename, $decoded );

	$attachment = array(
		'post_mime_type' => $file_type,
		'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $hashed_filename ) ),
		'post_content'   => '',
		'post_status'    => 'inherit',
		'guid'           => $upload_dir['url'] . '/' . basename( $hashed_filename )
	);

	$attach_id = wp_insert_attachment( $attachment, $upload_dir['path'] . '/' . $hashed_filename );
	return $attach_id;
}
}