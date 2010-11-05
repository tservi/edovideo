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
    </head>
    <body>
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
                    echo "<li>$file<li>";                
                }
            }
        }
        closedir( $dh );    
    } 

    //chdir   ( $PATHTOREPOSITORY )    ;   
    //echo "<!-- " . getcwd() . " -->\n"                  ;
    //echo "Pointeur : " . $d->handle . "\n";
    //echo "Chemin : " . $d->path . "\n";
    //parseDir( $PATHTOREPOSITORY )                                      ;    
    getDirectory ( $PATHTOREPOSITORY )                                      ;    
?>
    </body>
</html>