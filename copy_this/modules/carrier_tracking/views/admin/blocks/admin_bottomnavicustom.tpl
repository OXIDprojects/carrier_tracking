[{$smarty.block.parent}]

[{if $bottom_buttons->carrier_new }]
    <li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:top.oxid.admin.editThis( -1 );return false" target="edit">[{oxmultilang ident="TOOLTIPS_NEWCARRIER"}]</a> |</li>
[{/if}]