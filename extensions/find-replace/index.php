<textarea class="form-control" id="frin" style="width: 100%; height: 200px;" type=text placeholder="Enter block of text here!"></textarea>
<input class="form-control" id="find" type=text placeholder="Text to find" style="width: 100%;" />
<input class="form-control" id="replace" type=text placeholder="Replacement text" style="width: 100%; margin-bottom:5px;" />
<button class="btn btn-block btn-primary" style="margin-bottom:5px;" onclick="frep()" />Replace Text</button>
<textarea class="form-control" id="rdiv" style="width: 100%; height: 200px;" type="text" placeholder="Output will display here!"></textarea>

<script>
function frep()
{
	var target = escapeRegExp(document.getElementById("frin").value);
	var search = escapeRegExp(document.getElementById("find").value);
	var replacement = escapeRegExp(document.getElementById("replace").value);
    result = target.split(search).join(replacement);
	document.getElementById("rdiv").value = escapeRegExp(result);
}

function escapeRegExp(str) {
  return str.replace(/[.*+?^${}()|[\]\\]<>/g, "\\$&"); // $& means the whole matched string
}
</script>
