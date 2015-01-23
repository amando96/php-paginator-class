uma solução em PHP para o seguinte problema:
A PHP solution for the following problem:
  On a site with pagination we want to include a paginator to browse the site's pages.
  You can use the following variables:
    $current_page - Page the user is currently in
    $total_pages - Total number of pages
    $boundaries - How many pages we wish to ALWAYS have clicable on the limits of the page array, boundaries within brackets, 
    e.g.: 1[23]...5...[78]9
    $around - how many pages we wich to show before and after the current page
  The pages that aren't shown should be replaced by an ellipsis(only one ellipsis per group of non-visible pages)
  Some examples:
    $current_page = 4; $total_pages = 5; $boundaries = 1; $around = 0
    Expected result: 1 ... 4 5
    $current_page = 4; $total_pages = 10; $boundaries = 2; $around = 2
    Expected result: 1 2 3 4 5 6 ... 9 10
