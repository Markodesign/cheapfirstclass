  {$form_data.header.mainhdr}
  <form {$form_data.attributes}>
  {$form_data.hidden}
    <table class="form-lg mb0" border="0" cellspacing="0" cellpadding="0">
    {if $form_data.errors|@count || isset($smarty.get.status)}
    <tr>
      <td colspan="2" class="form-warn">
       {if $form_data.errors|@count}
           <div class="warn-bx" id="warning">
              <strong>Застереження!</strong><br/>
              У формі знайдені помилки.<br/>
              {*
              <div style="text-align:left;margin-left:20px;">
                {foreach from = $form_data.errors item=elem}
                  <br/>{$elem}
                {/foreach}
              </div>
              *}
           </div>
       {elseif $smarty.get.status == 'added'}
           <div class="warn-bx green" id="warning">
             <strong>Вітання!</strong><br/>
             Дані додано успішно!
           </div>
       {elseif $smarty.get.status == 'updated'}
           <div class="warn-bx green" id="warning">
             <strong>Вітання!</strong><br/>
             Дані змінено успішно!
           </div>
       {elseif $smarty.get.status == 'deleted'}
           <div class="warn-bx green" id="warning">
             <strong>Вітання!</strong><br/>
             Дані видалено успішно!
           </div>
       {/if}
     </td>
    </tr>
    {/if}
	  <!-- HEADER -->
      <tr>
        <td colspan="2">
            <h2>Крок 2<br /><small>Додати або редагувати елемент</small></h2>
        </td>
      </tr>
      <!-- HEADER -->

      <tr>
       <td colspan="2">
          {$form_data.hidden}
          {foreach from = $form_data item=elem}
          {if is_array($elem) && ($elem.name != "submit_buttons") && ($elem.type != "group")}

           {if $elem.type == "static"}
               <label class="mt20">{$elem.name}</label>
           {elseif isset($elem.html) && isset($elem.label)}
               <span class="fTitle" {if $elem.error} style='color:red;'{/if}>{if $elem.required}* {/if}{$elem.label}</span>
               {if $elem.error}<div style='color:red;'>{$elem.error}</div>{/if}
               {$elem.html}
           {elseif isset($elem.html)}
               {$elem.html}
           {/if}
          
          {/if}
          {/foreach}

       </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
      </tr>
    </table>

    {foreach from = $form_data item=elem}
    {if ($elem.name == "submit_buttons") && ($elem.type == "group")}
      <div class="submit">
          
        <div style="padding-left:19px;padding-top:10px;padding-right:7px;">
            {$elem.html}
            {*<input onclick="$('#warn_delete').show();return false;" type="button" name="deleteUser" value="Delete" />*}
        </div>

        <div class="hide" id="warn_delete" style="margin-top:20px;margin-left:20px;" style="display: none;">
            <div class="submit">
                <div class="warn-bx" id="warning">
                    <strong>Warning!</strong><br/>
                    Do you really want to delete this entry?
                    <div style="padding-top: 10px;">
                        <input type="submit" name="delete" value="Yes" />
                        <input type="submit" onclick="$('#warn_delete').hide();return false;" value="No" name="fSubmit" />
                    </div>
                </div>
            </div>
        </div>

      </div>
    {/if}
    {/foreach}

  </form>