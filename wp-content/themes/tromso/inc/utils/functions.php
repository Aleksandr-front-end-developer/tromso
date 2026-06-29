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

if ( !function_exists( 'mb_trim' ) ) {
  function mb_trim( $str ) {
      return mb_ereg_replace(
          '^[[:space:]]*([\s\S]*?)[[:space:]]*$', '\1', $str );
  }
}


//Функции для упрощения работы с полилэнгом

function get_language_page_url( $post_slug, $lng ) {

	if ( function_exists( 'pll_get_post' ) ) {
		return pll_get_post( $post_slug, $lng );
	}

	return $post_slug;
}

function check_cf($data) {

  return (!is_null($data) && $data!='');
}

function check_cf_complex($data) {

  return (is_array($data) && count($data)>0);
}

function get_language_preffix() {

	if ( function_exists( 'pll_default_language' ) && function_exists( 'pll_current_language' ) ) {
		$current = pll_current_language();
		if ( $current == pll_default_language() ) {
			$preffix = '';
		}
		else {
			$preffix = '/' . $current;
		}

		return $preffix;
	}

	return '';
}

function get_default_language() {

	if ( function_exists( 'pll_default_language' ) ) {
		return pll_default_language();
	}

	return DEFAULT_LANGUAGE_FOR_NOT_FOUND;
}

function get_current_language( $value = 'slug' ) {

	if ( function_exists( 'pll_current_language' ) ) {
		return pll_current_language( $value );
	}

	return DEFAULT_LANGUAGE_FOR_NOT_FOUND;
}

function get_language_post( $post_id, $slug = '' ) {

	if ( function_exists( 'pll_get_post' ) ) {
		return pll_get_post( $post_id, $slug );
	}

	return $post_id;
}

function get_language_term( $term_id, $slug ) {

	if ( function_exists( 'pll_get_term' ) ) {
		return pll_get_term( $term_id, $slug );
	}

	return $term_id;
}

function get_languages_list() {

	if ( function_exists( 'pll_languages_list' ) ) {
		return pll_languages_list();
	}

	return array( DEFAULT_LANGUAGE_FOR_NOT_FOUND );
}

function get_languages_list_full() {

	if ( function_exists( 'pll_languages_list' ) ) {
		return pll_languages_list( array( 'fields' => array() ) );
	}

	return array();
}

function get_post_language( $post_id ) {

	if ( function_exists( 'pll_get_post_language' ) ) {
		return pll_get_post_language( $post_id );
	}

	return DEFAULT_LANGUAGE_FOR_NOT_FOUND;
}

function get_term_language( $term_id ) {

	if ( function_exists( 'pll_get_term_language' ) ) {
		return pll_get_term_language( $term_id );
	}

	return DEFAULT_LANGUAGE_FOR_NOT_FOUND;
}

function is_translated_post_type( $post_type ) {

	if ( function_exists( 'pll_is_translated_post_type' ) ) {
		return pll_is_translated_post_type( $post_type );
	}

	return false;
}

function is_translated_taxonomy( $tax ) {

	if ( function_exists( 'pll_is_translated_taxonomy' ) ) {
		return pll_is_translated_taxonomy( $tax );
	}

	return false;
}

function get_frontend_language_suffix() {

  $lng = '';
  if ( function_exists( 'pll_current_language' ) ) {
		$lng = pll_current_language( 'slug' );
	}
  if ($lng!='') $lng = '_'.$lng;

  return $lng;
}