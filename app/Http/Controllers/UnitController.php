<?php

namespace App\Http\Controllers;

use Nwidart\Modules\Facades\Module;

class UnitController extends Controller
{

    public function index()
    {

        $units = Module::all();
        $unitsWithIcons = collect($units)->map(function ($unit) {
            $config = json_decode(file_get_contents($unit->getPath() . '/module.json'), true);
            return [
                'name' => $unit->getName(),
                'enabled' => $config['enabled'] ?? false,
                'icon' => $config['icon'] ?? 'fas fa-cube',
                'routes' => $config['routes'] ?? []
            ];
        });

        return view('unit.manager', compact('unitsWithIcons'));
    }

    public function unitDetails($unitName)
    {
        // Check if the unit exists
        if (!Module::has($unitName)) {
            return response()->json(['error' => 'Unit not found'], 404);
        }

        // Get the specific unit
        $unit = Module::find($unitName);

        // Fetch unit details
        $unitInfo = [
            'name' => $unit->getName(),
            'description' => $unit->getDescription(),
            'status' => $unit->isEnabled() ? 'Enabled' : 'Disabled',
            'path' => $unit->getPath(),
        ];

        return response()->json($unitInfo);
    }

    // Enable a unit
    public function enableUnit($unitName)
    {
        if (Module::has($unitName)) {
            Module::enable($unitName);
            return redirect()->back()->with('success', "Unit '$unitName' has been enabled.");
        }

        return redirect()->back()->with('error', "Unit '$unitName' does not exist.");
    }

    // Disable a unit
    public function disableUnit($unitName)
    {
        if (Module::has($unitName)) {
            Module::disable($unitName);
            return redirect()->back()->with('success', "Unit '$unitName' has been disabled.");
        }

        return redirect()->back()->with('error', "Unit '$unitName' does not exist.");
    }
}



// $units = Module::all();
// $unitsWithStatus = [];

// foreach ($units as $unit) {
//     $unitsWithStatus[] = [
//         'name' => $unit->getName(),
//         'enabled' => Module::isEnabled($unit->getName())
//     ];
// }

// public function index()
// {
//     // Get all units installed in the application
//     $units = Module::all();

//     $unitInfo = [];

//     foreach ($units as $unit) {
//         $unitInfo[] = [
//             'name' => $unit->getName(),
//             'path' => $unit->getPath(),
//             'description' => $unit->getDescription(),
//             'enabled' => $unit->isEnabled() ? 'Enabled' : 'Disabled',
//         ];
//     }

//     return response()->json([
//         'units' => $unitInfo
//     ]);        
// }
