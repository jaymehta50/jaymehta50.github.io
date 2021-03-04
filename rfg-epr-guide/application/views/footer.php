<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- iOS Install Modal -->
  <div id="iosinstallmodal" class="modal bottom-sheet center">
    <div class="modal-content">
      <h4>Install on iOS</h4>
      <p>Tap on Share:</p>
      <img src="assets/img/ios-share.svg" style="height: 25px;" />
      <hr />
      <p>Then tap Add to Home Screen:</p>
      <img src="assets/img/ios_add_to_hs.jpeg" style="height: 85px; border-radius: 2px;" />
    </div>
  </div>

  <footer class="page-footer orange">
    <div class="footer-copyright orange">
      <div class="container">
      &copy; <a href="https://www.royalfree.nhs.uk/" target="_blank">Royal Free London NHS Foundation Trust</a> 2018
      </div>
    </div>
  </footer>
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128251318-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-128251318-1');
  </script>

  <!--  Scripts-->
  <script src="<?php echo base_url('assets/js/materialize.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/init.js'); ?>"></script>
  </body>
</html>
