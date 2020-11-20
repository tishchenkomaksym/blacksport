<?php


namespace App\Services;

use App;

class TranslateService
{
    public function translateAbout($locale, $texts, $ambassadors, $partners)
    {

        $texts->name = $texts->getTranslatedAttribute('name', $locale, App::getLocale());
        $texts->meta_description = $texts->getTranslatedAttribute('meta_description', $locale, App::getLocale());

        foreach ($ambassadors as $key => $ambassador) {
            $ambassadors[$key]['description'] = $ambassador->getTranslatedAttribute('description', $locale, App::getLocale());
        }

        foreach ($partners as $key => $partner) {
            $partners[$key]['description'] = $partner->getTranslatedAttribute('description', $locale, App::getLocale());
        }

        return [$texts, $ambassadors,$partners];
    }

    public function translate($locale, $collection, $class)
    {
        foreach ( $collection as $key => $value ) {
            foreach ( $class::translatedFields() as $field ) {
                $collection[$key]->$field = $collection[$key]->getTranslatedAttribute($field, $locale, App::getLocale());
                unset($collection[$key]->translations);
            }

        }
        return $collection;
    }
}
