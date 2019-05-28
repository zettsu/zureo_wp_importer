<?php

class ZureoProduct {

    private $idarticulo;
    private $codigo;
    private $borrar;
    private $tipo;
    private $marca;
    private $nombrecorto;
    private $nombre;
    private $descripcioncorta;
    private $descripcion;
    private $artunidadmedida;
    private $unidadmedida;
    private $fechaalta;
    private $fechamodificado;
    private $banderastock;
    private $auxiliares;
    private $stockdisponible;
    private $thumbnail;
    private $imagenprincipal;


    public function __construct($obj = null)
    {
        if(!empty($obj)){
            if(is_array($obj)) {
                foreach ($obj as $prop => $values) {
                    $new_prop = strtolower($prop);
                    $renamed_obj["{$new_prop}"] = $values;
                }

                $this->toObj($this, $renamed_obj);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdarticulo()
    {
        return $this->idarticulo;
    }

    /**
     * @param mixed $idarticulo
     */
    public function setIdarticulo($idarticulo)
    {
        $this->idarticulo = $idarticulo;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getBorrar()
    {
        return $this->borrar;
    }

    /**
     * @param mixed $borrar
     */
    public function setBorrar($borrar)
    {
        $this->borrar = $borrar;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getNombrecorto()
    {
        return $this->nombrecorto;
    }

    /**
     * @param mixed $nombrecorto
     */
    public function setNombrecorto($nombrecorto)
    {
        $this->nombrecorto = $nombrecorto;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcioncorta()
    {
        return $this->descripcioncorta;
    }

    /**
     * @param mixed $descripcioncorta
     */
    public function setDescripcioncorta($descripcioncorta)
    {
        $this->descripcioncorta = $descripcioncorta;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getArtunidadmedida()
    {
        return $this->artunidadmedida;
    }

    /**
     * @param mixed $artunidadmedida
     */
    public function setArtunidadmedida($artunidadmedida)
    {
        $this->artunidadmedida = $artunidadmedida;
    }

    /**
     * @return mixed
     */
    public function getUnidadmedida()
    {
        return $this->unidadmedida;
    }

    /**
     * @param mixed $unidadmedida
     */
    public function setUnidadmedida($unidadmedida)
    {
        $this->unidadmedida = $unidadmedida;
    }

    /**
     * @return mixed
     */
    public function getFechaalta()
    {
        return $this->fechaalta;
    }

    /**
     * @param mixed $fechaalta
     */
    public function setFechaalta($fechaalta)
    {
        $this->fechaalta = $fechaalta;
    }

    /**
     * @return mixed
     */
    public function getFechamodificado()
    {
        return $this->fechamodificado;
    }

    /**
     * @param mixed $fechamodificado
     */
    public function setFechamodificado($fechamodificado)
    {
        $this->fechamodificado = $fechamodificado;
    }

    /**
     * @return mixed
     */
    public function getBanderastock()
    {
        return $this->banderastock;
    }

    /**
     * @param mixed $banderastock
     */
    public function setBanderastock($banderastock)
    {
        $this->banderastock = $banderastock;
    }

    /**
     * @return mixed
     */
    public function getAuxiliares()
    {
        return $this->auxiliares;
    }

    /**
     * @param mixed $auxiliares
     */
    public function setAuxiliares($auxiliares)
    {
        $this->auxiliares = $auxiliares;
    }

    /**
     * @return mixed
     */
    public function getStockdisponible()
    {
        return $this->stockdisponible;
    }

    /**
     * @param mixed $stockdisponible
     */
    public function setStockdisponible($stockdisponible)
    {
        $this->stockdisponible = $stockdisponible;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getImagenprincipal()
    {
        return $this->imagenprincipal;
    }

    /**
     * @param mixed $imagenprincipal
     */
    public function setImagenprincipal($imagenprincipal)
    {
        $this->imagenprincipal = $imagenprincipal;
    }




    private function toObj($obj,$obj_prop)
    {
        $obj->setIdarticulo($obj_prop['idarticulo']);
        $obj->setCodigo($obj_prop['codigo']);
        $obj->setBorrar($obj_prop['borrar']);
        $obj->setTipo($obj_prop['tipo']);
        $obj->setMarca($obj_prop['marca']);
        $obj->setNombrecorto($obj_prop['nombrecorto']);
        $obj->setNombre($obj_prop['nombre']);
        $obj->setDescripcioncorta($obj_prop['descipcioncorta']);
        $obj->setDescripcion($obj_prop['descripcion']);
        $obj->setArtunidadmedida($obj_prop['artunidadmedida']);
        $obj->setUnidadmedida($obj_prop['unidadmedida']);
        $obj->setFechaalta($obj_prop['fechaalta']);
        $obj->setFechamodificado($obj_prop['fechamodificado']);
        $obj->setBanderastock($obj_prop['banderastock']);
        $obj->setAuxiliares($obj_prop['auxiliares']);
        $obj->setStockdisponible($obj_prop['stockdisponible']);
    }


    public static function toWooComerceObject($zureo_obj)
    {
        $product = wc_get_product_id_by_sku($zureo_obj->getCodigo());

        if(!$product) {
            $woo_obj = new WC_Product_Simple();

            $woo_obj->set_name($zureo_obj->getNombre());
            $woo_obj->set_short_description(!empty($zureo_obj->getDescripcioncorta()) ? $zureo_obj->getDescripcioncorta() : $zureo_obj->getDescripcion() );
            $woo_obj->set_description($zureo_obj->getDescripcion());
            $woo_obj->set_sku($zureo_obj->getCodigo());

            // Status ('publish', 'pending', 'draft' or 'trash')
            $woo_obj->set_status( 'publish' );
            // Visibility ('hidden', 'visible', 'search' or 'catalog')
            $visibility = 'visible';

            if($zureo_obj->getBorrar() == 1) {
                $visibility = 'hidden';
            }
            $woo_obj->set_catalog_visibility( $visibility);
            $woo_obj->set_featured(  false );

            $woo_obj->save();
        }else{
            $woo_obj = wc_get_product( $product );
            $woo_obj = new WC_Product_Simple($woo_obj);
        }

        return $woo_obj ?? null;
    }

}