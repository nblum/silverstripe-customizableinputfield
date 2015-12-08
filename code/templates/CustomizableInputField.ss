<div class="customizable-input" id="customizable-input-$Name">
    <input $AttributesHTML />

    <div class="field-set">
        <% loop $Parts %>
            <div class="field-part">
                <span class="before" data-val="$beforeVal">$before</span>
                <span class="val"><input $AttributesHTML /></span>
                <span class="after" data-val="$afterVal">$after</span>
            </div>
        <% end_loop %>
    </div>
</div>
