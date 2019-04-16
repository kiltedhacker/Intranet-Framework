<script>
function b64encode()
{
  var input = document.getElementById('b64input');
  var output = document.getElementById('b64output');
  output.value = window.btoa(input.value);

}
function b64decode()
{
  var input = document.getElementById('b64input');
  var output = document.getElementById('b64output');
  output.value = window.atob(input.value);
}
</script>
<textarea class="form-control" style="resize:vertical;width:100%;" id="b64input" placeholder="Input"></textarea>
<div class="col-md-6" style="padding: 0px; margin:5px 0 5px 0;"><input type="submit" onclick="b64encode()" value="Encode" class="btn btn-block btn-primary"></div>
<div class="col-md-6" style="padding: 0px; margin:5px 0 5px 0; border-left: 1px solid #fff"><input type="submit" onclick="b64decode()" value="Decode" class="btn btn-block btn-primary"></div>
<textarea class="form-control" style="resize:vertical;width:100%;height:273px;" readonly id="b64output" placeholder="Output"></textarea>
