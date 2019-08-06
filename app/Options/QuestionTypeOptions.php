<?php

namespace App\Options;

class QuestionTypeOptions extends OptionsBase
{
    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            1 => trans('general.question-types.information'),
            2 => trans('general.question-types.one-correct-answer'),
            3 => trans('general.question-types.multiple-correct-answers'),
            4 => trans('general.question-types.freeform-answer'),
            5 => trans('general.question-types.match-pairs'),
            6 => trans('general.question-types.embedded-content'),
            7 => trans('general.question-types.photo'),
            8 => trans('general.question-types.missing-word')
        ];
    }
}
