# Prestashop - Module Stock Message

Affiche un message personnalisé pour chaque produit dans la page 
*récapilatulatif commande*.

## Installation

Le module s'installe via le gestionnaire de module.

Modifier le fichier *shopping-cart-product-line.tpl* en ajoutant le code
suivant vers la ligne 36 du fichier :

 **`{if $product.stockinfo}<a href="{$link->getPageLink('contact')}"><span class="label label-info">{$product.stockinfo|escape:'html':'UTF-8'}</span></a>{/if}`**
	
Un exemple du fichier modifié *shopping-cart-product-line.tpl* ce trouve dans le répertoire du module.