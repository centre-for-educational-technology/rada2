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

    'accepted'             => ' :характеристика должна быть принята.',
    'active_url'           => ' :характеристика не допустима для URL.',
    'after'                => 'Дата  :характеристика должна быть после :дата.',
    'alpha'                => ' :характеристика может содержать только буквы.',
    'alpha_dash'           => ' :характеристика может содержать только буквы, цифры и дефисы.',
    'alpha_num'            => ' :характеристика может содержать только буквы и цифры.',
    'array'                => ' :характеристика должна быть массивом.',
    'before'               => ' Дата :характеристика должна быть до :дата.',
    'between'              => [
        'numeric' => ' :характеристика должна быть в промежутке :min и :мах.',
        'file'    => ' :характеристика должна быть в промежутке :min и :мах КБ.',
        'string'  => ' :характеристика должна быть в промежутке :min и :мах символов.',
        'array'   => ' :характеристика должна быть в промежутке :min и :мах пунктов.',
    ],
    'boolean'              => 'Поле :характеристика должно быть Верно или Неверно.',
    'confirmed'            => 'Подтверждение :характеристика не совпадает.',
    'date'                 => ' :характеристика дата не допустима.',
    'date_format'          => ' :характеристика не содержит формат :формат.',
    'different'            => ' :характеристика и :другое должны отличаться.',
    'digits'               => ' :характеристика должна состоять из :цифры.',
    'digits_between'       => ' :характеристика должна состоять из цифр в промежутке :min и :max.',
    'dimensions'           => ' :характеристика имеет недопустимые размеры изображения.',
    'distinct'             => 'Поле :характеристика имеет двойное значение.',
    'email'                => ' Адрес эл.почты :характеристика должен быть действительным.',
    'exists'               => 'Выбранный :характеристика недействителен.',
    'file'                 => ' :характеристика должен быть файлом.',
    'filled'               => 'Поле :характеристика обязательно.',
    'image'                => ':характеристика должен быть изображением.',
    'in'                   => 'Выбранный :характеристика недействителен.',
    'in_array'             => 'Поле :характеристика не существует в :другое.',
    'integer'              => ' :характеристика должен быть целым числом.',
    'ip'                   => ' :характеристика должен быть с действительным IP-адресом.',
    'json'                 => ' :характеристика должен быть с действительной строкой JSON.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
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
