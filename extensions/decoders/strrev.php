<script>
function strrev(s){
    var output = s.split("").reverse().join("");
    document.getElementById('strrevoutput').value = output;

}
</script>
<textarea class="form-control" style="resize:vertical;width:100%;margin-bottom:5px" id="strrevinput" placeholder="Input"></textarea>
<input type="submit" onclick="strrev(document.getElementById('strrevinput').value)" value="Reverse" class="btn btn-block btn-primary">
<textarea class="form-control" style="resize:vertical;width:100%;height:273px;margin-top:5px" readonly id="strrevoutput" placeholder="Output"></textarea>
