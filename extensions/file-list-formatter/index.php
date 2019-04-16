<textarea class="form-control" id="reg" style="width: 100%; height: 200px;" type=text placeholder="Enter block of text here!"></textarea>
<center><button class="btn btn-block btn-primary" style="margin: 5px 0 5px 0;" onclick="replace()" />Clean List</center>
<textarea class="form-control" id="cdiv" style="width: 100%; height: 200px;" type=text placeholder="Output will display here!"></textarea>

<script>
function replace()
{
	var target = document.getElementById("reg").value;

    var output = target.replace(new RegExp("[ \t]No",'g'),"");
	output = output.replace(new RegExp("[ \t]Yes", 'g'), "");
	output = output.replace(new RegExp("[ \t][0-9]", 'g'), "");
	output = output.replace(new RegExp("^\\s*\\n", 'gm'), "");

	document.getElementById("cdiv").value = output;
}
</script>
