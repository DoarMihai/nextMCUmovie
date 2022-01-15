<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FetchMovieInfoCommand extends Command
{
    /** @var KernelInterface */
    private $kernel;
    /** @var HttpClientInterface */
    private $httpClient;

    protected static $defaultName = 'fetch:movie';
    protected static $defaultDescription = 'Fetch next MCU movie info.';

    const API_URL = 'https://www.whenisthenextmcufilm.com/api';

    public function __construct(
        KernelInterface $kernel,
        HttpClientInterface $httpClient,
        string $name = null
    ) {
        $this->kernel = $kernel;
        $this->httpClient = $httpClient;
        parent::__construct($name);
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->info("START");

        $this->fetchData();

        $io->success('Movie info retrieved!');

        $io->info("END");

        return Command::SUCCESS;
    }

    private function fetchData()
    {
        $response = $this->httpClient->request(
            'GET',
            self::API_URL
        );

        $content = $response->getContent();

        $this->saveCache($content);

        // save data to cache
    }

    private function saveCache(string $data)
    {
        $fileName = 'nextMovie.json';

        $projectPath = $this->kernel->getProjectDir();
        $storagePath = $projectPath . DIRECTORY_SEPARATOR . 'storage';
        $filePath = $storagePath . DIRECTORY_SEPARATOR . $fileName;

        file_put_contents($filePath, $data);
    }
}
