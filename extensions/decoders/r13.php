<script>
function rot13(s) {
  var output = s.replace(/[A-Za-z]/g, function (c) {
    return "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz".charAt(
           "NOPQRSTUVWXYZABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm".indexOf(c)
    );
  } );
  document.getElementById('rot13output').value = output;
}
</script>
<textarea class="form-control" style="resize:vertical;width:100%;margin-bottom:5px;" id="rot13input" placeholder="Input"></textarea>
<input type="submit" onclick="rot13(document.getElementById('rot13input').value)" value="Encode/Decode" class="btn btn-block btn-primary">
<textarea class="form-control" style="resize:vertical;width:100%;height:273px;margin-top:5px" readonly id="rot13output" placeholder="Output"></textarea>
