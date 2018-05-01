  <script type="text/javascript">
    window.onload = function() {
      var $path = location.pathname;
          $paths = $path.split('/');
          $check = $paths[$paths.length-1];

      switch ($check) {
        case "ERP" :
            $('.taberp').addClass('selected');
            break;
        case "HackersStory" :
            $('.tabhs').addClass('selected');
            break;
        case "BugnoTra" :
            $('.tabbt').addClass('selected');
            break;
        case "all" :
            $('.tabs-tab').addClass('selected');
            break;
        default :
            $('.tab-feed').addClass('selected');

      }
    }
  </script>