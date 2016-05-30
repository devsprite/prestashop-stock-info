<?php
/**
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2016 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Blockstockinfo extends Module
{
    public function __construct()
    {
        $this->name = 'blockstockinfo';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
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
            ? 'ALTER TABLE ' . _DB_PREFIX_ . 'product ADD `stockinfo` VARCHAR (255) NOT NULL'
            : 'ALTER TABLE ' . _DB_PREFIX_ . 'product DROP COLUMN `stockinfo`';

        if (!Db::getInstance()->execute($sql)) {
            return false;
        }

        return true;
    }

    public function hookDisplayAdminProductsExtra($params)
    {
        $stockinfo = Db::getInstance()->getValue('SELECT stockinfo FROM ' . _DB_PREFIX_ . 'product WHERE id_product = ' . (int)Tools::getValue('id_product'));
        $this->context->smarty->assign('stockinfo', $stockinfo);

        return $this->display(__FILE__, 'adminProductsExtra.tpl');
    }
}
