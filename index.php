
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>VideoJS HLS</title>

    <!-- Bootstrap core CSS. This is just to make the demo look
    nice. It's not required for videojs-contrib-hls to work. -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Some custom styles for the demo page -->
    <style>
      body {
        padding-top: 50px;
        color: #868688;
        background-color: #FAFCFF;
      }
      nav {
        background-color: #e7e7e7
      }
      nav a {
        color: #868688;
      }
      nav a:hover {
        color: #606062;
        text-decoration: none;
      }
      .navbar-toggle .icon-bar {
        background-color: #868688;
      }
      .starter-template {
        padding: 40px 15px;
        text-align: center;
      }
      .video-js {
        margin: 0 auto;
      }
      input {
        margin-top: 15px;
        min-width: 450px;
        padding: 5px;
      }
    </style>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
  </head>

  <body>

    
        
      <section class="starter-template">
        <h1>پخش زنده بدون فیلتر من وتو</h1>
     
        <!--
          -- Your video element. Just like regular HTML5 video.
          -->
        <video id=example-video width=960 height=400 class="video-js vjs-default-skin" controls>
          <source
             src="https://d2rwmwucnr0d10.cloudfront.net/live.m3u8"
             type="application/x-mpegURL">
        </video>
        </form>

    </div><!-- /.container -->


    <!-- Bootstrap stuff. These three scripts aren't necessary for you
         to use videojs-contrib-hls -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>


    <!--------------------------------------------------------------------------
      --                      videojs-contrib-hls setup                       --
      ------------------------------------------------------------------------!>

    <!--
      -- Make sure to include the video.js CSS. This could go in
      -- the <head>, too.
      -->
    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">

    <!--
      -- Include video.js and videojs-contrib-hls in your page
      -->

    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/videojs-flash/dist/videojs-flash.js"></script>
    <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>

    <!--
      -- Now, initialize your player. That's it!
      -->
    <script>
      (function(window, videojs) {
        var player = window.player = videojs('example-video');

        // hook up the video switcher
        var loadUrl = document.getElementById('load-url');
        var url = document.getElementById('url');
        loadUrl.addEventListener('submit', function(event) {
          event.preventDefault();
          player.src({
            src: url.value,
            type: 'application/x-mpegURL'
          });
          return false;
        });
      }(window, window.videojs));
    </script>
  </body>
</html>
