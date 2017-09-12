<?php
/**
 * Created by PhpStorm.
 * User: mario
 * Date: 01/06/17
 * Time: 19:29
 */
    $content=file_get_contents("navbar.html");
    $content=str_replace("%footer%",file_get_contents("footer.html"),$content);
    echo $content;

