<?php

/******************************************************************************
  @title : edovideo
  @author : Jean Tinguely Awais aka t-servi.com
  @category : php script
  @version : 0.1
******************************************************************************/

$PATHTOREPOSITORY = 'repository' ;

?>
<html>
    <head>
        <title>Edovideo</title>
        
        <!-- thank you jQuery http://docs.jquery.com/Plugins/Treeview -->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link rel="stylesheet" href="http://jquery.bassistance.de/treeview/demo/screen.css" type="text/css" />
        <link rel="stylesheet" href="http://jquery.bassistance.de/treeview/jquery.treeview.css" type="text/css" />
        <script type="text/javascript" src="http://jquery.bassistance.de/treeview/jquery.treeview.js"></script>
        <script>
        $(document).ready(function(){
          $("#level0").treeview( { collapsed: true } );
        });
        </script>

        <!-- integration de http://videojs.com/ -->
        <script type="text/javascript" src="video-js-1.1.3/video.js"></script>

    </head>
    <body>

<div style="float: left; width:200px; display: inline;">
<!-- treestructure begins here... -->
<ul id="level0">
<?php


    // thank you http://www.codingforums.com/showthread.php?t=71882
    function getDirectory( $path = '.', $level = 0 ){
    
        $ignore = array( '.svn', '.', '..' );    
        $dh = @opendir( $path );
        
        while( false !== ( $file = readdir( $dh ) ) )
        {
            if( !in_array( $file, $ignore ) )
            {                       
                if( is_dir( "$path/$file" ) )
                {
                    echo "<li><b>$file</b></li>\n<ul>\n";
                    getDirectory( "$path/$file", ($level+1) );
                    echo "</ul>\n" ;
                }
                else
                {
                    $sub = '';
                    if ( strlen( $file ) > 11 )
                        { $sub = substr  ( $file , strlen( $file ) - 10, strlen( $file ) -1 ) ; }
                    if ( $sub == '.thumb.jpg')
                        { echo "<li><a href='?showvideo=$path/$file'><img border=0 src='$path/$file' /></a><li>\n"; }
                }
            }
        }
        closedir( $dh );    
    } 
    
    getDirectory ( $PATHTOREPOSITORY )                                      ;    
?>
</ul>
<!-- treestructure finishes here -->
</div>

<div style="float: left; display:inline;">
<?php
    if( isset( $_REQUEST[ 'showvideo' ] ) )
    {
        var_dump ( $_SERVER ) ;
        $film  = 'http://' . $_SERVER[ 'SERVER_NAME' ] . $_SERVER[ 'PHP_SELF' ] . '/' . substr  ( $_REQUEST[ 'showvideo' ] , 0 , strlen( $file ) - 11 ) ;
        $thumb = 'http://' . $_SERVER[ 'SERVER_NAME' ] . $_SERVER[ 'PHP_SELF' ] . '/' . $_REQUEST[ 'showvideo' ] ;
        ?>

 <!-- Begin VideoJS -->
  <div class="video-js-box">
    <!-- Using the Video for Everybody Embed Code http://camendesign.com/code/video_for_everybody -->
    <video class="video-js" width="640" height="264" controls preload autoplay poster="<?php echo $thumb ; ?>">
      <source src="<?php echo $film ; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
      <!-- Flash Fallback. Use any flash video player here. Make sure to keep the vjs-flash-fallback class. -->
      <object id="flash_fallback_1" class="vjs-flash-fallback" width="640" height="264" type="application/x-shockwave-flash" 
        data="flowplayer-3.2.1.swf">
        <param name="movie" value="flowplayer-3.2.1.swf" />
        <param name="allowfullscreen" value="true" />
        <param name="flashvars" 
          value='config={"playlist":["<?php echo $thumb ; ?>", {"url": "<?php echo $film ; ?>","autoPlay":false,"autoBuffering":false}]}' />
        <!-- Image Fallback. Typically the same as the poster image. -->
        <img src="<?php echo $thumb ; ?>" width="640" height="264" alt="Image" 
          title="No video playback capabilities." />
      </object>
    </video>
    <!-- Download links provided for devices that can't play video in the browser. -->
  </div>
  <!-- End VideoJS -->
        
        <?php
    }
    else
    {
        echo "<h1>Sélectionnner une vidéo grâce au menu à gauche!</h1>" ; 
    }
?>
</div>
    </body>
</html>