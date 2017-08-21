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

    'accepted'             => ':attribute pitää olla hyväksytty.',
    'active_url'           => ':attribute ei ole kelpaava URL.',
    'after'                => ':attribute pitää olla päivämäärä :date jälkeen.',
    'alpha'                => ':attribute saa sisältää ainoastaan kirjaimia.',
    'alpha_dash'           => ':attribute saa sisältää ainoastaan krijaimia, numeroita ja alleviivoja.',
    'alpha_num'            => ':attribute saa sisältää ainoastaan kirjaimia ja numeroita.',
    'array'                => ':attribute pitää olla taulukko.',
    'before'               => ':attribute pitää olla päivämäärä :date ennen.',
    'between'              => [
        'numeric' => ':attribute pitää olla :min–:max.',
        'file'    => ':attribute pitää olla :min–:max kilotavua.',
        'string'  => ':attribute pitää olla :min–:max merkkiä.',
        'array'   => ':attribute pitää sisältää :min–:max osiota.',
    ],
    'boolean'              => ':attribute-kenttä pitää olla true tai false.',
    'confirmed'            => ':attribute n vahvistus ei sovi yhteen.',
    'date'                 => ':attribute ei ole kelpaava päivämäärä.',
    'date_format'          => ':attribute ei vastaa muotoa :format.',
    'different'            => ':attribute ja :other pitää olla erilaiset.',
    'digits'               => ':attribute pitää olla :digits numeroa pitkä.',
    'digits_between'       => ':attribute pitää olla :min–:max numeroa pitkä.',
    'dimensions'           => ':attribute lla on epäkelvot kuvamitat.',
    'distinct'             => ':attribute lla on duplettiarvo.',
    'email'                => ':attribute pitää olla kelpaava sähköpostiosoite.',
    'exists'               => ':attribute on epäkelpo.',
    'file'                 => ':attribute pitää olla tietue.',
    'filled'               => ':attribute-kenttä on pakollinen.',
    'image'                => ':attribute pitää olla kuva.',
    'in'                   => ':attribute on epäkelpo.',
    'in_array'             => ':attribute-kenttä ei löydy :other sta.',
    'integer'              => ':attribute pitää olla kokonaisluku.',
    'ip'                   => ':attribute pitää olla kelpaava IP-osoite.',
    'json'                 => ':attribute pitää olla kelpaava JSON-merkkijono.',
    'max'                  => [
        'numeric' => ':attribute ei saa olla :max suurempi.',
        'file'    => ':attribute ei saa olla :max kilotavua suurempi.',
        'string'  => ':attribute ei saa olla :max merkkiä pitempi.',
        'array'   => ':attribute ei saa sisälttää enemmän kuin :max osiota.',
    ],
    'mimes'                => ':attribute pitää olla :values-tyyppinen tietue.',
    'mimetypes'            => ':attribute pitää olla :values-tyyppinen tietue.',
    'min'                  => [
        'numeric' => ':attribute pitää olla vähintään :min.',
        'file'    => ':attribute pitää olla vähintään :min kilotavua suurempi.',
        'string'  => ':attribute pitää olla vähintään :min merkkiä pitempi.',
        'array'   => ':attribute pitää sisältää vähintään :min osiota.',
    ],
    'not_in'               => 'Valittu :attribute on epäkelpo.',
    'numeric'              => ':attribute pitää olla luku.',
    'present'              => ':attribute lla pitää olla arvo.',
    'regex'                => ':attribute n muoto en epäkelpo.',
    'required'             => ':attribute-kenttä on pakollinen.',
    'required_if'          => ':attribute-kenttä on pakollinen jos :other on :value.',
    'required_unless'      => ':attribute-kenttä on pakollinen jos :other ei kuulu :values.',
    'required_with'        => ':attribute-kenttä on pakollinen jos :values lla on arvo.',
    'required_with_all'    => ':attribute-kenttä on pakollinen jos :values lla on arvo.',
    'required_without'     => ':attribute-kenttä on pakollinen jos :values puuttuu.',
    'required_without_all' => ':attribute-kenttä on pakollinen jos :values puuttuvat.',
    'same'                 => ':attribute ja :other pitää olla samat.',
    'size'                 => [
        'numeric' => ':attribute pitää olla :size.',
        'file'    => ':attribute pitää olla :size kilotavua iso.',
        'string'  => ':attribute pitää olla :size merkkiä pitkä.',
        'array'   => ':attribute pitää sisältää :size osiota.',
    ],
    'string'               => ':attribute pitää olla merkkijono.',
    'timezone'             => ':attribute pitää olla kelpaava aikavyöhyke.',
    'unique'               => ':attribute on jo käytetty.',
    'uploaded'             => ':attribute ei latautunut.',
    'url'                  => ':attribute-muoto on epäkelpo.',

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
            'rule-name' => 'Erikoisviesti',
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
