<script>
function escapeText()
{
	str = document.getElementById("escinput").value; // Read Text box / field
	var escape = new Array(".","^","$","*","+","-","?","(",")","[","]","{","}","\\","|");
var escaped="";
var hasMatched;
	for(var a=0; a<str.length; a++)
	{
		hasMatched = false;
		for(b=0; b<escape.length; b++)
		{
			theChar = str.charAt(a);
			if(theChar.match("\\"+escape[b]))
			{

				escaped += theChar.replace(theChar, "\\"+theChar);
				hasMatched = true;
				b=escape.length;
			}


		}
		if(hasMatched == false)
		{
			escaped += theChar;
		}
	}
	document.getElementById("escoutput").innerHTML = escaped;
}
</script>
<textarea class="form-control" style="resize:vertical;width:100%;margin-bottom:5px;" id="escinput" placeholder="Input"></textarea>
<input type="submit" onclick="escapeText()" value="Escape" class="btn btn-block btn-primary">
<textarea class="form-control" style="resize:vertical;width:100%;height:273px;margin-top:5px" readonly id="escoutput" placeholder="Output"></textarea>
