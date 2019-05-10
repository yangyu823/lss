<div id="swapper-first" style="display:block; border:2px dashed red; padding:25px;">
    <p style="margin:0; color:red;">
        This div displayed when the web page first loaded.
    </p>
</div>
<div id="swapper-other" style="display:none; border:2px dotted blue; padding:25px;">
    <p style="margin:0; color:blue;">
        This div displayed when the link was clicked.
    </p>
</div>




<script type="text/javascript">
    function SwapDivsWithClick(div1,div2)
    {
        d1 = document.getElementById(div1);
        d2 = document.getElementById(div2);
        if( d2.style.display == "none" )
        {
            d1.style.display = "none";
            d2.style.display = "block";
        }
        else
        {
            d1.style.display = "block";
            d2.style.display = "none";
        }
    }
</script>


<p style="text-align:center; font-weight:bold; font-style:italic;">
    <a href="javascript:SwapDivsWithClick('swapper-first','swapper-other')">(Swap Divs)</a>
</p>

