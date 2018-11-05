# PostcodeNL <small>v1.0.0</small>

Currently only works for `NL`, **not** `BE`! For `NL`, this totally suppresses
standard input mechanisms - _i.e._, you will depend on the availability of the
webservice.

## How to use

This is relatively straightforward, but might require some tweaking, depending 
on your theme. First, locate the latest release [here](https://github.com/ApiumNL/postcodenl/releases)
and download it. Thereafter, you can attempt to use it in a test environment - if
this works, you are set!

If not, however, you might want to change the template file. This one can be found
at `views/templates/hook/address.tpl`, relative to the module. This file is the
base address template, extended with a hook call to `displayPostcodeNL`. Overwrite
this template with your theme's `address.tpl`, but be sure to include the hook call
in the right place, that is, just below the postcode input field. E.g. like this,

```smarty
{if $field_name eq 'postcode'}
    {assign var="postCodeExist" value=true}
    <div class="required postcode form-group unvisible">
        <label for="postcode">{l s='Zip/Postal Code'} <sup>*</sup></label>
        <input class="is_required validate form-control" data-validate="{$address_validation.$field_name.validate}" type="text" id="postcode" name="postcode" value="{if isset($smarty.post.postcode)}{$smarty.post.postcode}{else}{if isset($address->postcode)}{$address->postcode|escape:'html':'UTF-8'}{/if}{/if}" />
    </div>
    {* This'd be the ideal place to insert the hook call *}
    {hook h='displayPostcodeNL'}
{/if}
```

If this does not work, feel free to [open an issue](https://github.com/ApiumNL/postcodenl/issues/new).

## Licensing

This module is released under an MIT license, copyright Apium (2018). Other works
used include,

1. The [Postcode.nl REST client](https://github.com/postcode-nl/PostcodeNl_Api_RestClient),
   released under a Simplified BSD license.

# Version

The current version is 1.0.0, as of 1st of November 2018.
