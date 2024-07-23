<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeFormRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-crequest {name} {module} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom request in a specific module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');

        $directoryPath = base_path("Modules/{$module}/Http/Requests");
        $parts = explode('/', $name);
        $lastPart = array_pop($parts).'Request';

        foreach ($parts as $part) {
            $directoryPath .= DIRECTORY_SEPARATOR.Str::studly($part);
            if (! File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }
        }

        $filename = $directoryPath.DIRECTORY_SEPARATOR."{$lastPart}.php";

        if (file_exists($filename)) {
            $this->error('Request form already exists!');

            return;
        }

        $stub = <<<'STUB'
<?php

namespace Modules\{{Module}}\Http\Requests{{Namespace}};

use Modules\Base\Http\Requests\BaseRequest;

class {{RequestName}} extends BaseRequest
{
    public function rules()
    {
        return [
            // Add your validation rules here
        ];
    }
}
STUB;

        $stub = str_replace('{{Module}}', $module, $stub);
        $stub = str_replace('{{Namespace}}', count($parts) == 0 ? '' : '\\'.implode('\\', $parts), $stub);
        $stub = str_replace('{{RequestName}}', $lastPart, $stub);

        file_put_contents($filename, $stub);

        $this->info("Custom request form created successfully in 'Modules/{$module}/Http/Requests\\{$name}' directory!");
    }
}
