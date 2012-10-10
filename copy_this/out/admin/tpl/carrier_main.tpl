[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<script type="text/javascript">
<!--
[{ if $updatelist == 1}]
    UpdateList('[{ $oxid }]');
[{ /if}]

function UpdateList( sID)
{
    var oSearch = parent.list.document.getElementById("search");
    oSearch.oxid.value=sID;
    oSearch.submit();
}

function EditThis( sID)
{
    var oTransfer = document.getElementById("transfer");
    oTransfer.oxid.value=sID;
    oTransfer.cl.value='article_main';
    oTransfer.submit();

    var oSearch = parent.list.document.getElementById("search");
    oSearch.oxid.value=sID;
    oSearch.submit();
}

function ChangeLstrt()
{
    var oSearch = document.getElementById("search");
    if (oSearch != null && oSearch.lstrt != null)
        oSearch.lstrt.value=0
}

function UnlockSave(obj)
{   var saveButton = document.myedit.saveArticle;
    if ( saveButton != null && obj != null )
    {   if (obj.value.length > 0)
            saveButton.disabled = false;
        else
            saveButton.disabled = true;
    }
}
function ChangeLanguage(obj)
{
    var oTransfer = document.getElementById("transfer");
    oTransfer.language.value=obj.value;
    oTransfer.submit();
}
function SetSticker( sStickerId, oObject)
{
    if ( oObject.selectedIndex != -1)
    {   oSticker = document.getElementById(sStickerId);
        oSticker.style.display = "";
        oSticker.style.backgroundColor = "#FFFFCC";
        oSticker.style.borderWidth = "1px";
        oSticker.style.borderColor = "#000000";
        oSticker.style.borderStyle = "solid";
        oSticker.innerHTML         = oObject.item(oObject.selectedIndex).innerHTML;
    }
    else
        oSticker.style.display = "none";
}

function ThisDate( sID) 
{ 
	document.myedit['editval[oxcarriertracking__oxinsert]'].value=sID; 
} 
//-->
</script>

[{ if $readonly }]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="oxidCopy" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="carrier_main">
    <input type="hidden" name="language" value="[{ $actlang }]">
</form>

<form name="myedit" id="myedit" enctype="multipart/form-data" action="[{ $shop->selflink }]" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="[{$iMaxUploadFileSize}]">
[{ $shop->hiddensid }]
<input type="hidden" name="cl" value="carrier_main">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="voxid" value="[{ $oxid }]">
<input type="hidden" name="oxparentid" value="[{ $oxparentid }]">
<input type="hidden" name="editval[oxcarriertracking__oxid]" value="[{ $oxid }]">
<input type="hidden" name="language" value="[{ $actlang }]">
[{include file="autosave.form.tpl"}]

<table border="0" width="98%">
<tr>
    <td valign="top" class="edittext">

        <table cellspacing="0" cellpadding="0" border="0">

        <tr>
            <td class="edittext" width="120">
            [{ oxmultilang ident="GENERAL_ACTIVE" }]
            </td>
            <td class="edittext">
            <input class="edittext" type="checkbox" name="editval[oxcarriertracking__oxactive]" value='1' [{if $edit->oxcarriertracking__oxactive->value == 1}]checked[{/if}] [{ $readonly }]>
            </td>
        </tr>
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="GENERAL_TITLE" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="40" maxlength="[{$edit->oxcarriertracking__oxtitle->fldmax_length}]" name="editval[oxcarriertracking__oxtitle]" value="[{$edit->oxcarriertracking__oxtitle->value}]" [{if !$oxparentid}]onchange="JavaScript:UnlockSave(this);" onkeyup="JavaScript:UnlockSave(this);" onmouseout="JavaScript:UnlockSave(this);"[{/if}] [{ $readonly }]>
            </td>
        </tr>
		<tr>
            <td class="edittext">
            [{ oxmultilang ident="GENERAL_DATE" }]
            </td>
            <td class="edittext">
			<input type="text" class="editinput" size="25" name="editval[oxcarriertracking__oxinsert]" value="[{$edit->oxcarriertracking__oxinsert|oxformdate }]" [{ $readonly }]>
            </td>
        </tr>
		<tr>
            <td class="edittext">
            &nbsp;
            </td>
            <td class="edittext">
			<a href="Javascript:ThisDate('[{$sNowValue|oxformdate:'datetime':true}]');" class="edittext" [{if $readonly }]onclick="JavaScript:return false;"[{/if}]><u>[{ oxmultilang ident="ORDER_MAIN_CURRENT_DATE" }]</u></a> 
            </td>
        </tr>
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="GENERAL_SHORTDESC" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="40" maxlength="[{$edit->oxcarriertracking__oxshortdesc->fldmax_length}]" name="editval[oxcarriertracking__oxshortdesc]" value="[{$edit->oxcarriertracking__oxshortdesc->value}]" [{ $readonly }]>
            </td>
        </tr>
		 <tr>
            <td class="edittext">
            [{ oxmultilang ident="GENERAL_URL }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="40" maxlength="[{$edit->oxcarriertracking__oxtrackadr->fldmax_length}]" name="editval[oxcarriertracking__oxtrackadr]" value="[{$edit->oxcarriertracking__oxtrackadr->value}]" [{ $readonly }]>
            </td>
        </tr>
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="GENERAL_SORT" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="5" maxlength="[{$edit->oxcarriertracking__oxorder->fldmax_length}]" name="editval[oxcarriertracking__oxorder]" value="[{$edit->oxcarriertracking__oxorder->value}]" [{ $readonly }]>
            </td>
        </tr>
        [{if $oxid != "-1"}]
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br>
                [{include file="language.tpl"}]
            </td>
        </tr>
        [{/if}]
        <tr>
            <td class="edittext"><br><br>
            </td>
            <td class="edittext"><br><br>
            <input type="submit" class="edittext" name="saveArticle" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" [{ $readonly }] [{ if !$edit->oxcarriertracking__oxtitle->value && !$oxparentid }]disabled[{/if}] [{ $readonly }]><br>
            </td>
        </tr>


        </table>
    </td>
  </tr>
</table>

</form>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]