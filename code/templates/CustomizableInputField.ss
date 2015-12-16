<div class="customizable-input" id="customizable-input-$Name">
    <input $AttributesHTML />

    <div class="field-set">
        <% loop $Parts %>
            <div class="field-part">
                <span class="before" data-val="$beforeVal">$before</span>
                <% if $type == 'customizabledropdownpart' %>

                    <select $AttributesHTML>

                        <% loop $Options %>
                            <option value="$Value"<% if $Up.Selected = $Value %>
                                    selected="selected"<% end_if %><% if $Disabled %>
                                    disabled="disabled"<% end_if %>>$Title</option>
                        <% end_loop %>
                    </select>
                <% else %>
                    <span class="val"><input $AttributesHTML data-whitespaces="$whitespaces"
                                                             data-allowedsigns="$allowedSigns"/></span>
                <% end_if %>
                <span class="after" data-val="$afterVal">$after</span>
            </div>
        <% end_loop %>
    </div>
</div>
