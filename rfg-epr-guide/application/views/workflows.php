<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="spa-section container" id="workflows">
  <div class="row">
    <div class="col s10 offset-s1">
      <div class="section center">
        <h1 class="header">Workflows</h1>
        <p>Please answer the following questions so we can direct you to the most appropriate workflows:</p>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Main content -->
    <div class="col s12">
      <?php 
      $notfirst = FALSE;
      $i = 0;
      $prevq = 0;
      foreach ($sscqs as $key => $value) {
        if ($value['qid']!=$prevq) {
          if($notfirst) {
            echo '<div class="divider"></div></div>';
          }

          echo '<div class="section sscq center';
          if($i==0) echo ' sscq-active';
          echo '" id="sscq'.$value['qid'].'"><h4>'.$value['question'].'</h4>';
        }

        if($i%2 == 0) echo '<div class="row valign-wrapper">';
        echo '<div class="col s6"><button class="waves-effect waves-light btn ssca';
        if(isset($value['sscid']) && !is_null($value['sscid']) && $value['sscid']!="") echo ' light-blue lighten-1" data-route="ssc-'.$value['sscid'].'"';
        else echo '" onClick="nextquestion('.$value['nextqid'].', '.$value['qid'].')"';
        
        echo '>'.$value['answer'].'</button></div>';
        if($i%2 == 1) echo '</div>';

        $notfirst = TRUE;
        $prevq = $value['qid'];
        $i++;
      }
      echo '</div>';
      
      ?>
    </div>
  </div>
</div>

<?php
foreach ($ssc as $key => $value) { ?>
<div class="spa-section container" id="ssc-<?php echo $value['id']; ?>">
  <nav class="breadcrumbnav purple lighten-2">
    <div class="nav-wrapper">
      <div class="col s12">
        <a data-route="workflows" class="breadcrumb">Workflows</a>
        <a class="breadcrumb"><?php echo $value['area']; ?></a>
      </div>
    </div>
  </nav>
  <div class="row">
    <div class="col s10 offset-s1">
      <div class="section center">
        <h1 class="header"><?php echo $value['area']; ?></h1>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Main content -->
    <div class="col s12">
      <div class="section">

        <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
          <?php 
          $first = TRUE;
          foreach ($value['segments'] as $key2 => $value2) {
            echo '<li class="tab"><a href="#ssc-'.$value['id'].'-'.$value2['id'].'"';
            if ($first) echo ' class="active"';
            echo '>'.$value2['segment'].'</a></li>';
            $first = FALSE;
          }
          ?>
        </ul>
        <?php foreach ($value['segments'] as $key2 => $value2) { ?>
          <div id="ssc-<?php echo $value['id'].'-'.$value2['id']; ?>" class="col s12">
            <h4><?php echo $value2['segment']; ?></h4>
            <ul class="collapsible collapsible-accordion">
              <?php 
              $notfirst = FALSE;
              $prevaction = "";
              $result = array('start' => array(), 'stop' => array(), 'cont' => array());
              $i = 1;
              $len = count($value2['actions']);
              foreach ($value2['actions'] as $key3 => $action) {
                if(($notfirst && $prevaction!=$action['action']) || ($i==$len)) {
                  if (($prevaction!=$action['action']) && ($i==$len)) $j = 2;
                  else {
                    $j = 1;
                    if($i==$len) {
                      if(!is_null($action['start']) && $action['start']!="") $result['start'][] = '<span style="font-weight: 700;">START</span> '.$action['start'];
                      if(!is_null($action['stop']) && $action['stop']!="") $result['stop'][] = '<span style="font-weight: 700;">STOP</span> '.$action['stop'];
                      if(!is_null($action['cont']) && $action['cont']!="") $result['cont'][] = '<span style="font-weight: 700;">CONTINUE</span> '.$action['cont'];
                    }
                  }

                  for ($k=0; $k < $j; $k++) { ?>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">keyboard_arrow_down</i><?php echo $prevaction; ?></div>
                      <div class="collapsible-body">
                        <div class="row">
                          <?php if(!empty($result['start'])) { ?>
                          <div class="col s12 l4">
                            <div class="card-panel green darken-2 hoverable">
                              <span class="white-text ssctext"><?php echo implode("<hr />", $result['start']); ?></span>
                            </div>
                          </div>
                          <?php }
                          if(!empty($result['stop'])) { ?>
                          <div class="col s12 l4">
                            <div class="card-panel red darken-3 hoverable">
                              <span class="white-text ssctext"><?php echo implode("<hr />", $result['stop']); ?></span>
                            </div>
                          </div>
                          <?php }
                          if(!empty($result['cont'])) { ?>
                          <div class="col s12 l4">
                            <div class="card-panel orange lighten-1 hoverable">
                              <span class="black-text ssctext"><?php echo implode("<hr />", $result['cont']); ?></span>
                            </div>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </li>
                  <?php

                  $result = array('start' => array(), 'stop' => array(), 'cont' => array());
                  if($k==0 && $j==2) {
                    if(!is_null($action['start']) && $action['start']!="") $result['start'][] = '<span style="font-weight: 700;">START</span> '.$action['start'];
                    if(!is_null($action['stop']) && $action['stop']!="") $result['stop'][] = '<span style="font-weight: 700;">STOP</span> '.$action['stop'];
                    if(!is_null($action['cont']) && $action['cont']!="") $result['cont'][] = '<span style="font-weight: 700;">CONTINUE</span> '.$action['cont'];
                    $prevaction = $action['action'];
                  }
                }
              }

              if(!is_null($action['start']) && $action['start']!="") $result['start'][] = '<span style="font-weight: 700;">START</span> '.$action['start'];
              if(!is_null($action['stop']) && $action['stop']!="") $result['stop'][] = '<span style="font-weight: 700;">STOP</span> '.$action['stop'];
              if(!is_null($action['cont']) && $action['cont']!="") $result['cont'][] = '<span style="font-weight: 700;">CONTINUE</span> '.$action['cont'];

              $notfirst = TRUE;
              $prevaction = $action['action'];
              $i++;
              } ?>
            </ul>
          </div>
        <?php }
        ?>
      </div>
    </div>
  </div>
</div>
<?php
}
?>