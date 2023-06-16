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

    $breadcrumbHTML .= '<li class="breadcrumb-item"><a class="' . $color . '" href="/">Home</a></li>';
    
    foreach ($items as $item) {
        $breadcrumbHTML .= '<li class="breadcrumb-item ' . $color;
        
        if ($item['active']) {
            $breadcrumbHTML .= ' active" aria-current="page">';
            $breadcrumbHTML .= $item['text'];
        } else {
            $breadcrumbHTML .= '"><a class="' . $color . '" href="' . $item['url'] . '">' . $item['text'] . '</a>';
        }
        
        $breadcrumbHTML .= '</li>';
    }
    
    $breadcrumbHTML .= '</ol>';
    $breadcrumbHTML .= '</nav>';
    
    return $breadcrumbHTML;
}
?>
