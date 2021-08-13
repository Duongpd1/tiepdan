<div class="autocomplete-items">

    @if(!empty($data))
        @foreach($data as $value)

            <div id="autocomplete-items-{{$value->donthuid}}" onclick="objAuto.click_div(this.id);">
                {!! str_ireplace($key, '<span style="color: #daa732;">'.$key.'</span>', $value->tennguoivietdon) !!}
                <input value="{{$value->tennguoivietdon}}" type="hidden" class="input-auto"/>
                <input value="{{$value->donthuid}}" type="hidden" class="input-auto"/>
            </div>

        @endforeach
    @endif
</div>


<script type="text/javascript">

    var objAuto = {
        id_fill_value:'{{$id}}',
        click_div: function (id) {
            var tag_div = document.getElementById(id);
            var value = tag_div.getElementsByTagName("input")[0].value;
            var id_result = tag_div.getElementsByTagName("input")[1].value;
            $('#'+objAuto.id_fill_value).val(value);
            $('#hide_'+objAuto.id_fill_value).val(id_result);
            $('.autocomplete-items').hide();
        }
    };

</script>

