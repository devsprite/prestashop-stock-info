<div id="product-stockinfo" class="panel product-tab">
    <input type="hidden" name="submitted_tabs[]" value="Blockstockinfo" >
    <h3>Message d'information concernant le stock des pièces.</h3>
    <div class="form-group">
        <label for="stockinfo" class="control-label col-lg-3">Message : </label>
        <div class="col-lg-9">
            <input type="text" name="stockinfo" value="{$stockinfo}">
        </div>
    </div>
    <div class="panel-footer">
        <a href="{$link->getAdminLink('AdminProducts')}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Annuler'}</a>
        <button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save'}</button>
        <button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save and stay'}</button>
    </div>
</div>