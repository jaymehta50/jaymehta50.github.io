<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="spa-section container" id="cutover">
  <div class="row">
    <div class="col s10 offset-s1">
      <div class="section center">
        <h1 class="header">Cutover</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Main content -->
    <div class="col s12">
      <div class="section">

        <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
          <li class="tab"><a href="#cutover-what">About</a></li>
          <li class="tab"><a href="#cutover-plan">Systems</a></li>
          <!-- <li class="tab"><a href="#cutover-live">Wards</a></li> -->
        </ul>
        <div id="cutover-what" class="col s12">
          <h4>What is Cutover?</h4>
          <p>This is the process of completing technical, clinical, and operational activities required to transition from the current systems & processes to the new systems & processes, leading to the official change on Go Live date.</p>
          <h4>Why do we do it?</h4>
          <p>To provide a systematic and safe sequence of activities, ensuring a smooth transition from the current to the new systems & processes with minimal disruption.</p>
          <hr />
          <h4>What is Go Live?</h4>
          <p>Go Live is the process of taking down the old systems, and bringing up the new ones.</p>
          <h4>When is Go Live?</h4>
          <p>Saturday 17th November</p>
          <p>See the plan in the next tab for more information.</p>
        </div>
        <div id="cutover-plan" class="col s12">
          <h4>Go Live Plan</h4>
          <h5>Which systems will go down and when?</h5>
          <p>Saturday 17th November 2018:</p>
          <table class="responsive-table golivetable">
            <thead>
              <tr>
                <th></th>
                <?php
                foreach ($cutover['fields'] as $key => $field) {
                  if($field=="id" || $field=="timestamp") continue;
                  echo "<th>".implode('<span class="hide-on-small-only"> </span><br class="show-on-small hide-on-med-and-up">', explode(' ', $field))."</th>";
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($cutover['data'] as $key => $value) {
                echo "<tr><td>".date("H:i", strtotime($value['timestamp']))."</td>";
                foreach ($cutover['fields'] as $key => $field) {
                  if($field=="id" || $field=="timestamp") continue;
                  echo "<td>";
                  switch ($value[$field]) {
                    case "Y":
                      echo '<i class="material-icons green-text">check_circle_outline</i>';
                      break;
                    case "M":
                      echo '<i class="material-icons orange-text tooltipped" data-position="bottom" data-tooltip="Only available to endorse old results">info</i>';
                      break;
                    case "N":
                      echo '<i class="material-icons red-text">highlight_off</i>';
                      break;
                  }
                  echo "</td>";
                }
                echo "</tr>";
              }
              ?>
              
            </tbody>
          </table>

        </div>
        <div id="cutover-live" class="col s12">
          <div class="section">
            <h4>Ward Transcription</h4>
            <p>On go-live day, all of the drug charts on every ward will be transcribed into electronic prescriptions by a team of doctors and pharmacists.</p>
            <p>This is the timetable for the transcription - please note that this will change, check back here regularly to get an update:</p>
          </div>
          <div class="section">
            <table class="centered">
              <thead>
                <tr>
                  <th></th>
                  <th>Start Time</th>
                  <th>Finish Time</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($wards as $key => $ward) {
                  echo '<tr>
                  <th>'.$ward['site'].'<span class="hide-on-small-only"> - </span><br class="show-on-small hide-on-med-and-up">'.$ward['ward'];
                  if((strtotime($ward['starttime'])+($ward['startdelay']*60)) <= strtotime("now") && (strtotime($ward['endtime'])+($ward['enddelay']*60)) <= strtotime("now")) echo '<br /><span class="green-text text-darken-4"><i class="material-icons">check_circle_outline</i> Completed</span>';
                  echo '</th>
                  <td class="';

                  if((strtotime($ward['starttime'])+($ward['startdelay']*60)) <= strtotime("now") && (strtotime($ward['endtime'])+($ward['enddelay']*60)) <= strtotime("now")) echo 'green lighten-3';
                  elseif((strtotime($ward['starttime'])+($ward['startdelay']*60)) <= strtotime("now") && (strtotime($ward['endtime'])+($ward['enddelay']*60)) > strtotime("now")) echo 'amber lighten-3';
                  elseif($ward['startdelay']>0) echo 'red lighten-4';
                  elseif($ward['startdelay']<0) echo 'lime lighten-4';

                  echo '">'.date("D H:i", strtotime($ward['starttime']));

                  if($ward['startdelay']>0 && (strtotime($ward['starttime'])+($ward['startdelay']*60)) <= strtotime("now")) echo '<br /><span class="red-text text-darken-4">We started '.$ward['startdelay'].' mins late</span>';
                  elseif($ward['startdelay']<0 && (strtotime($ward['starttime'])+($ward['startdelay']*60)) <= strtotime("now")) echo '<br /><span class="green-text text-darken-4">We started '.(-1*$ward['startdelay']).' mins early</span>';
                  elseif($ward['startdelay']>0) echo '<br /><span class="red-text text-darken-4">We\'ll be '.$ward['startdelay'].' mins late</span>';
                  elseif($ward['startdelay']<0) echo '<br /><span class="green-text text-darken-4">We\'ll be '.(-1*$ward['startdelay']).' mins early</span>';

                  echo '</td>
                  <td class="';

                  if((strtotime($ward['starttime'])+($ward['startdelay']*60)) <= strtotime("now") && (strtotime($ward['endtime'])+($ward['enddelay']*60)) <= strtotime("now")) echo 'green lighten-3';
                  elseif((strtotime($ward['starttime'])+($ward['startdelay']*60)) <= strtotime("now") && (strtotime($ward['endtime'])+($ward['enddelay']*60)) > strtotime("now")) echo 'amber lighten-3';
                  elseif($ward['enddelay']>0) echo 'red lighten-4';
                  elseif($ward['enddelay']<0) echo 'lime lighten-4';

                  echo '">'.date("D H:i", strtotime($ward['endtime']));

                  if($ward['enddelay']>0 && (strtotime($ward['endtime'])+($ward['enddelay']*60)) <= strtotime("now")) echo '<br /><span class="red-text text-darken-4">We finished '.$ward['enddelay'].' mins late</span>';
                  elseif($ward['enddelay']<0 && (strtotime($ward['endtime'])+($ward['enddelay']*60)) <= strtotime("now")) echo '<br /><span class="green-text text-darken-4">We finished '.(-1*$ward['enddelay']).' mins early</span>';
                  elseif($ward['enddelay']>0) echo '<br /><span class="red-text text-darken-4">We\'ll finish '.$ward['enddelay'].' mins late</span>';
                  elseif($ward['enddelay']<0) echo '<br /><span class="green-text text-darken-4">We\'ll finish '.(-1*$ward['enddelay']).' mins early</span>';

                  echo '</td>
                  </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>