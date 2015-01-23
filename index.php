<?php
    include('paginator.php');
    
    $paginator = new paginator(4, 10, 2, 2);
    $paginator->paginate(); // Paginators gonna paginate
    

