<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => ':attribute chỉ được nhập giá trị ngày tháng năm.',
    'date_format'          => ':attribute định đạng không đúng :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ':attribute phải là địa chỉ email.',
    'exists'               => 'Vui lòng chọn :attribute.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => ':attribute phải chọn đúng định dạng hình ảnh.',
    'in'                   => 'Vui lòng chọn :attribute.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => ':attribute không được lớn hơn :max ký tự.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => ':attribute phải chọn đúng định dạng type: :values.',
    'mimetypes'            => ':attribute phải chọn đúng định dạng type: :values.',
    'min'                  => [
        'numeric' => ':attribute phải nhỏ hơn :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => ':attribute phải nhiều hơn :min ký tự.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'Vui lòng chọn :attribute.',
    'numeric'              => ':attribute phải là số.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => ':attribute không được để trống.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => ':attribute và :other phải giống nhau.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => ':attribute phải nhỏ hơn :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => ':attribute chỉ được nhập chuỗi.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => ':attribute đã tồn tại trước đó.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'title'                     => 'Tiêu đề',
        'fullname'                  => 'Họ tên',
        'khachhang'                 => 'Họ tên',
        'password'                  => 'Password',
        'repassword'                => 'RePassword',
        'avatar'                    => 'Avartar',
        'product'                   => 'Sản phẩm',
        'email'                     => 'Email',
        'phone'                     => 'Điện thoại',
        'group'                     => 'Phân loại',
        'datenow'                   => 'Thời gian',
        'message'                   => 'Thông điệp',
        'messages'                  => 'Thông điệp',
        'network'                   => 'Nhà mạng',
        'cardcode'                  => 'Mã thẻ cào',
        'cardseri'                  => 'Số Seri',
        'cardvalue'                 => 'Giá trị thẻ',
        'file_thumbnail'            => 'Hình ảnh thumbnail',
        'file_seo_image'            => 'Hình ảnh seo',
        'file_header_banner_pc'     => 'Hình ảnh header pc',
        'header_banner_mobile'      => 'Hình ảnh header mobile',
        'fullname_reply'            => 'Họ tên người trả lời',
        'message_reply'             => 'Nội dung trả lời',
    ],

];