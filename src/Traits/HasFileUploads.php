<?php

namespace Obelaw\UI\Traits;

use Livewire\WithFileUploads;

trait HasFileUploads
{
    use WithFileUploads;

    public function getUploadPath($field, $path = 'obelaw')
    {
        return $this->getInputs($field)->store(path: $path);
    }

    public function getUploadPaths($field, $path = 'obelaw')
    {
        $paths = [];

        foreach ($this->getInputs($field) as $file) {
            $_path = $file->store(path: $path);
            array_push($paths, $_path);
        }

        return $paths;
    }
}
