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

    'accepted'             => ':attribute peab olema kinnitatud.',
    'active_url'           => ':attribute ei ole link.',
    'after'                => ':attribute peab olema kuupäev peale :date.',
    'alpha'                => ':attribute tohib sisaldada ainult tähti.',
    'alpha_dash'           => ':attribute tohib sisaldaa ainult tähti, numbreid ja kaldkriipse.',
    'alpha_num'            => ':attribute tohib sisaldada ainult tähti ja numbreid.',
    'array'                => ':attribute peab olema jada.',
    'before'               => ':attribute peab olema kuupäev :date.',
    'between'              => [
        'numeric' => ':attribute peab olema :min ja :max vahel.',
        'file'    => ':attribute peab olema vahemikus :min ja :max kilobaiti.',
        'string'  => ':attribute peab olema vahemikus :min ja :max tähemärki.',
        'array'   => ':attribute peab olema vahemikus :min ja :max ühikut.',
    ],
    'boolean'              => ':attribute väli peab olema kas tõene või väär.',
    'confirmed'            => ':attribute kinnitus ei kattu.',
    'date'                 => ':attribute ei ole korrekne kuupäev.',
    'date_format'          => ':attribute ei vasta formaadile :format.',
    'different'            => ':attribute ja :other peavad olema erinevad.',
    'digits'               => ':attribute peab olema :digits numbrit.',
    'digits_between'       => ':attribute peab olema vahemikus :min ja :max numbrit.',
    'dimensions'           => ':attribute pildi suurus on vale.',
    'distinct'             => ':attribute väli dubleerib olemasolevat.',
    'email'                => ':attribute peab olema korrektne e-posti aadress.',
    'exists'               => 'Valitud :attribute on vigane.',
    'file'                 => ':attribute peab olema fail.',
    'filled'               => ':attribute väli on nõutud.',
    'image'                => ':attribute peab olema pildifail.',
    'in'                   => 'Valitud :attribute on vigane.',
    'in_array'             => ':attribute ei eksisteeri asukohas :other.',
    'integer'              => ':attribute peab olema täisarv.',
    'ip'                   => ':attribute peab olema valiidne IP-aadress.',
    'json'                 => ':attribute peab olema valiidne JSON-i string.',
    'max'                  => [
        'numeric' => ':attribute ei saa olla suurem kui :max.',
        'file'    => ':attribute ei saa olla suurem kui :max kilobaiti.',
        'string'  => ':attribute ei saa olla suurem kui :max tähemärki.',
        'array'   => ':attribute ei saa sisaldada rohkem kui :max ühikut.',
    ],
    'mimes'                => ':attribute peab olema failitüüp: :values.',
    'mimetypes'            => ':attribute peab olema failitüüp: :values.',
    'min'                  => [
        'numeric' => ':attribute peab olema vähemalt :min.',
        'file'    => ':attribute peab olema vähemalt :min kilobaiti.',
        'string'  => ':attribute peab olema vähemalt :min tähemärki.',
        'array'   => ':attribute peab omama vähemalt :min ühikut.',
    ],
    'not_in'               => 'Valitud :attribute on vigane.',
    'numeric'              => ':attribute peab olema number.',
    'present'              => ':attribute väli peab olema täidetud.',
    'regex'                => ':attribute formaat on vigane.',
    'required'             => ':attribute väli on nõutud.',
    'required_if'          => ':attribute väli on nõutud, kui väärtus :other on :value.',
    'required_unless'      => ':attribute väli on nõutud, välja arvatud juhul, kui väärtus :other on vahemikus :values.',
    'required_with'        => ':attribute väli on nõutud, kui väärtusf :values on esindatud.',
    'required_with_all'    => ':attribute väli on nõutud, kui väärtusf :values on esindatud.',
    'required_without'     => ':attribute väli on nõutud, kui ühtegi väärtustest :values ei ole esindatud.',
    'required_without_all' => ':attribute väli on nõutud, kui ühtegi väärtustest :values ei ole esindatud.',
    'same'                 => ':attribute ja :other peavad kattuma.',
    'size'                 => [
        'numeric' => ':attribute peab olema :size.',
        'file'    => ':attribute peab olema :size kilobaiti.',
        'string'  => ':attribute peab olema :size tähemärki.',
        'array'   => ':attribute peab sisaldama :size ühikut.',
    ],
    'string'               => ':attribute peab olema string.',
    'timezone'             => ':attribute peab olema korrektne ajatsoon.',
    'unique'               => ':attribute on juba kasutusel.',
    'uploaded'             => ':attribute laadimine ebaõnnestus.',
    'url'                  => ':attribute formaat ei ole sobiv.',

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
