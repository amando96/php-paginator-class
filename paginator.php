<?php

Class Paginator{
    private $current_page;
    private $total_pages;
    private $boundaries;
    private $around;
    private $left_boundary;
    private $right_boundary;
    private $pages = array();
    private $leftHasEllipsis = false; // Variable to store if the left side has '...'
    private $rightHasEllipsis = false; // Variable to store if the right side has '...'
    
    public function __construct($current_page, $total_pages, $boundaries = 1, $around = 1){
        $this->current_page = $current_page;
        $this->total_pages = $total_pages;
        $this->boundaries = $boundaries;
        $this->around = $around;        
        $this->left_boundary = $this->boundaries;
        $this->right_boundary = $this->total_pages - $this->boundaries;
    }  
    
    private function isWithinAround($page){
        if($page <= $this->current_page + $this->around AND $page >= $this->current_page - $this->around){ // Verificar se faz parte do around
            $this->pages[] = $page; // Add the counter's value to the page array
        }
    }
    
    private function isWithinLeftBoundaries($page){
        if($page > 0 && $page <= $this->left_boundary){ // Check if it is between the left boundaries
            $this->pages[] = $page; // Add counter's value to page array
        } elseif(!$this->leftHasEllipsis) { // if there's no '...'  on the left side
            $this->pages[] =  '...'; // Add '...'
            $this->leftHasEllipsis = true; // change variable to true because there is now an ellipsis on the left side
        } 
    }
    
    private function isWithinRightBoundaries($page){
        if($page > $this->right_boundary && $page <= $this->total_pages){ // Check if is between the right boundaries
            $this->pages[] = $page; // Add counter's value to page array
        } elseif(!$this->rightHasEllipsis) { // if there's no '...' on the right side
            $this->pages[] = '...'; // Add '...'
            $this->rightHasEllipsis = true; // change variable to true because there is now an ellipsis on the right side
        }
    }
    
    private function processPages(){
        for($i = 1; $i <= $this->total_pages; ++$i){ // Begin Loop
            if($i < $this->current_page - $this->around){ // if the counter is smaller than the current page minus around
                $this->isWithinLeftBoundaries($i);
            } elseif($i > $this->current_page + $this->around){ // if the counter is bigger than the current page plus around
                $this->isWithinRightBoundaries($i);
            } else { // if the counter is the same as the current page
                $this->isWithinAround($i);
            }
        }
    }
    
    public function paginate(){
        $this->processPages();
        foreach($this->pages as $page){
            echo ' '.$page;
        }
    }
    
}

