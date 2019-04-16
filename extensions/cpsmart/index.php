<div id="ftpTabs" class="ink-tabs top">
    <ul class="nav nav-pills nav-justified">
        <li role="presentation" class="active"><a data-toggle="tab" class="tabs-tab sl-red" href="#templategen">Template</a></li>
        <li role="presentation"><a data-toggle="tab" class="tabs-tab sl-red" href="#cpsmart">cPanel SMART</a></li>
    </ul>
    <div class="tab-content">
      <div id="templategen" class="tab-pane fade in active">
          <?php include 'extensions/ftp-template/index.php'; ?>
      </div>
      <div id="cpsmart" class="tab-pane fade">
          <?php include 'extensions/cpsmart/setup-form.php'; ?>
      </div>
    </div>
</div>
