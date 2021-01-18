<?php


namespace App\Services;

use App;
use App\Models\Service;
use App\Models\Page;
use App\Models\Product;
use App\Models\ViewText;
use App\Models\Category;
use App\Models\ServiceInstance;

class TranslateService
{

    public function translateAbout($locale, $ambassadors, $partners)
    {
        foreach ($ambassadors as $key => $ambassador) {
            $ambassadors[$key]['description'] = $ambassador->getTranslatedAttribute('description', $locale, App::getLocale());
        }

        foreach ($partners as $key => $partner) {
            $partners[$key]['description'] = $partner->getTranslatedAttribute('description', $locale, App::getLocale());
        }

        return [$ambassadors,$partners];
    }

    public function translate($locale, $collection, $class)
    {
        foreach ($collection as $key => $value) {
            foreach ( $class::translatedFields() as $field ) {
                $collection[ $key ]->$field = $collection[ $key ]->getTranslatedAttribute( $field, $locale, App::getLocale() );
                unset( $collection[ $key ]->translations );
            }
            if ($class === Service::class){
                foreach ( $collection[$key]->examples as $k => $example ) {
                    foreach ( ServiceInstance::translatedFields() as $field ) {
                        $collection[$key]->examples[ $k ]->field = $collection[ $key ]->examples[ $k ]->getTranslatedAttribute( $field, $locale, App::getLocale() );
                    }
                }
            }

            if ($class === Product::class){
                foreach ( $collection[$key]->categories as $k => $category ) {
                    foreach (Category::translatedFields() as $field ) {
                        $collection[$key]->categories->field = $collection[ $key ]->categories->getTranslatedAttribute( $field, $locale, App::getLocale() );
                    }
                }
            }

            if ($class === Page::class ){
                foreach ( $collection[$key]->viewTexts as $k => $category ) {
                    foreach (ViewText::translatedFields() as $field ) {
                        $collection[$key]->viewTexts[$k]->field = $collection[ $key ]->viewTexts[$k]->getTranslatedAttribute( $field, $locale, App::getLocale() );
                    }
                }
            }

        }
        return $collection;
    }
}
