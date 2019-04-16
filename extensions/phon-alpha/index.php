<script>
function convertTextToNato()
{
    var textToConvert = document.getElementById('textToConvert').value;
    document.getElementById('conversionResults').innerHTML = textToNato(textToConvert);
}

function textToNato(text)
{
    var newline = '<br />';
    var results = '';

    text = text.toUpperCase();

    for (var i=0; i < text.length; i++)
    {
        switch (text.charAt(i))
        {
            case 'A': results = results + 'alfa '; break;
            case 'B': results = results + 'bravo '; break;
            case 'C': results = results + 'charlie '; break;
            case 'D': results = results + 'delta '; break;
            case 'E': results = results + 'echo '; break;
            case 'F': results = results + 'foxtrot '; break;
            case 'G': results = results + 'golf '; break;
            case 'H': results = results + 'hotel '; break;
            case 'I': results = results + 'india '; break;
            case 'J': results = results + 'juliett '; break;
            case 'K': results = results + 'kilo '; break;
            case 'L': results = results + 'lima '; break;
            case 'M': results = results + 'mike '; break;
            case 'N': results = results + 'november '; break;
            case 'O': results = results + 'oscar '; break;
            case 'P': results = results + 'papa '; break;
            case 'Q': results = results + 'quebec '; break;
            case 'R': results = results + 'romeo '; break;
            case 'S': results = results + 'sierra '; break;
            case 'T': results = results + 'tango '; break;
            case 'U': results = results + 'uniform '; break;
            case 'V': results = results + 'victor '; break;
            case 'W': results = results + 'whiskey '; break;
            case 'X': results = results + 'xray '; break;
            case 'Y': results = results + 'yankee '; break;
            case 'Z': results = results + 'zulu '; break;
            case '0': results = results + 'zero '; break;
            case '1': results = results + 'one '; break;
            case '2': results = results + 'two '; break;
            case '3': results = results + 'three '; break;
            case '4': results = results + 'four '; break;
            case '5': results = results + 'five '; break;
            case '6': results = results + 'six '; break;
            case '7': results = results + 'seven '; break;
            case '8': results = results + 'eight '; break;
            case '9': results = results + 'niner '; break;
            case ' ': results = results + newline; break;
            default: results = results + text.charAt(i) + ' ';
        }
    }

    return results;
}
</script>

<input id="textToConvert" type="text" class="form-control" style="width: 100%;" name="textToConvert" placeholder="Text To Convert" />
<input type="submit" id="convertText1" value="Sound It Out" class="btn btn-block btn-primary" data-toggle="modal" data-target="#paModal" onclick="convertTextToNato()"/>

<!-- MODAL -->
<div id="paModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Phonetic Text</h4>
      </div>
      <div class="modal-body">
        <p id="conversionResults"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
