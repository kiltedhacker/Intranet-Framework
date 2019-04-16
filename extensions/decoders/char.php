<script>
// toHex and fromHex functions nabbed from https://gist.github.com/valentinkostadinov/5875467
function toHex(s) {
    // utf8 to latin1
    var s = unescape(encodeURIComponent(s))
    var h = ''
    for (var i = 0; i < s.length; i++) {
        h += s.charCodeAt(i).toString(16)
    }
    return h
}

function fromHex(h) {
    var s = ''
    for (var i = 0; i < h.length; i+=2) {
        s += String.fromCharCode(parseInt(h.substr(i, 2), 16))
    }
    return decodeURIComponent(escape(s))
}

function hencode()
{
  var input = document.getElementById('hexinput');
  var output = document.getElementById('hexoutput');
  output.value = toHex(input.value);
}

function hdecode()
{
  var input = document.getElementById('hexinput');
  var output = document.getElementById('hexoutput');
  output.value = fromHex(input.value);
}
</script>
<textarea style="resize:vertical;width:100%;margin-bottom:5px;" id="hexinput" placeholder="Input"></textarea><br />
<input type="submit" onclick="hencode()" value="Encode" class="ink-button sl-red">
<input type="submit" onclick="hdecode()" value="Decode" class="ink-button sl-red">
<textarea style="resize:vertical;width:100%;height:273px;margin-top:5px" readonly id="hexoutput" placeholder="Output"></textarea>
