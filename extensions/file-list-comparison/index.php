<div class="column-group gutters">
	<div class="all-50 small-100 tiny-100">
		<textarea class="form-control" id="host" style="width: 100%; height: 200px" type=text placeholder="List from host"></textarea>
	</div>
	<div class="all-50 small-100 tiny-100">
		<textarea class="form-control" id="smart" style="width: 100%; height: 200px" type=text placeholder="List of cleaned files"></textarea>
	</div>
</div>
<center><b>Files Flagged by Host Not Cleaned</b></center>
<textarea class="form-control" id="compared" style="width: 100%; height: 200px;" type=text placeholder="Output will display here"></textarea>
<button class="btn btn-block btn-primary" onclick="replace()">Compare</button>

<script>
function replace()
{
	var smart = document.getElementById("smart").value;
	var host = document.getElementById("host").value;
	var output="";
	var matched = false;
	smart = smart.split('\n');
	host = host.split('\n');

   for(var a = 0;a < host.length;a++)
   {
	    matched = false;
		for(var b = 0;b < smart.length;b++)
		{
			if(host[a] == smart[b])
			{
				matched = true;
				break;
			}
		}
		if(matched == false)
		{
			output = output + host[a]+"\n";
		}
	}

	document.getElementById("compared").value = output;
}
</script>
