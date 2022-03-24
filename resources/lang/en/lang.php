<?php

use App\Models\Language;
use App\Models\StaticDataTranslation;

$staticDataTranslations = StaticDataTranslation::all();
$langID = Language::where('locale', 'en')->get()[0]->id;
$langStaticDataTranslations = array();
foreach ($staticDataTranslations as $staticDataTranslation) {
    if ($staticDataTranslation->language_id == $langID)
        $langStaticDataTranslations[$staticDataTranslation->key] = $staticDataTranslation->value;
}

return $langStaticDataTranslations;