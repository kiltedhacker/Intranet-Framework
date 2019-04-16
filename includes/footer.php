  <div id="footer" style="overflow: auto;">
    <div class="col-sm-6">
      <?php
      if ($permissions >=80){
        echo $adm;
      } else {
        echo "";
      }?>
    </div>

    <div class="col-sm-6" style="text-align: right;">
      <span class="pull-right">
        &copy; <?PHP echo date('Y')?> <b>Kilted Hacker</b>. All Rights Reserved.<br>
        Portal
      </span>
    </div>
  </div>
</div>
