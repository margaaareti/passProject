<?php

namespace App\Modules\Admin;

use App\Models\CarApplication;
use App\Models\PeopleApplication;
use App\Models\PropertyApplication;
use Illuminate\Database\Eloquent\Model;

class ModelExtractor
{
    public static function getModel(string $modelType, $id): Model
    {
        $id = intval($id);
        return match ($modelType) {
             'cars' => CarApplication::findOrFail($id),
             'properties' => PropertyApplication::findOrFail($id),
             'guests' => PeopleApplication::findOrFail($id),
         };
    }
}
