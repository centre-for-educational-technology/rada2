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

    'accepted'             => ' :attribute должна быть принята.',
    'active_url'           => ' :attribute не допустима для URL.',
    'after'                => 'Дата  :attribute должна быть после :date.',
    'alpha'                => ' :attribute может содержать только буквы.',
    'alpha_dash'           => ' :attribute может содержать только буквы, цифры и дефисы.',
    'alpha_num'            => ' :attribute может содержать только буквы и цифры.',
    'array'                => ' :attribute должна быть массивом.',
    'before'               => ' Дата :attribute должна быть до :date.',
    'between'              => [
        'numeric' => ' :attribute должна быть в промежутке :min и :max.',
        'file'    => ' :attribute должна быть в промежутке :min и :max КБ.',
        'string'  => ' :attribute должна быть в промежутке :min и :max символов.',
        'array'   => ' :attribute должна быть в промежутке :min и :max пунктов.',
    ],
    'boolean'              => 'Поле :attribute должно быть Верно или Неверно.',
    'confirmed'            => 'Подтверждение :attribute не совпадает.',
    'date'                 => ' :attribute дата не допустима.',
    'date_format'          => ' :attribute не содержит формат :format.',
    'different'            => ' :attribute и :other должны отличаться.',
    'digits'               => ' :attribute должна состоять из :digits цифр.',
    'digits_between'       => ' :attribute должна состоять из цифр в промежутке :min и :max.',
    'dimensions'           => ' :attribute имеет недопустимые размеры изображения.',
    'distinct'             => 'Поле :attribute имеет двойное значение.',
    'email'                => ' Адрес эл.почты :attribute должен быть действительным.',
    'exists'               => 'Выбранный :attribute недействителен.',
    'file'                 => ' :attribute должен быть файлом.',
    'filled'               => 'Поле :attribute обязательно.',
    'image'                => ':attribute должен быть изображением.',
    'in'                   => 'Выбранный :attribute недействителен.',
    'in_array'             => 'Поле :attribute не существует в :other.',
    'integer'              => ' :attribute должен быть целым числом.',
    'ip'                   => ' :attribute должен быть с действительным IP-адресом.',
    'json'                 => ' :attribute должен быть с действительной строкой JSON.',
    'max'                  => [
        'numeric' => ':attribute не должен быть больше, чем :max.',
        'file'    => ':attribute не должен быть больше, чем :max КБ.',
        'string'  => ':attribute не должен быть больше, чем :max символов.',
        'array'   => ':attribute не должен содержать больше, чем :max пунктов.',
    ],
    'mimes'                => ':attribute должен быть файлом :values.',
    'mimetypes'            => ':attribute должен быть файлом :values.',
    'min'                  => [
        'numeric' => ':attribute должен быть минимум :min.',
        'file'    => ':attribute должен быть минимум :min КБ.',
        'string'  => ':attribute должен быть минимум :min символов.',
        'array'   => ':attribute должен быть минимум :min пунктов.',
    ],
    'not_in'               => 'Выбранный :attribute является недействительным.',
    'numeric'              => ':attribute должен быть цифрой.',
    'present'              => 'Поле :attribute должно присутствовать.',
    'regex'                => 'Формат :attribute недействителен.',
    'required'             => 'Поле :attribute обязательно.',
    'required_if'          => 'Поле :attribute требуется, если :other является :value.',
    'required_unless'      => 'Поле :attribute требуется, если только :other в :values.',
    'required_with'        => 'Поле :attribute требуется, когда присутствуют значения :values.',
    'required_with_all'    => 'Поле :attribute требуется, когда присутствуют значения :values.',
    'required_without'     => 'Поле :attribute требуется, когда не присутствуют значения :values.',
    'required_without_all' => 'Поле :attribute требуется, когда ни нет ни одного из :values значений.',
    'same'                 => ' :attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => ':attribute должна быть :size.',
        'file'    => ':attribute должна быть :size в КБ.',
        'string'  => ':attribute должна быть :size символов.',
        'array'   => ':attribute должна содержать :size пунктов.',
    ],
    'string'               => ':attribute должна быть строкой.',
    'timezone'             => ':attribute должна быть действительной зоной.',
    'unique'               => ':attribute уже принят.',
    'uploaded'             => ':attribute не удалось загрузить.',
    'url'                  => 'Формат :attribute недействителен.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

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

    'attributes' => [],

];
