<?php

define('TRANSLATE_ENTITIES_TABLE', $wpdb->prefix . "translate_entities");
define('TRANSLATE_STRINGS_TABLE', $wpdb->prefix . "translate_strings");
define('TRANSLATE_FRAGMENTS_TABLE', $wpdb->prefix . "translate_fragments");

define('TEMPORARY_CONTAINER_NAME', "temporary_theme_options");

define('DEFAULT_LANGUAGE_FOR_NOT_FOUND', "en");

$chat_gpt_text_symbols_qty = intval(get_option('_chat_gpt_text_symbols_qty'));
$count = ($chat_gpt_text_symbols_qty==0) ? 500 : $chat_gpt_text_symbols_qty;
define('MAX_FRAGMENT_LENGTH', $count);

define('CHAT_GPT_API_URL', 'https://api.openai.com/v1/responses');
define('DEEPSEEK_API_URL', 'https://api.deepseek.com/v1/responses');

define('MENU_FIELDS_FOR_TRANSLATE', array(
  'post_title',
  'title',
  'description',
  'post_content',
  'post_excerpt',
));
