<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ResetController extends Controller
{
    public function reset()
    {
        Artisan::call('migrate:fresh --seed');
        $this->deletePublicStorages();

        session()->flash('success', 'Проект сброшен в изначальное состояние');
        return redirect()->route('index');
    }

    private function deletePublicStorages()
    {
        foreach (['categories', 'products'] as $key => $folder) {
            Storage::deleteDirectory($folder);
            Storage::makeDirectory($folder);
            
            $files = Storage::disk('reset')->files($folder);

            foreach ($files as $key => $file) {
                $fileContent = Storage::disk('reset')->get($file);
                Storage::put($file, $fileContent);
            }

        }

        return true;
    }
}
