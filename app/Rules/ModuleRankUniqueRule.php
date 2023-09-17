<?php

namespace App\Rules;

use App\Models\Module;
use Illuminate\Contracts\Validation\Rule;

class ModuleRankUniqueRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Get the current module
        $module_id = request()->route('module'); // Assuming you have a route parameter named 'module'

        // Check if the module has a parent
        if (request('parent_module_id')) {
            return !Module::where('parent_module_id', request('parent_module_id'))
                ->where('rank', $value)
                ->where('id', '!=', $module_id)
                ->exists();
        } else {
            // Module doesn't have a parent, so check for uniqueness among modules without parent
            return !Module::whereNull('parent_module_id')
                ->where('rank', $value)
                ->exists();
        }
    }

    public function message()
    {
        return 'The :attribute is already in use, choose another!';
    }
}
