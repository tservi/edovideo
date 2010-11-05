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

    function writeEntry( $entry )
    {
        $e = $entry . '' ;   // transtyping
        if ( $e != '.' && $e != '..' && $e[ 0 ] != '.' )
            {
                echo "<li>" . $e  . "</li>\n"           ;
            }
    }

    function parseDir ( $path )
    {
        chdir   ( $path )    ;   
        echo "<!-- " . getcwd() . " -->\n"                  ;
        $d = dir( '.' )                                     ;
        echo "<ul>\n"                                   ;
        echo "<li>"; var_dump ( $d ) ; echo "</li>"      ;
        echo "<li>"; var_dump ( $d -> read() ); echo "</li>";
        while (false !== ($entry = $d->read()))
        {
           if( is_dir( $entry) )
           {
                $e = $entry . '' ;   // transtyping
                if ( $e != '.' && $e != '..' && $e[ 0 ] != '.' )
                {
                   writeEntry( $entry )                     ;
                   $newd = dir( $entry )                    ;
                   //var_dump ( $newd )                       ;
                   parseDir( $newd )                        ;
                }
            }
        }
        echo "</ul>\n"                                  ;
        $d->close()                                     ;      
    }

    //chdir   ( $PATHTOREPOSITORY )    ;   
    //echo "<!-- " . getcwd() . " -->\n"                  ;
    //echo "Pointeur : " . $d->handle . "\n";
    //echo "Chemin : " . $d->path . "\n";
    parseDir( $PATHTOREPOSITORY )                                      ;    
?>
    </body>
</html>