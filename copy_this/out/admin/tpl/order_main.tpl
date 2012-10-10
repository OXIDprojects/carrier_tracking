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

function ThisDate( sID) 
{ 
	document.myedit['editval[oxorder__oxpaid]'].value=sID; 
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
    <input type="hidden" name="cl" value="order_main">
</form>


<form name="myedit" id="myedit" action="[{ $shop->selflink }]" method="post">
[{ $shop->hiddensid }]
<input type="hidden" name="cl" value="order_main">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="editval[oxorder__oxid]" value="[{ $oxid }]">
[{include file="autosave.form.tpl"}]

<table cellspacing="0" cellpadding="0" border="0" width="100%">

<tr>

    <td valign="top" class="edittext">
	
        <table cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="ORDER_MAIN_IPADDRESS" }]
            </td>
            <td class="edittext">
            [{$edit->oxorder__oxip->value }]
            </td>
        </tr>
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="GENERAL_ORDERNUM" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="15" maxlength="[{$edit->oxorder__oxordernr->fldmax_length}]" name="editval[oxorder__oxordernr]" value="[{$edit->oxorder__oxordernr->value }]" [{ $readonly }]>
            </td>
        </tr>
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="ORDER_MAIN_BILLNUM" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="15" maxlength="[{$edit->oxorder__oxbillnr->fldmax_length}]" name="editval[oxorder__oxbillnr]" value="[{$edit->oxorder__oxbillnr->value }]" [{ $readonly }]>
            </td>
        </tr>
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="ORDER_MAIN_TRACKCODE" }]&nbsp;&nbsp;
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="25" maxlength="[{$edit->oxorder__oxtrackcode->fldmax_length}]" name="editval[oxorder__oxtrackcode]" value="[{$edit->oxorder__oxtrackcode->value }]" [{ $readonly }]>
            </td>
        </tr>
		[{if $edit->oxorder__oxtrackcode->value}]
		<tr>
            <td class="edittext">
            [{ oxmultilang ident="GENERAL_CARRIER" }]
            </td>
            <td class="edittext">
             <select class="editinput" name="editval[oxorder__oxtrackadr]" [{ $readonly }]>
               [{ foreach from=$carrierlist item=oCarrier}]
               <option value="[{$oCarrier->oxcarriertracking__oxtrackadr->value}]" [{if $oCarrier->oxcarriertracking__oxtrackadr->value == $edit->oxorder__oxtrackadr->value}]selected[{/if}]>[{$oCarrier->oxcarriertracking__oxtitle->value}]</option>
               [{/foreach}]
             </select>
            </td>
        </tr>
		[{/if}]
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="GENERAL_DELIVERYCOST" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="15" maxlength="[{$edit->oxorder__oxdelcost->fldmax_length}]" name="editval[oxorder__oxdelcost]" value="[{$edit->oxorder__oxdelcost->value }]" [{ $readonly }]>
            </td>
        </tr>
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="ORDER_MAIN_DISCOUNT" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="15" maxlength="[{$edit->oxorder__oxoxdiscount->fldmax_length}]" name="editval[oxorder__oxdiscount]" value="[{$edit->oxorder__oxdiscount->value }]" [{ $readonly }]>
            </td>
        </tr>
		<tr> 
			<td class="edittext"> 
				[{ oxmultilang ident="ORDER_MAIN_PAIDON" }]
			</td> 
			<td class="edittext">[{assign var=date value=$edit->oxorder__oxpaid->value|replace:"0000-00-00 00:00:00":""}] 
				<input type="text" class="editinput" size="25" name="editval[oxorder__oxpaid]" value="[{$edit->oxorder__oxpaid|oxformdate }]" [{include file="help.tpl" helpid=article_vonbis}] [{ $readonly }]>&nbsp;<a href="Javascript:ThisDate('[{$sNowValue|oxformdate:'datetime':true}]');" class="edittext" [{if $readonly }]onclick="JavaScript:return false;"[{/if}]><u>[{ oxmultilang ident="ORDER_MAIN_CURRENT_DATE" }]</u></a> 			</td> 
		</tr> 
        <tr>
            <td class="edittext" valign="middle">
            <b>[{ oxmultilang ident="GENERAL_SENDON" }]</b>
            </td>
            <td class="edittext" valign="bottom">
			<b>[{$edit->oxorder__oxsenddate|oxformdate:'datetime':true }]</b>
            </td>
        </tr>
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br>
    		<input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" [{ $readonly }]><br><br>
            </td>
        </tr>
        [{foreach from=$aVouchers item=sVoucher}]
        <tr>
            <td class="edittext">
            [{ oxmultilang ident="ORDER_MAIN_USERVOUCHER" }]:&nbsp;
            </td>
            <td class="edittext">
            [{ $sVoucher }]
            </td>
        </tr>
        [{/foreach}]
        </table>

    </td>
    <!-- Anfang rechte Seite -->
    <td valign="top" class="edittext" align="left" width="50%">
        <table cellspacing="0" cellpadding="0" border="0">
    	<tr>
	    	<td class="edittext">[{ oxmultilang ident="ORDER_MAIN_DELTYPE" }]:</td>
	    	<td class="edittext">
				<select name="setDelSet" class="editinput" onChange="Javascript:document.myedit.fnc.value='changeDelSet'; document.myedit.submit();" style="width: 135px;">
				<option value="">----</option>
				[{foreach from=$oShipSet key=sShipSetId item=oShipSet}]
				<option value="[{ $sShipSetId }]" [{ if $edit->oxorder__oxdeltype->value == $sShipSetId }]SELECTED[{/if}]>[{$oShipSet->oxdeliveryset__oxtitle->value}]</option>
				[{/foreach}]
				</select>
			</td>
		</tr>
    	<tr>
	    	<td class="edittext">[{ oxmultilang ident="ORDER_MAIN_PAIDWITH" }]:</td>
	    	<td class="edittext">
	    		[{if $oPayments}]
					<select name="setPayment" class="editinput" onChange="Javascript:document.myedit.fnc.value='changePayment'; document.myedit.submit();" style="width: 135px;">
					<option value="oxempty" [{ if $edit->oxorder__oxpaymenttype->value == "oxempty" }]SELECTED[{/if}]>----</option>
					[{foreach from=$oPayments key=sPaymentId item=oPayment}]
					<option value="[{ $sPaymentId }]" [{ if $edit->oxorder__oxpaymenttype->value == $sPaymentId }]SELECTED[{/if}]>[{$oPayment->oxpayments__oxdesc->value}]</option>
					[{/foreach}]
					</select>
				[{else}]
					<b>[{$paymentType->oxpayments__oxdesc->value}]</b>
				[{/if}]
			</td>
		</tr>
		</table>
		<br/>
        <table cellspacing="0" cellpadding="0" border="0">
		[{ if $paymentType->aDynValues }]
        [{foreach from=$paymentType->aDynValues item=value}]
        <tr>
            <td class="edittext" width="70">
            [{ $value->name}]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="20" maxlength="64" name="dynvalue[[{$value->name}]]" value="[{ $value->value}]" [{ $readonly }]>
            </td>
        </tr>
        [{/foreach}]
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br><br>
            </td>
        </tr>
		[{/if}]
		</form>
		[{ if $edit->blIsPaid }]
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br>
				<b>[{ oxmultilang ident="ORDER_MAIN_ORDERPAID" }]: [{ $edit->oxorder__oxpaid->value|oxformdate:'datetime':true }]</b>
            </td>
        </tr>
		[{/if}]
		
		<form name="sendorder" id="sendorder" action="[{ $shop->selflink }]" method="post">
		[{ $shop->hiddensid }]
		<input type="hidden" name="cl" value="order_main">
		<input type="hidden" name="fnc" value="sendorder">
		<input type="hidden" name="oxid" value="[{ $oxid }]">
		<input type="hidden" name="editval[oxorder__oxid]" value="[{ $oxid }]">			
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext" style="border : 1px #A9A9A9; border-style : solid solid solid solid; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px;">
				<input type="submit" class="edittext" name="save" value="&nbsp;&nbsp;[{ oxmultilang ident="GENERAL_NOWSEND" }]&nbsp;&nbsp;" [{ $readonly }]><br>			
            	[{ oxmultilang ident="GENERAL_SENDEMAIL" }] <input class="edittext" type="checkbox" name="sendmail" value='1' [{ $readonly }]>
            </td>
        </tr>
		</form>

		<form name="resetorder" id="resetorder" action="[{ $shop->selflink }]" method="post">
		[{ $shop->hiddensid }]
		<input type="hidden" name="cl" value="order_main">
		<input type="hidden" name="fnc" value="resetorder">
		<input type="hidden" name="oxid" value="[{ $oxid }]">
		<input type="hidden" name="editval[oxorder__oxid]" value="[{ $oxid }]">			
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br>
				<input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SETBACKSENDTIME" }]" [{ $readonly }]>			
            </td>
        </tr>
		</form>

		
		</table>
	
	

    </td>


    </tr>
</table>

[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]
