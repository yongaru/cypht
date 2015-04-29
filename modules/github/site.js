var load_github_data = function(id) {
    if (hm_list_path() == 'github_all') {
        Hm_Ajax.request([{'name': 'hm_ajax_hook', 'value': 'ajax_github_data'}, {'name': 'github_repo', 'value': id}], display_github_data, [], false, cache_github_all);
    }
    else {
        Hm_Ajax.request([{'name': 'hm_ajax_hook', 'value': 'ajax_github_data'}, {'name': 'github_repo', 'value': id}], display_github_data);
    }
};

var display_github_data = function(res) {
    Hm_Message_List.update([0], res.formatted_message_list, 'github_all');
};

var cache_github_all = function() {
    if (hm_list_path() == 'github_all') {
        Hm_Message_List.set_message_list_state('formatted_github_all')
    }
};

var github_item_view = function() {
    $('.msg_text_inner').html('');
    Hm_Ajax.request(
        [{'name': 'hm_ajax_hook', 'value': 'ajax_github_event_detail'},
        {'name': 'list_path', 'value': hm_list_path()},
        {'name': 'github_uid', 'value': hm_msg_uid()}],
        display_github_item_content
    );
    return false;
};

var display_github_item_content = function(res) {
    $('.msg_text').html(res.github_msg_text);
};

if (hm_page_name() == 'servers') {
    var dsp = Hm_Utils.get_from_local_storage('.github_connect_section');
    if (dsp == 'block' || dsp == 'none') {
        $('.github_connect_section').css('display', dsp);
    }
}
else if (hm_page_name() == 'message' && hm_list_path().substr(0, 6) == 'github') {
    github_item_view();
}

if (hm_page_name() == 'message_list') {
    if (hm_list_path() == 'github_all') {
        Hm_Message_List.page_caches.github_all = 'formatted_github_all';
    }
}
