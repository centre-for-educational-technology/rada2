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

    'accepted'             => ':attribute måste godkännas.',
    'active_url'           => ':attribute är inte en giltig URL.',
    'after'                => ':attribute måste vara ett datum senare än :date.',
    'alpha'                => ':attribute får endast innehålla bokstäver.',
    'alpha_dash'           => ':attribute får endast innehålla bokstäver, siffror och understreck.',
    'alpha_num'            => ':attribute får endast innehålla bokstäver och siffror.',
    'array'                => ':attribute måste vara en lista.',
    'before'               => ':attribute måste vara ett datum tidigare än :date.',
    'between'              => [
        'numeric' => ':attribute måste ligga i intervallet :min – :max.',
        'file'    => ':attribute måste vara :min – :max kilobytes stort.',
        'string'  => ':attribute måste vara :min – :max tecken lång.',
        'array'   => ':attribute måste vara :min – :max enheter.',
    ],
    'boolean'              => ':attribute måste vara true eller false.',
    'confirmed'            => 'Bekräftelsen av :attribute stämmer inte.',
    'date'                 => ':attribute är inte ett giltigt datum.',
    'date_format'          => ':attribute stämmer inte med formatet :format.',
    'different'            => ':attribute och :other måste vara olika.',
    'digits'               => ':attribute måste vara :digits siffror lång.',
    'digits_between'       => ':attribute måste vara :min – :max långt.',
    'dimensions'           => ':attribute har ogiltig bildstorlek.',
    'distinct'             => 'Fältet :attribute har ett dublettvärde.',
    'email'                => ':attribute måste vara en giltig epostadress.',
    'exists'               => ':attribute är ogiltig.',
    'file'                 => ':attribute måste vara en fil.',
    'filled'               => 'Fältet :attribute är obligatoriskt.',
    'image'                => ':attribute måste vara en bild.',
    'in'                   => ':attribute är ogiltig.',
    'in_array'             => 'Fältet :attribute finns inte i :other.',
    'integer'              => ':attribute måste vara ett heltal.',
    'ip'                   => ':attribute måste vara en giltig IP-adress.',
    'json'                 => ':attribute måste vara en giltig JSON-sträng.',
    'max'                  => [
        'numeric' => ':attribute får inte vara större än :max.',
        'file'    => ':attribute får inte vara större än :max kilobyte.',
        'string'  => ':attribute får inte vara längre än :max tecken.',
        'array'   => ':attribute får inte innehålla fler än  :max element.',
    ],
    'mimes'                => ':attribute måste vara en fil av typen :values.',
    'mimetypes'            => ':attribute måste vara en fil av typen :values.',
    'min'                  => [
        'numeric' => ':attribute måste vara minst :min.',
        'file'    => ':attribute måste vara minst :min kilobyte.',
        'string'  => ':attribute måste vara minst :min tecken lång.',
        'array'   => ':attribute måste innehålla minst :min element.',
    ],
    'not_in'               => ':attribute är ogiltig.',
    'numeric'              => ':attribute måste vara ett tal.',
    'present'              => 'Fältet :attribute får inte vara tomt.',
    'regex'                => 'Formatet för :attribute är ogiltigt.',
    'required'             => 'Fältet :attribute är obligatoriskt.',
    'required_if'          => 'Fältet :attribute måste ha ett värde när :other är :value.',
    'required_unless'      => 'Fältet :attribute är obligatoriskt om inte :other har något av värdena :values.',
    'required_with'        => 'Fältet :attribute är obligatoriskt när :values är satta.',
    'required_with_all'    => 'Fältet :attribute är obligatoriskt när :values är satta.',
    'required_without'     => 'Fältet :attribute är obligatoriskt när :values saknas.',
    'required_without_all' => 'Fältet :attribute är obligatoriskt när :values saknas.',
    'same'                 => ':attribute och :other måste stämma överens.',
    'size'                 => [
        'numeric' => ':attribute måste ha storleken :size.',
        'file'    => ':attribute måste vara :size kilobyte stor.',
        'string'  => ':attribute måste vara :size tecken lång.',
        'array'   => ':attribute måste innehålla :size element.',
    ],
    'string'               => ':attribute måste vara en sträng.',
    'timezone'             => ':attribute måste vara en giltig zon.',
    'unique'               => ':attribute är redan upptagen.',
    'uploaded'             => ':attribute kunde inte laddas upp.',
    'url'                  => ':attribute har ogiltigt format.',

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
            'rule-name' => 'Särskilt meddelande',
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
