<?php
/*
if ($admin >= 3){
  echo "<div id='defangTabs' class='ink-tabs top'>
    <ul class='tabs-nav'>
      <li><a class='tabs-tab sl-red' href='#defang'>Defang</a></li>
      <li><a class='tabs-tab sl-red' href='#refang'>Refang</a></li>
    </ul>

    <div id='defang' class='tabs-content'>";
      if (empty($_POST['defang'])) {
        echo "<form action='' method='post'>
          <input type='text' class='form-control' name='defang' placeholder='Enter URL here' style='width: 100%;'></input>
          <input type='hidden' name='pageView' value='".$page."'>
          <button type='submit' class='btn btn-block btn-primary' style='width: 100%;'>Defang</button>
        </form>";
      } else {
        echo "<form action='' method='post'>
          <input type='text' class='form-control' name='defang' placeholder='Enter URL here' style='width: 100%;'></input>
          <input type='hidden' name='pageView' value='".$page."'>
          <button type='submit' class='btn btn-block btn-primary' style='width: 100%;'>Defang</button>
        </form>";
        include "content/plugs/defanger/dresult.php";
      }
    echo "</div>
    <div id='refang' class='tabs-content'>";
      if (empty($_POST['refang'])) {
        echo "<form action='' method='post'>
          <input type='text' class='form-control' name='refang' placeholder='Enter URL here' style='width: 100%;'></input>
          <input type='hidden' name='pageView' value='".$page."'>
          <button type='submit' class='btn btn-block btn-primary' style='width: 100%;'>Refang</button>
        </form>";
      } else {
        echo "<form action='' method='post'>
          <input type='text' class='form-control' name='refang' placeholder='Enter URL here' style='width: 100%;'></input>
          <input type='hidden' name='pageView' value='".$page."'>
          <button type='submit' class='btn btn-block btn-primary' style='width: 100%;'>Refang</button>
        </form>";
        include "content/plugs/defanger/rresult.php";
      }
    echo "</div>
  </div>";
} else {
  if (empty($_POST['defang'])) {
    echo "<form action='' method='post'>
      <input type='text' class='form-control' name='defang' placeholder='Enter URL here' style='width: 100%;'></input>
      <input type='hidden' name='pageView' value='".$page."'>
      <button type='submit' class='btn btn-block btn-primary' style='width: 100%;'>Defang</button>
    </form>";
  } else {
    echo "<form action='' method='post'>
      <input type='text' class='form-control' name='defang' placeholder='Enter URL here' style='width: 100%;'></input>
      <input type='hidden' name='pageView' value='".$page."'>
      <button type='submit' class='btn btn-block btn-primary' style='width: 100%;'>Defang</button>
    </form>";
    include "content/plugs/defanger/dresult.php";
  }
}
*/
?>

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

if (empty($_POST['defang'])) {
  echo "<form action='' method='post'>
    <input type='text' class='form-control' name='defang' placeholder='Enter URL here' style='width: 100%;'></input>
    <input type='hidden' name='pageView' value='".$page."'>
    <button type='submit' class='btn btn-block btn-primary' style='width: 100%;'>Defang</button>
  </form>";
} else {
  echo "<form action='' method='post'>
    <input type='text' class='form-control' name='defang' value='".$defanger."' style='width: 100%;'></input>
    <input type='hidden' name='pageView' value='".$page."'>
    <button type='submit' class='btn btn-block btn-primary' style='width: 100%;'>Defang</button>
  </form>";
}
?>
