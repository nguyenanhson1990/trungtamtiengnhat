<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'title' => 'Núi Trúc',
    'home_title' => 'Trung tâm tiếng nhật núi trúc - Admin',
    'shows' => 'Hiển thị',
    'entries' => 'Bản ghi',
    'search' => 'Tìm kiếm',
    'update' =>'Cập nhật',
    'back' => 'Quay lại',
    'reset' => 'Reset',
    'close' => 'Đóng lại',
    'delete' =>'Xóa',
    'ok' => 'OK',
    'delete_confirm' => 'Bạn có muốn xóa:',
    'action' => 'Action',
    'file_upload' => 'Chọn file upload',
    'history' => 'Lịch sử',
    'delete_all' => 'Xóa tất cả',
    'nav' => [
            'dashboard' => 'Trang chủ',
            'user_management' => 'Quản lý User',
            'user_management_list' => 'Danh sách',
            'content_management' => 'Quản lý nội dung',
            'content_management_categories' => 'Categories',
            'content_management_post' => 'Bài viết ( post )',
            'content_management_page' => 'Bài viết ( page )',
        ],
    'users' => [
            'user_list' => 'Danh sách User',
            'user_add' => 'Thêm mới User',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'password' => 'Password',
            'modal_delete_title' => 'Xóa User'
    ],
    'category' => [
        'category_list' => 'Danh sách category',
        'category_add' => 'Thêm mới Category',
        'category_delete' => 'Xóa Category',
        'parent' => 'Parent',
        'category_name' => 'Tên',
        'category_desc' => 'Miêu tả',
        'root' => '--ROOT--',
        'modal_delete_title' => 'Xóa Category',
        'messages' => [
            'name_required' => 'Hãy nhập vào tên category',
            'success_add' => 'Thêm mới category thành công',
            'success_edit' => 'Cập nhật category thành công',
            'success_delete' => 'Bạn đã xóa category thành công',
            'name_unique' => 'Category này đã tồn tại trong hệ thống',
        ]
    ],
    'contents' => [
        'contents_list' => 'Danh sách bài viết',
        'contents_add' => 'Thêm mới bài viết',
        'contents_delete' => 'Xóa bài viết',
        'contents_category' => 'Chọn category',
        'contents_uncategory' => 'Uncategory',
        'contents_title' => 'Tiêu đề bài viết',
        'contents_slug' => 'Tiêu đề frendly',
        'contents_shore_desc' => 'Miêu tả ngắn',
        'contents_desc' => 'Nội dung bài viết',
        'contents_thumbnail' => 'Ảnh đại diện',
        'contents_page_list' => 'Danh sách page',
        'contents_og_enddate' => 'Ngày kết thúc',
        'contents_og_desc' => 'SEO Description',
        'contents_og_keyword' => 'SEO Keyword',
        'publish' => 'Xuất bản',
        'edit' => 'Cập nhật',
        'status' => 'Trạng thái',
        'messages' => [
            'title_required' => 'Hãy nhập vào tiêu đề bài viết',
            'success_add' => 'Thêm mới bài viết thành công',
            'error_add' => 'Đã gặp lỗi xảy ra trong quá trình xử lý',
            'success_edit' => 'Cập nhật bài viết thành công',
            'success_delete' => 'Bạn đã xóa bài viết thành công',
            'slug_unique' => 'Slug phải là duy nhất',
            'thumbnail_notify' => '*Lưu ý : định dạng ảnh phải là png, jpg, jpeg',
            'error_upload' =>'Sai định dạng ảnh',
            'fail_upload' =>'Upload ảnh không thành công',
            'success_change_status' =>'Cập nhật trạng thái thành công',
            'success_restore' =>'Bài viết được phục hồi thành công',
            'delete_permanly' =>'Bạn có chắc chắn muốn xóa bài viết mãi mãi ko ?',
        ],
        'tooltip' => [
            'og_keyword' => 'Nhập từ khóa của bài viết cho việc SEO',
            'og_desc' => 'Nhập miêu tả của bài viết cho việc SEO',
            'end_date' => 'Ngày kết thúc hiển thị của bài viết',
            'status' => 'Trạng thái của bài viết có hiển hay ko'
        ]
    ]

];
