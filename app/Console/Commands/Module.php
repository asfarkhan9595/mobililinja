<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';
    protected $description = 'Generate module files';


    /**
     * The console command description.
     *
     * @var string
     */
     /**
     * Execute the console command.
     */
    public function handle()
    {
        // $module = ucfirst($this->argument('name'));
        $module = lcfirst(ucwords($this->argument('name')));
        // dd($module);

        // Manually create Services - no built-in generator
        if(!File::exists(app_path("Http/Controllers/Superadmin/{$module}")))
        File::makeDirectory(app_path("Http/Controllers/Superadmin/{$module}"), 0755, true);

        $servicePath = app_path("Http/Controllers/Superadmin/{$module}/{$module}Controller.php");
        $this->generateFile($servicePath, $this->getControllerStub($module));
        
        // Manually create Controller - no built-in generator
        if(!File::exists(app_path("Http/Services")))
        File::makeDirectory(app_path("Http/Services"), 0755, true);

        $servicePath = app_path("Http/Services/{$module}Service.php");
        $this->generateFile($servicePath, $this->getServiceStub($module));

        
        // Create Routes
        $module = strtolower($module);

        $routePath = base_path("routes/v1/superadmin/{$module}.php");
        $this->generateFile($routePath, $this->getRouteStub($module));

        if(!File::exists(resource_path("views/_back/superadmin/".$module.'s')))
        File::makeDirectory(resource_path("views/_back/superadmin/".$module.'s'), 0755, true);
        // Create Resources
        $resourcePath = resource_path("views/_back/superadmin/{$module}s/manage.blade.php");
        $this->generateFile($resourcePath, $this->getResourceStub($module));
        
        $resourcePath = resource_path("views/_back/superadmin/{$module}s/create.blade.php");
        $this->generateFile($resourcePath, $this->getResourceStub($module));

        $resourcePath = resource_path("views/_back/superadmin/{$module}s/edit.blade.php");
        $this->generateFile($resourcePath, $this->getResourceStub($module));

        $this->info('Module files generated successfully.');
    }

    private function generateFile($path, $content)
    {
        file_put_contents($path, $content);
    }

    private function getControllerStub($module){
        $stubPath = base_path("stubs/Controller.stub");

        if (File::exists($stubPath)) {
            $stub = File::get($stubPath);
            $stub = str_replace('{{name}}', $module, $stub); // Replace {$name} with the actual module name
            return $stub;
        }
    }

    private function getServiceStub($module)
    {
        $stubPath = base_path("stubs/Service.stub");

        if (File::exists($stubPath)) {
            $stub = File::get($stubPath);
            $stub = str_replace('{{name}}', $module, $stub); // Replace {$name} with the actual module name
            return $stub;
        }
    }

    private function getRouteStub($module)
    {
        return "<?php\n\n// Define your routes for the {$module} module here";
    }

    private function getResourceStub($module)
    {
        return "<?php\n\n// Your resource content for the {$module} module here";
    }

}
