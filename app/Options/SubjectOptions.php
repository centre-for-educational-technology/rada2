<?php
/**
 * Created by PhpStorm.
 * Date: 3.07.19
 * Time: 13:44
 */

namespace App\Options;


class SubjectOptions extends OptionsBase
{
    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            trans('general.activity.subject.arts') => trans('general.activity.subject.arts'),
            trans('general.activity.subject.biology') => trans('general.activity.subject.biology'),
            trans('general.activity.subject.chemistry') => trans('general.activity.subject.chemistry'),
            trans('general.activity.subject.crafts') => trans('general.activity.subject.crafts'),
            trans('general.activity.subject.english') => trans('general.activity.subject.english'),
            trans('general.activity.subject.ethics') => trans('general.activity.subject.ethics'),
            trans('general.activity.subject.estonian') => trans('general.activity.subject.estonian'),
            trans('general.activity.subject.french') => trans('general.activity.subject.french'),
            trans('general.activity.subject.geography') => trans('general.activity.subject.geography'),
            trans('general.activity.subject.german') => trans('general.activity.subject.german'),
            trans('general.activity.subject.helth_education') => trans('general.activity.subject.helth_education'),
            trans('general.activity.subject.higher_education_studies') => trans('general.activity.subject.higher_education_studies'),
            trans('general.activity.subject.history') => trans('general.activity.subject.history'),
            trans('general.activity.subject.maths') => trans('general.activity.subject.maths'),
            trans('general.activity.subject.natural_sciences') => trans('general.activity.subject.natural_sciences'),
            trans('general.activity.subject.other') => trans('general.activity.subject.other'),
            trans('general.activity.subject.philosophy') => trans('general.activity.subject.philosophy'),
            trans('general.activity.subject.physics') => trans('general.activity.subject.physics'),
            trans('general.activity.subject.psychology') => trans('general.activity.subject.psychology'),
            trans('general.activity.subject.spanish') => trans('general.activity.subject.spanish')
        ];
    }
}