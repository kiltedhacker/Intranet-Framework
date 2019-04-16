<?php
$phrase = htmlspecialchars($_POST['defang']);

$defangers = array(
  "http"=>"hXXp",
  "."=>"[.]"
);

$defanger = array();
  $char = $phrase;
  $defanger[] = (ctype_upper($char) ? strtoupper(strtr(strtolower($char), $defangers)) : strtr($char, $defangers));
$defanger = join('', $defanger);
echo $defanger;
?>


<div class="modal fade" id="defangModal" tabindex="-1" role="dialog" aria-labelledby="defangModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="defangModalLabel">Defanged URL</h4>
      </div>
      <div class="modal-body">
        <?php
        $phrase = htmlspecialchars($_POST['defang']);

        $defangers = array(
          "http"=>"hXXp",
          "."=>"[.]"
        );

        $defanger = array();
          $char = $phrase;
          $defanger[] = (ctype_upper($char) ? strtoupper(strtr(strtolower($char), $defangers)) : strtr($char, $defangers));
        $defanger = join('', $defanger);
        echo $defanger;
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    // Show the Modal on load
    $('#defangModal').modal('show');
});
</script>
