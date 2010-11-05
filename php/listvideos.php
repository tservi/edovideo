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
        echo "<ul>\n"                                       ;
        echo "<li>"; var_dump ( $d ) ; echo "</li>"         ;
        $entry = $d->read()                                 ;
        echo "<li>"; var_dump ( $entry ) ; echo "</li>"         ;
        /*
        while (false !== $entry )
        {
           if( is_dir( $entry) )
           {
                $e = $entry . '' ;   // transtyping
                if ( $e != '.' && $e != '..' && $e[ 0 ] != '.' )
                {
                   writeEntry( $entry )                     ;
                   parseDir( './' . $entry )                        ;
                }
            }
        }
        */
        echo "</ul>\n"                                  ;
        $d->close()                                     ;      
    }


    function getDirectory( $path = '.', $level = 0 ){
    
        $ignore = array( '.svn', '.', '..' );    
        $dh = @opendir( $path );
        
        while( false !== ( $file = readdir( $dh ) ) ){
        
            if( !in_array( $file, $ignore ) ){
                                
                if( is_dir( "$path/$file" ) ){
                
                    echo "<li><s>$file</s></li>\n<ul>\n";
                    getDirectory( "$path/$file", ($level+1) );
                    echo "</ul>\n" ;
                } else {
                
                    echo "<li>$file<li>";                
                }
            
            }
        
        }
        
        closedir( $dh );
        // Close the directory handle
    
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