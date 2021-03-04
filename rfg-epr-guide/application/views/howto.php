<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="spa-section container" id="howto">
  <div class="row">
    <div class="col s10 offset-s1">
      <div class="section center">
        <h1 class="header">How To Guide</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Main content -->
    <div class="col s12">
      <div class="section">

        <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
          <?php 
          $prevmedia = "";
          foreach ($how as $key => $howto) {
            if($prevmedia != $howto['media']) {
              echo '<li class="tab"><a href="#howto-'.str_replace(' ','',$howto['media']).'">'.$howto['media'].'</a></li>';
            }
            $prevmedia = $howto['media'];
          }
          ?>
        </ul>

        <?php
        $notfirst = FALSE;
        $prevmedia = "";
        $prevactivity = "";
        foreach ($how as $key => $howto) {
          if($howto['media'] != $prevmedia) {
            if($notfirst) echo '</div>';
            echo '<div id="howto-'.str_replace(' ','',$howto['media']).'" class="col s12">';
          }

          if ($howto['activity'] != $prevactivity) {
            if($notfirst) echo '<hr />';
            echo '<h3>'.$howto['activity'].'</h3>';
            if($howto['media']=="Quick Guides") echo '<div class="row">
              <div class="col s12">
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">search</i>
                    <input type="text" id="autocomplete-input" class="autocomplete" oninput="findQrg()">
                    <label for="autocomplete-input">Search</label>
                  </div>
                </div>
              </div>
            </div>';
          }

          echo '<div class="row center" data-search="'.$howto['name'].'"><div class="col s12 m9"><p>'.$howto['name'].'</p></div><div class="col s12 m3"><a class="waves-effect waves-light btn" href="'.$howto['link'].'" target="_blank">';
          if($howto['media']=="Video") echo '<i class="material-icons right">video_library</i>Watch';
          else echo '<i class="material-icons right">launch</i>View';
          echo '</a></div></div>';

          $notfirst = TRUE;
          $prevactivity = $howto['activity'];
          $prevmedia = $howto['media'];
        }
        echo '</div>';
        ?>
      </div>
    </div>
  </div>
</div>