<?php

function get_rating_stars($rating, $size = 20) {

    $rating = floatval($rating);
    if ($rating<0) $rating = 0;
    elseif ($rating>5) $rating = 5;
    
    // Пути к вашим SVG файлам
    $empty_star = "<svg class='svg svg--stroke lucide lucide-star text-gray-300' width='".$size."' height='".$size."'>
						<use xlink:href=" . THEME_URI . '/assets/img/icons/icons.svg#star' . "></use>
					</svg>"; // SVG для пустой звезды
    $half_star = "<div class='relative' style='width: ".$size."px; height: ".$size."px'>
						<svg class='svg svg--stroke lucide lucide-star text-gray-300 absolute' width='".$size."' height='".$size."'>
							<use xlink:href=" . THEME_URI . '/assets/img/icons/icons.svg#star' . "></use>
						</svg>
						<div class='overflow-hidden absolute' style='width: 10px'>
							<svg class='svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400' width='".$size."' height='".$size."'>
								<use xlink:href=" . THEME_URI . '/assets/img/icons/icons.svg#star' . "></use>
							</svg>
						</div>
					</div>";  // SVG для половины звезды  
    $full_star = "<svg class='svg svg--both lucide lucide-star fill-yellow-400 text-yellow-400' width='".$size."' height='".$size."'>
						<use xlink:href=" . THEME_URI . '/assets/img/icons/icons.svg#star' . "></use>
					</svg>";  // SVG для полной звезды
    
    $output = '';
    
    // Генерируем 5 звезд
    for ($i = 1; $i <= 5; $i++) {
        if ($rating >= $i) {
            // Полная звезда
            $output .= $full_star;
        } elseif ($rating > $i - 1) {
            // Половина звезды
            $output .= $half_star;
        } else {
            // Пустая звезда
            $output .= $empty_star;
        }
    }
    
    return $output;
}