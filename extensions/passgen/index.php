<div id="passgenContent">
  <div class="alert alert-info">Use the current password, generate a new one, or generate one based on the advanced options.</div>
  <input  class="btn btn-primary" type="submit" style="width:100%; margin-bottom:10px;" onclick="passgenv2()" value="Generate a New Password">
  <div class="ink-form">
    <div class="form-inline">
      <div class="form-group append-button copy" role="copy">
        <span><input type="text" id="passoutput" readonly size="30" value="" style="border:none;"></span>
        <!-- button data-copytarget="#passoutput" class="btn btn-primary copy">Copy</button -->
      </div>
    </div>
  </div>
    <br><input type="checkbox" id="passgencheckbox" onclick="passgenshowadvanced()"> Advanced Options
    <div id="passgenadvanced" style="display:none;font-size:12px">
    Use <input type="text" id="numletters" value="6" size="1"> letters.<br />
    Use <input type="text" id="numnums" value="2" size="1"> numbers.<br />
    And use <input type="text" id="numspecial" value="1" size="1"> of the following:
    <input type="text" id="specialavailable" value="!@#%" size="4">
    </div>

<script>
function passgenv2(){

  var pass = ""; // Password is currently empty
  var lettersAvailable = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; // Select from these letters
  var numbersAvailable = "0123456789"; // Select from these numbers
  var specialField = document.getElementById('specialavailable');
  var specialAvailable = specialField.value; // Select from the special characters input by user

  // If they want to use letters, select the chosen number of letters from the available list and append them to the password
  if (document.getElementById('numletters').value > 0){
        for (var x = 0; x < document.getElementById('numletters').value; x++) {
        var i = Math.floor(Math.random() * lettersAvailable.length);
        pass += lettersAvailable.charAt(i);
    }
  }
  // If they want to use numbers, select the chosen number of numbers from the available list and append them to the password
  if (document.getElementById('numnums').value > 0){
        for (x = 0; x < document.getElementById('numnums').value; x++) {
        i = Math.floor(Math.random() * numbersAvailable.length);
        pass += numbersAvailable.charAt(i);
    }
  }

  // If they want to use special characters, select the chosen number of characters from the available list and append them to the password
  if (document.getElementById('numspecial').value > 0){
        for (x = 0; x < document.getElementById('numspecial').value; x++) {
        i = Math.floor(Math.random() * specialAvailable.length);
        pass += specialAvailable.charAt(i);
    }
  }

  // Now that the characters to use have been queued, shuffle them around a bit.
  var pass = pass.split('').sort(function(){return 0.5-Math.random()}).join('');
  var pass = pass.split('').sort(function(){return 0.5-Math.random()}).join('');
  var pass = pass.split('').sort(function(){return 0.5-Math.random()}).join('');
  var pass = pass.split('').sort(function(){return 0.5-Math.random()}).join('');
  var pass = pass.split('').sort(function(){return 0.5-Math.random()}).join('');
  var pass = pass.split('').sort(function(){return 0.5-Math.random()}).join('');

  // And output to the text field.
  document.getElementById('passoutput').value = pass;

}
function passgenshowadvanced(){

  if(document.getElementById('passgencheckbox').checked == true) {
    document.getElementById('passgenadvanced').style.display = "block";
  } else {
    document.getElementById('passgenadvanced').style.display = "none";
  }
}

(function() {

    'use strict';

  // click events
  document.body.addEventListener('click', copy, true);

    // event handler
    function copy(e) {

    // find target element
    var
      t = e.target,
      c = t.dataset.copytarget,
      inp = (c ? document.querySelector(c) : null);

    // is element selectable?
    if (inp && inp.select) {

      // select text
      inp.select();

      try {
        // copy text
        document.execCommand('copy');
        inp.blur();

        // copied animation
        t.classList.add('copied');
        setTimeout(function() { t.classList.remove('copied'); }, 1500);
      }
      catch (err) {
        alert('please press Ctrl/Cmd+C to copy');
      }
    }
    }
})();
</script>
