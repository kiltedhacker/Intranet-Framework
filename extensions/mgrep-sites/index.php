<textarea class="form-control" id="min" style="width: 100%; height: 200px;" type=text placeholder="Enter block of text here!"></textarea>
<center><button class="btn btn-block btn-primary" style="margin: 5px 0 5px 0;" onclick="getIDs()" />Get IDs</center>
<textarea class="form-control" id="mdiv" style="width: 100%; height: 200px;" type=text placeholder="IDs magically appear here!"></textarea>

<script>
function getIDs()
{
	var target = document.getElementById("min").value;

    var output = target.replace(new RegExp("/.*?\..*",'g'),",");
	output = output.replace(new RegExp(" ", 'g'), "");
	output = output.replace(new RegExp("[\\n\\r]", 'g'), "");
	output = output.slice(0, -1);


	document.getElementById("mdiv").value = output;
}
</script>
