# Prestashop - Module Stock message

Affiche un message personnalisé pour chaque produit dans la page *récapilatulatif commande*.

## Installation

Le module s'installe via le gestionnaire de module.

Modifier le fichier *shopping-cart-product-line.tpl* en ajoutant le code suivant :

 **`{if $product.stockinfo}<a href="{$link->getPageLink('contact')}"><span class="label label-info">{$product.stockinfo|escape:'html':'UTF-8'}</span></a>{/if}`**
	
`
	<td class="cart_description">
		{capture name=sep} : {/capture}
		{capture}{l s=' : '}{/capture}
		<p class="product-name"><a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute, false, false, true)|escape:'html':'UTF-8'}">{$product.name|escape:'html':'UTF-8'}</a></p>
		{if $product.reference}<small class="cart_ref">{l s='SKU'}{$smarty.capture.default}{$product.reference|escape:'html':'UTF-8'}</small>{/if}
	    {if isset($product.attributes) && $product.attributes}<small><a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute, false, false, true)|escape:'html':'UTF-8'}">{$product.attributes|@replace: $smarty.capture.sep:$smarty.capture.default|escape:'html':'UTF-8'}</a></small>{/if}
		{if $product.stockinfo}<a href="{$link->getPageLink('contact')}"><span class="label label-info">{$product.stockinfo|escape:'html':'UTF-8'}</span></a>{/if}
	</td>
`