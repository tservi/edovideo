<?php

/******************************************************************************
  @title : edovideo
  @author : Jean Tinguely Awais aka t-servi.com
  @category : php script
  @version : 0.1
******************************************************************************/

$PATHTOREPOSITORY = 'repository' ;

chdir   ( $PATHTOREPOSITORY )    ;

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

    function parseDir ( $d )
    {
        echo "<ul>\n"                                   ;
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
    
    echo "<!-- " . getcwd() . " -->\n"                  ;
    $d = dir( '.' )                                     ;
    //echo "Pointeur : " . $d->handle . "\n";
    //echo "Chemin : " . $d->path . "\n";
    parseDir( $d )                                      ;    
?>
    </body>
</html>