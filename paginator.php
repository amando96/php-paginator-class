<?php

Class Paginator{
    private $current_page;
    private $total_pages;
    private $boundaries;
    private $around;
    private $left_boundary;
    private $right_boundary;
    private $pages = array();
    private $leftHasEllipsis = false; // Variável para saber se o lado esquerdo tem ou não '...'
    private $rightHasEllipsis = false; // Variável para saber se o lado direito tem ou não '...'
    
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
            $this->pages[] = $page; // Adicionar o valor do contador ao array de páginas
        }
    }
    
    private function isWithinLeftBoundaries($page){
        if($page > 0 && $page <= $this->left_boundary){ // Verificar se faz parte dos boundaries esquerdos
            $this->pages[] = $page; // Adicionar o valor do contador ao array de páginas
        } elseif(!$this->leftHasEllipsis) { // Se não houver nenhum '...'  do lado esquerdo 
            $this->pages[] =  '...'; // Meter um '...'
            $this->leftHasEllipsis = true; // mudar o valor para true para saber que já existe um '...' na parte esquerda
        } 
    }
    
    private function isWithinRightBoundaries($page){
        if($page > $this->right_boundary && $page <= $this->total_pages){ // Verficar se faz parte dos boundaries direitos
            $this->pages[] = $page; // Adicionar o valor do contador ao array de páginas
        } elseif(!$this->rightHasEllipsis) { // Se não houver nenhum '...' do lado direito 
            $this->pages[] = '...'; // Meter um '...'
            $this->rightHasEllipsis = true; // mudar o valor para true para saber que já existe um '...' na parte direita
        }
    }
    
    private function processPages(){
        for($i = 1; $i <= $this->total_pages; ++$i){ // Iniciar Loop
            if($i < $this->current_page - $this->around){ // Se o contador for inferior à página corrente - o around
                $this->isWithinLeftBoundaries($i);
            } elseif($i > $this->current_page + $this->around){ // Se o contador for superior à página corrente + o around
                $this->isWithinRightBoundaries($i);
            } else { // Se o contador for igual à página corrente
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

