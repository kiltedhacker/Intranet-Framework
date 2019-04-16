<div class="ink-shade fade">
  <div id="refangModal" class="ink-modal fade" data-width="40%" data-height="40%" role="dialog" aria-hidden="true" aria-labelled-by="modal-title">
    <div class="modal-header">
        <button class="ink-dismiss ink-button black push-right"><i class="fa fa-times"></i></button>
        <h2 id="modal-title">Refanged URL</h2>
    </div>
    <div class="modal-body" id="modalContent">
      <?php
      $phrase = htmlspecialchars($_POST['refang']);

      $refangers = array(
        "hXXp"=>"http",
        "[.]"=>"."
      );

      $refanger = array();
        $char = $phrase;
        $refanger[] = (ctype_upper($char) ? strtoupper(strtr(strtolower($char), $refangers)) : strtr($char, $refangers));
      $refanger = join('', $refanger);
      echo $refanger;
      ?>
      <br>
      <div class="ink-alert basic warning" role="alert">
        <p><b>Warning:</b> Only pull up the site in Silo Authentic8 or a virtual machine!</p>
      </div>
    </div>
  </div>
</div>
