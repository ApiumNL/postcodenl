{*
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 *}
<div class="postcodenl"
     style="display: none;"
     data-failure-message="{l s='Could not find this address - please complete it yourself.' mod='postcodenl'}">
    <div class="required form-group">
        <label for="houseNumber">
            {l s='Number' mod='postcodenls'} <sup>*</sup>
        </label>
        <input class="validate form-control"
               data-validate="isAddress"
               type="text"
               id="houseNumber"
               name="houseNumber" />
    </div>
    <div class="postcodenl-template" style="display: none;">
        <span class="street"></span>
        <span class="houseNumber"></span>
        <br />
        <span class="postcode"></span>
        <span class="city"></span>
    </div>
</div>
