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
        if ( $e != '.' or $e != '..' or $e[ 1 ] != '.' )
            {
                echo $e  . "\n" ;
            }
    }

    echo "<!-- " . getcwd() . " -->\n";
    $d = dir( '.' );
    echo "Pointeur : " . $d->handle . "\n";
    echo "Chemin : " . $d->path . "\n";
    while (false !== ($entry = $d->read()))
    {
       writeEntry( $entry ) ;
    }
    $d->close();

?>
    </body>
</html>