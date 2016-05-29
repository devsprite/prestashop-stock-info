<?php

if (!defined('_PS_VERSION_'))
    exit;

class Blockstockinfo extends Module
{
    public function __construct()
    {
        $this->name = 'blockstockinfo';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->author = 'Dominique';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Avertissement stock');
        $this->description = $this->l('Affiche une information sur l\'état du stock dans la page commande');
    }

    public function install()
    {
        if (!parent::install() or
            !$this->alterProductTable() or
            !$this->registerHook('displayAdminProductsExtra') or
            !$this->registerHook('actionProductUpdate')
        ) {
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() or
            !$this->alterProductTable('remove')
        ) {
            return false;
        }
        return true;
    }

    private function alterProductTable($method = 'add')
    {
        $sql = $method == 'add' 
            ? 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `stockinfo` VARCHAR (255) NOT NULL DEFAULT "Contactez nous pour connaître la disponibilité de ce produit"'
            : 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP COLUMN `stockinfo`';
        
            if (!Db::getInstance()->execute($sql)) {
                return false;
            }

        return true;
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        $stockinfo = Db::getInstance()->getValue('SELECT stockinfo FROM '._DB_PREFIX_.'product WHERE id_product = '.(int)Tools::getValue('id_product'));
        $this->context->smarty->assign('stockinfo', $stockinfo);
        
        return $this->display(__FILE__, 'adminProductsExtra.tpl');
    }
}
