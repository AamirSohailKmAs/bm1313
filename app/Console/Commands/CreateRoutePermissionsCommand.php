<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-route-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission routes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Generating Permission Routes');

        $routes = Route::getRoutes()->getRoutes();
        $names = [];
        foreach ($routes as $route) {
            if (
                $route->getName() != ''
                && $route->getAction()['middleware']['0'] == 'web'
                && array_key_exists("2", $route->getAction()['middleware'])
                && $route->getAction()['middleware']['2'] == 'permission'
                && !str_contains($route->getName(), '.create')
                && !str_contains($route->getName(), '.edit')
            ) {
                $names[] = $route->getName();
            }
        }
        foreach ($names as $name) {
            $permission = Permission::where('name', $name)->first();

            if (is_null($permission)) {
                $is_default = 0;
                $is_allow = 1;
                if (str_contains($name, 'logout')) {
                    $is_default = 1;
                } elseif (str_contains($name, 'permissions.') || str_contains($name, 'roles.') || str_contains($name, 'teams.')) {
                    $is_allow = 0;
                }
                Permission::create([
                    'name' => $name,
                    'uses' => explode(".", $name)[0],
                    'is_default' => $is_default,
                    'is_allow' => $is_allow,
                ]);
                $this->info('Permission ' . $name . " created");
            }
        }





        // $routes = Route::getRoutes()->getRoutes();

        // foreach ($routes as $route) {
        //     if ($route->getName() != '' && $route->getAction()['middleware']['0'] == 'web' && array_key_exists("2", $route->getAction()['middleware'])) {
        //         if ($route->getAction()['middleware']['2'] == 'permission') {
        //             $permission = Permission::where('name', $route->getName())->first();

        //             if (is_null($permission)) {
        //                 $is_default = 0;
        //                 if (str_contains($permission, 'logout')) {
        //                     $is_default = 1;
        //                 }
        //                 Permission::create([
        //                     'name' => $route->getName(),
        //                     'uses' => explode(".", $route->getName())[0],
        //                     'is_default' => $is_default,
        //                 ]);
        //             }
        //         }
        //     }
        // }
        $this->info('Permission routes added successfully.  Hide Permissions Permissions');
    }
}
