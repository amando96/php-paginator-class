<?php
    include('paginator.php');
    
    $paginator = new paginator2(4, 10, 2, 2);
    $paginator->paginate();
    echo '<br/>';
    

