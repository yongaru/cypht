<?php

if (!defined('DEBUG_MODE')) { die(); }
handler_source('github');
output_source('github');

add_handler('ajax_hm_folders', 'github_folders_data',  true, 'github', 'load_user_data', 'after');
add_output('ajax_hm_folders', 'github_folders',  true, 'github', 'folder_list_content_start', 'before');

add_handler('message_list', 'github_list_type', true, 'github', 'message_list_type', 'after');

add_handler('servers', 'setup_github_connect', true, 'github', 'load_user_data', 'after');
add_handler('servers', 'github_disconnect', true, 'github', 'setup_github_connect', 'after');
add_handler('servers', 'github_process_add_repo', true, 'github', 'github_disconnect', 'after');
add_handler('servers', 'github_process_remove_repo', true, 'github', 'github_process_add_repo', 'after');
add_output('servers', 'github_connect_section', true, 'github', 'server_content_end', 'before');
add_output('servers', 'github_add_repo', true, 'github', 'github_connect_section', 'after');

add_handler('home', 'process_github_authorization', true, 'github', 'load_user_data', 'after');

add_handler('message', 'github_list_type', true, 'github', 'message_list_type', 'after');
add_handler('ajax_message_action', 'github_message_action', true, 'github', 'load_user_data', 'after');

add_handler('ajax_github_data', 'login', false, 'core');
add_handler('ajax_github_data', 'load_user_data', true, 'core');
add_handler('ajax_github_data', 'language', true, 'core');
add_handler('ajax_github_data', 'close_session_early',  true, 'core');
add_handler('ajax_github_data', 'github_list_data', true);
add_handler('ajax_github_data', 'date', true, 'core');
add_handler('ajax_github_data', 'http_headers', true, 'core');
add_output('ajax_github_data', 'filter_github_data', true);

add_handler('ajax_github_event_detail', 'login', false, 'core');
add_handler('ajax_github_event_detail', 'load_user_data', true, 'core');
add_handler('ajax_github_event_detail', 'language', true, 'core');
add_handler('ajax_github_event_detail', 'close_session_early', true, 'core');
add_handler('ajax_github_event_detail', 'github_event_detail',  true);
add_handler('ajax_github_event_detail', 'date', true, 'core');
add_handler('ajax_github_event_detail', 'http_headers', true, 'core');
add_output('ajax_github_event_detail', 'filter_github_event_detail', true);

return array(
    'allowed_pages' => array(
        'ajax_github_data',
        'ajax_github_event_detail',
    ),
    'allowed_output' => array(
        'github_msg_text' => array(FILTER_UNSAFE_RAW, false),
    ),
    'allowed_post' => array(
        'github_uid' => FILTER_VALIDATE_INT,
        'github_disconnect' => FILTER_SANITIZE_STRING,
        'new_github_repo_owner' => FILTER_SANITIZE_STRING,
        'new_github_repo' => FILTER_SANITIZE_STRING,
        'github_remove_repo' => FILTER_SANITIZE_STRING,
        'github_add_repo' => FILTER_SANITIZE_STRING,
        'github_repo' => FILTER_SANITIZE_STRING,
    )
);

?>