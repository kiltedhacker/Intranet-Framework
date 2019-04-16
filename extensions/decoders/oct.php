<script>
function tooct(s) {
    var s = unescape(encodeURIComponent(s))
    var h = ''
    for (var i = 0; i < s.length; i++) {
        h += s.charCodeAt(i).toString(8)
    }
    return h
}

function fromoct(h) {
    var s = ''
    for (var i = 0; i < h.length; i+=2) {
        s += String.fromCharCode(parseInt(h.substr(i, 2), 8))
    }
    return decodeURIComponent(escape(s))
}

function oencode()
{
  var input = document.getElementById('octinput');
  var output = document.getElementById('octoutput');
  output.value = tooct(input.value);
}

function odecode()
{
  var input = document.getElementById('octinput');
  var output = document.getElementById('octoutput');
  output.value = fromoct(input.value);
}
</script>
<textarea style="resize:vertical;width:100%;margin-bottom:5px;" id="octinput" placeholder="Input"></textarea><br />
<input type="submit" onclick="oencode()" value="Encode" class="ink-button sl-red">
<input type="submit" onclick="odecode()" value="Decode" class="ink-button sl-red">
<textarea style="resize:vertical;width:100%;height:273px;margin-top:5px" readonly id="octoutput" placeholder="Output"></textarea>
