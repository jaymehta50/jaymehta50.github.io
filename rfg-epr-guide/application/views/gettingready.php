<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="spa-section" id="readiness" style="background-image: url(https://royalfree.info/assets/img/passport.jpg);background-size: cover;background-position: center;background-repeat: no-repeat;">
  <div class="container">
    <div class="row">
      <div class="col s10 offset-s1">
        <div class="section center">
          <h1 class="header">Getting Ready for New EPR</h1>
          <p>Use this list below to make sure you're ready for new EPR.</p>
        </div>
      </div>
    </div>

    <div class="section readinesscards">
        <?php
        $i = 0;
        foreach ($readiness as $key => $value) {
          $i++;
          if(($i%3)==1) echo '<div class="row">';
          echo '<div class="col s12 l4">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light center activator">
              <i class="material-icons orange-text" style="font-size: 106px;" id="ready'.$i.'no">hourglass_empty</i>
              <i class="material-icons green-text" style="font-size: 106px; display: none;" id="ready'.$i.'yes">check</i>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">'.$value['title'].'<i class="material-icons right">more_vert</i></span>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4">EPR eLearning<i class="material-icons right">close</i></span>
              <p>'.$value['text'].'</p>
              <button class="waves-effect waves-light btn right card-title" onClick="toggleReadiness('.$i.')" id="btnreadiness'.$i.'">Mark as Complete</button>
            </div>
          </div>
          </div>';
          if(($i%3)==0) echo '</div>';
        }
        ?>

    </div>
  </div>
</div>