<?php

namespace App\Http\Controllers;

use Nwidart\Modules\Facades\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    public function index()
    {

        // $modules = Module::all();
        // $modulesWithIcons = collect($modules)->map(function ($module) {
        //     $config = json_decode(file_get_contents($module->getPath() . '/module.json'), true);
        //     return [
        //         'name' => $module->getName(),
        //         'enabled' => $config['enabled'] ?? false,
        //         'icon' => $config['icon'] ?? 'fas fa-cube',
        //         'routes' => $config['routes'] ?? []
        //     ];
        // });
        $modules = Module::all();
        $modulesWithStatus = [];

        foreach ($modules as $module) {
            $modulesWithStatus[] = [
                'name' => $module->getName(),
                'enabled' => Module::isEnabled($module->getName())
            ];
        }

        return view('module.manager', compact('modulesWithStatus'));
    }

    // public function index()
    // {
    //     // Get all modules installed in the application
    //     $modules = Module::all();

    //     $moduleInfo = [];

    //     foreach ($modules as $module) {
    //         $moduleInfo[] = [
    //             'name' => $module->getName(),
    //             'path' => $module->getPath(),
    //             'description' => $module->getDescription(),
    //             'enabled' => $module->isEnabled() ? 'Enabled' : 'Disabled',
    //         ];
    //     }

    //     return response()->json([
    //         'modules' => $moduleInfo
    //     ]);        
    // }

    public function moduleDetails($moduleName)
    {
        // Check if the module exists
        if (!Module::has($moduleName)) {
            return response()->json(['error' => 'Module not found'], 404);
        }

        // Get the specific module
        $module = Module::find($moduleName);

        // Fetch module details
        $moduleInfo = [
            'name' => $module->getName(),
            'description' => $module->getDescription(),
            'status' => $module->isEnabled() ? 'Enabled' : 'Disabled',
            'path' => $module->getPath(),
        ];

        return response()->json($moduleInfo);
    }

    // Enable a module
    public function enableModule($moduleName)
    {
        if (Module::has($moduleName)) {
            Module::enable($moduleName);
            return redirect()->back()->with('success', "Module '$moduleName' has been enabled.");
        }

        return redirect()->back()->with('error', "Module '$moduleName' does not exist.");
    }

    // Disable a module
    public function disableModule($moduleName)
    {
        if (Module::has($moduleName)) {
            Module::disable($moduleName);
            return redirect()->back()->with('success', "Module '$moduleName' has been disabled.");
        }

        return redirect()->back()->with('error', "Module '$moduleName' does not exist.");
    }
}
