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
          $("#level0").treeview();
        });
        </script>

    </head>
    <body>

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
                        $sub = substr  ( $file , strlen( $file ) - 10, strlen( $file ) -1 ) ;
                    if ( $sub != '.thumb.jpg')
                        echo "<li>$file  $sub<li>";                
                }
            }
        }
        closedir( $dh );    
    } 
    
    getDirectory ( $PATHTOREPOSITORY )                                      ;    
?>
</ul>
<!-- treestructure finishes here -->
    </body>
</html>