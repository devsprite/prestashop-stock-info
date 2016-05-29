<?php

class Product extends ProductCore
{
    public $stockinfo;

    public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null)
    {
        self::$definition['fields']['stockinfo'] = array(
            'type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255
        );
        parent::__construct($id_product, $full, $id_lang, $id_shop, $context);
    }

}