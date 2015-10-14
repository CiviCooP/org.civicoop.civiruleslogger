<p><a href="{crmURL p="civicrm/civirule/form/rule" q="reset=1&action=update&id=`$rule->id`"}">{ts}Go back{/ts}</a></p>

<table>
    <thead class="sticky">
        <tr>
            <th>{ts}Time{/ts}</th>
            <th>{ts}Level{/ts}</th>
            <th>{ts}Message{/ts}</th>
            <th>{ts}Context{/ts}</th>
            <th>{ts}Contact{/ts}</th>
        </tr>
    </thead>

    <tbody>

    {foreach from=$logEntries item=entry}
        <tr class="{cycle values="odd-row,even-row"}">
            <td>{$entry.timestamp}</td>
            <td>{$entry.level}</td>
            <td>{$entry.message}</td>
            <td><pre>{$entry.context}</pre></td>
            <td>
                {if (!empty($entry.display_name))}
                    <a href="{$entry.contact_link}">{$entry.display_name}</a>
                {else}
                    {$entry.contact_id}
                {/if}
            </td>
        </tr>

    {/foreach}

    </tbody>

</table>

{include file="CRM/common/pager.tpl" location="bottom"}