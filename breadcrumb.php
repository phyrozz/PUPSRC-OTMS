<?php
function generateBreadcrumb($items, $isTextBlack) {
    $breadcrumbHTML = '<nav class="breadcrumb-nav breadcrumb-container" aria-label="breadcrumb">';
    $breadcrumbHTML .= '<ol class="breadcrumb">';

    if ($isTextBlack) {
        $color = "text-dark";
    }
    else {
        $color = "text-light";
    }

    $breadcrumbHTML .= '<li class="breadcrumb-item">';
    $breadcrumbHTML .= '<a class="breadcrumb-link ' . $color . '" href="/">Home</a>';
    $breadcrumbHTML .= '<i class="breadcrumb-separator fas fa-chevron-right ' . $color . '"></i>';
    $breadcrumbHTML .= '</li>';
    
    foreach ($items as $index => $item) {
        $breadcrumbHTML .= '<li class="breadcrumb-item ' . $color;
        
        if ($item['active']) {
            $breadcrumbHTML .= ' active" aria-current="page">';
            $breadcrumbHTML .= $item['text'];
        } else {
            $breadcrumbHTML .= '"><a class="breadcrumb-link ' . $color . '" href="' . $item['url'] . '">' . $item['text'] . '</a>';
        }
        
        // Add FontAwesome chevron after each breadcrumb item, except the last one
        if ($index < count($items) - 1) {
            $breadcrumbHTML .= ' <i class="breadcrumb-separator fas fa-chevron-right ' . $color . '"></i>';
        }
        
        $breadcrumbHTML .= '</li>';
    }
    
    $breadcrumbHTML .= '</ol>';
    $breadcrumbHTML .= '</nav>';
    
    return $breadcrumbHTML;
}
?>

