[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign box="list"}]
[{assign var="where" value=$oView->getListFilter()}]

[{ if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<script type="text/javascript">
<!--
window.onload = function ()
{
    top.reloadEditFrame();
    [{ if $updatelist == 1}]
        top.oxid.admin.updateList('[{ $oxid }]');
    [{ /if}]
}
//-->
</script>

<div id="liste">


<form name="search" id="search" action="[{$oViewConf->getSelfLink()}]" method="post">
[{include file="_formparams.tpl" cl="carrier_list" lstrt=$lstrt actedit=$actedit oxid=$oxid fnc="" language=$actlang editlanguage=$actlang}]
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<colgroup>
    [{block name="admin_carrier_list_colgroup"}]
    <col width="4%">
    <col width="6%">
    <col width="65%">
    <col width="14%">
    <col width="1%">
    [{/block}]
</colgroup>
<tr class="listitem">
    [{block name="admin_carrier_list_filter"}]
    <td valign="top" class="listfilter first" align="center">
        <div class="r1"><div class="b1">
        &nbsp;
        </div></div>
    </td>
    <td valign="top" class="listfilter">
        <div class="r1"><div class="b1">
        <input class="listedit" type="text" size="20" maxlength="128" name="where[oxcarriers][oxtitle]" value="[{$where->oxcarriers__oxtitle}]">
        </div></div>
    </td>
    <td valign="top" class="listfilter">
        <div class="r1"><div class="b1">
        <input class="listedit" type="text" size="50" maxlength="128" name="where[oxcarriers][oxcarrierurl]" value="[{$where->oxcarriers__oxcarrierurl}]">
        </div></div>
    </td>

    <td valign="top" class="listfilter">
        <div class="r1"><div class="b1">
        [{*<input class="listedit" type="text" size="30" maxlength="128" name="where[oxcarrier][oxinsert]" value="[{$where->oxcarriers__oxinsert}]">*}]
        </div></div>
    </td>
    <td valign="top" class="listfilter" colspan="2">
        <div class="r1">
            <div class="b1">
                <div class="find">
                    <select name="changelang" class="editinput" onChange="Javascript:top.oxid.admin.changeLanguage();">
                        [{foreach from=$languages item=lang}]
                            <option value="[{ $lang->id }]" [{ if $lang->selected}]SELECTED[{/if}]>[{ $lang->name }]</option>
                        [{/foreach}]
                    </select>
                    <input class="listedit" type="submit" name="submitit" value="[{ oxmultilang ident="GENERAL_SEARCH" }]">
                </div>
            </div>
        </div>
    </td>
    [{/block}]
</tr>

<tr>
    <td class="listheader first" height="15" align="center"><a href="Javascript:top.oxid.admin.setSorting( document.search, 'oxcarriers', 'oxactive', 'asc');document.search.submit();" class="listheader">[{oxmultilang ident="GENERAL_ARTICLE_OXACTIVE"}]</a></td>
    <td class="listheader" height="15"><a href="Javascript:top.oxid.admin.setSorting( document.search, 'oxcarriers', 'oxtitle', 'asc');document.search.submit();" class="listheader">[{oxmultilang ident="GENERAL_TITLE"}]</a></td>
	<td class="listheader" height="15"><a href="Javascript:top.oxid.admin.setSorting( document.search, 'oxcarriers', 'oxcarrierurl', 'asc')document.search.submit();" class="listheader">[{oxmultilang ident="GENERAL_URL"}]</a></td>
    <td class="listheader" height="15" colspan="2">
        [{*<a href="Javascript:top.oxid.admin.setSorting( document.search, 'oxcarrier', 'oxinsert', 'asc');document.search.submit();" class="listheader">[{oxmultilang ident="GENERAL_DATE"}]</a>*}]
    </td>
</tr>

[{assign var="blWhite" value=""}]
[{assign var="_cnt" value=0}]
[{foreach from=$mylist item=listitem}]
    [{assign var="_cnt" value=$_cnt+1}]
    <tr id="row.[{$_cnt}]">
    [{block name="admin_carrier_list_item"}]
        [{if $listitem->blacklist == 1}]
            [{assign var="listclass" value=listitem3}]
        [{else}]
            [{assign var="listclass" value=listitem$blWhite}]
        [{/if}]
        [{if $listitem->getId() == $oxid}]
            [{assign var="listclass" value=listitem4}]
        [{/if}]
        <td valign="top" class="[{$listclass}][{if $listitem->oxcarriers__oxactive->value == 1}] active[{/if}]" height="15"><div class="listitemfloating">&nbsp;<a href="Javascript:top.oxid.admin.editThis('[{$listitem->oxcarriers__oxid->value}]');" class="[{$listclass}]">
         &nbsp;
        </a></div></td>
        <td valign="top" class="[{$listclass}]" height="15"><div class="listitemfloating"><a href="Javascript:top.oxid.admin.editThis('[{$listitem->oxcarriers__oxid->value}]');" class="[{$listclass}]">[{$listitem->oxcarriers__oxtitle->value}]</a></div></td>
        <td valign="top" class="[{$listclass}]" height="15"><div class="listitemfloating"><a href="Javascript:top.oxid.admin.editThis('[{$listitem->oxcarriers__oxid->value}]');" class="[{$listclass}]">[{$listitem->oxcarriers__oxcarrierurl->value}]</a></div></td>
        <td valign="top" class="[{$listclass}]" height="15">
            [{*<div class="listitemfloating"><a href="Javascript:top.oxid.admin.editThis('[{$listitem->oxcarriers__oxid->value}]');" class="[{$listclass}]">[{$listitem->oxcarriers__oxinsert->value}]</a>*}]
            </div></td>
        <td align="right" class="[{$listclass}]">
        [{if !$readonly}]
        <a href="Javascript:top.oxid.admin.deleteThis('[{$listitem->oxcarriers__oxid->value}]');" class="delete" id="del.[{$_cnt}]" title="" [{include file="help.tpl" helpid=item_delete}]></a>
        [{/if}]
        </td>
    [{/block}]
</tr>
[{if $blWhite == "2"}]
[{assign var="blWhite" value=""}]
[{else}]
[{assign var="blWhite" value="2"}]
[{/if}]
[{/foreach}]
[{include file="pagenavisnippet.tpl" colspan="5"}]
</table>
</form>
</div>


[{include file="pagetabsnippet.tpl"}]

<script type="text/javascript">
    if (parent.parent)
    {   parent.parent.sShopTitle   = "[{$actshopobj->oxshops__oxname->getRawValue()|oxaddslashes}]";
        parent.parent.sMenuItem    = "[{oxmultilang ident="ACTIONS_LIST_MENUITEM"}]";
        parent.parent.sMenuSubItem = "[{oxmultilang ident="ACTIONS_LIST_MENUSUBITEM"}]";
        parent.parent.sWorkArea    = "[{$_act}]";
        parent.parent.setTitle();
    }
</script>
</body>
</html>
