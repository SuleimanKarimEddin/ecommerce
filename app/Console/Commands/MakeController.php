<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeController extends Command
{
    protected $signature = 'module:make-ccontroller  {name} {module}';

    protected $description = 'Create a new controller class with custom content';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');

        $fillPathWithLastName = $name;

        $controllerName = Str::studly($name).'Controller';
        $path = base_path("Modules/{$module}/Http/Controllers/{$controllerName}.php");
        $directoryPath = base_path("Modules/{$module}/Http/Controllers");
        $namespace = null;

        $parts = explode('/', $name);

        $name = array_pop($parts);
        $controllerName = $name.'Controller';
        $lowerCaseNameController = strtolower($name);

        foreach ($parts as $part) {
            $directoryPath .= DIRECTORY_SEPARATOR.Str::studly($part);
            if (! $namespace) {
                $namespace = Str::studly($part);
            } else {
                $namespace .= DIRECTORY_SEPARATOR.Str::studly($part);
            }
            if (! File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }
        }

        if (file_exists($path)) {
            $this->error('Controller already exists!');

            return;
        }

        $content = <<<'STUB'
<?php

namespace Modules\{{Module}}\Http\Controllers{{NAMESPACE2}};
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\{{Module}}\Http\Requests\{{NAMESPACE}}\Create{{NAME}}Request;
use Modules\{{Module}}\Http\Requests\{{NAMESPACE}}\Delete{{NAME}}Request;
use Modules\{{Module}}\Http\Requests\{{NAMESPACE}}\GetOne{{NAME}}Request;
use Modules\{{Module}}\Http\Requests\{{NAMESPACE}}\Update{{NAME}}Request;
use Modules\{{Module}}\Http\Requests\{{NAMESPACE}}\GetAll{{NAME}}Request;

use Modules\{{Module}}\Http\Resources\{{NAMESPACE}}\GetAll{{NAME}}Resource;
use Modules\{{Module}}\Http\Resources\{{NAMESPACE}}\GetOne{{NAME}}Resource;

class {{ControllerName}} extends Controller
{
    public function __construct(private $service) {

    }

    public function getOne(GetOne{{NAME}}Request $request) {
        $data = $this->service->findByID($request->id);
        $response = new GetOne{{NAME}}Resource($data);
        return response()->json($response);
    }

    public function getAll(GetAll{{NAME}}Request $request) {
        $data = $this->service->getAll($is_pagenate = true, $request->per_page ?? 8);
        $response = GetAll{{NAME}}Resource::collection($data);
        return response()->json($response);
    }

    public function create(Create{{NAME}}Request $request) {
        $data = $this->service->create($request->validated());
        return response()->json($data);
    }

    public function update(Update{{NAME}}Request $request) {
        $data = $this->service->update($request->id, $request->validated());
        return response()->json($data);
    }

    public function delete(Delete{{NAME}}Request $request) {
        $data = $this->service->delete($request->id);
        return response()->json($data);
    }
}
STUB;

        $NAMESPACE = $namespace ? $namespace.DIRECTORY_SEPARATOR.$name : $name;
        $convertedString = str_replace('/', '\\', $NAMESPACE);

        $stub = str_replace('{{ControllerName}}', $controllerName, $content);
        $stub = str_replace('{{NAME}}', $name, $stub);
        $stub = str_replace('{{NAMESPACE}}', $convertedString, $stub);
        $stub = str_replace('{{lower_case_name}}', $lowerCaseNameController, $stub);
        $stub = str_replace('{{NAMESPACE2}}', '\\'.$namespace, $stub);
        $stub = str_replace('{{Module}}', $module, $stub);

        file_put_contents($path, $stub);

        // Create Function
        Artisan::call('module:make-crequest', ['module' => $module, 'name' => "{$fillPathWithLastName}/Create{$name}"]);

        // Update Function
        Artisan::call('module:make-crequest', ['module' => $module, 'name' => "{$fillPathWithLastName}/Update{$name}"]);

        // Delete Function
        Artisan::call('module:make-crequest', ['module' => $module, 'name' => "{$fillPathWithLastName}/Delete{$name}"]);

        // Get One Function
        Artisan::call('module:make-crequest', ['module' => $module, 'name' => "{$fillPathWithLastName}/GetOne{$name}"]);
        Artisan::call('module:make-resource', ['module' => $module, 'name' => "{$fillPathWithLastName}/GetOne{$name}Resource"]);

        // Get All Function
        Artisan::call('module:make-crequest', ['module' => $module, 'name' => "{$fillPathWithLastName}/GetAll{$name}"]);
        Artisan::call('module:make-resource', ['module' => $module, 'name' => "{$fillPathWithLastName}/GetAll{$name}Resource"]);
        Artisan::call('module:make-resource', ['module' => $module, 'name' => "{$fillPathWithLastName}/GetAll{$name}Collection"]);

        $this->info('Controller created successfully!');
    }
}
