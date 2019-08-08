<?php

namespace App\Options;

class QuestionTypeOptions extends OptionsBase
{
    public const INFORMATION = 1;
    public const ONE_CORRECT_ANSWER = 2;
    public const MULTIPLE_CORRECT_ANSWERS = 3;
    public const FREEFORM_ANSWER = 4;
    public const MATCH_PAIRS = 5;
    public const EMBEDDED_CONTENT = 6;
    public const PHOTO = 7;
    public const MISSING_WORD = 8;

        /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            static::INFORMATION => trans('general.question-types.information'),
            static::ONE_CORRECT_ANSWER => trans('general.question-types.one-correct-answer'),
            static::MULTIPLE_CORRECT_ANSWERS => trans('general.question-types.multiple-correct-answers'),
            static::FREEFORM_ANSWER => trans('general.question-types.freeform-answer'),
            static::MATCH_PAIRS => trans('general.question-types.match-pairs'),
            static::EMBEDDED_CONTENT => trans('general.question-types.embedded-content'),
            static::PHOTO => trans('general.question-types.photo'),
            static::MISSING_WORD => trans('general.question-types.missing-word')
        ];
    }
}
