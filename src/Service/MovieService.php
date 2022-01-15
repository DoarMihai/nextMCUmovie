<?php

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class MovieService
{
    /** @var KernelInterface */
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getMovieInfo(): array
    {
        $fileName = 'nextMovie.json';

        $projectPath = $this->kernel->getProjectDir();
        $storagePath = $projectPath . DIRECTORY_SEPARATOR . 'storage';
        $filePath = $storagePath . DIRECTORY_SEPARATOR . $fileName;

        $fileContent = file_get_contents($filePath);

        return json_decode($fileContent, true);
    }
}