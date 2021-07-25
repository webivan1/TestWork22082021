<?php

namespace App\Console\Commands;

use App\Models\Hotel\Contract\HotelRepositoryContract;
use App\Models\Hotel\UseCase\Mutate\Handler;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Hotel\UseCase\Mutate\Command as HotelCommand;
use Illuminate\Support\Str;

class ImportHotelsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'import:hotels {fileName?}';

    /**
     * @var string
     */
    protected $description = 'Import hotels from csv files';

    private string $defaultExt = 'jpg';

    private string $currentDir;

    private array|false $files;

    public function __construct()
    {
        parent::__construct();

        $this->currentDir = storage_path('import');
        $this->files = glob($this->currentDir . '/*.csv');
    }

    public function handle(HotelRepositoryContract $repo, Handler $handler): int
    {
        foreach ($this->files as $file) {
            if ($this->argument('fileName') && basename($file) !== $this->argument('fileName')) {
                $this->warn('Ignore file ' . basename($file));
                continue;
            }

            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            // remove heading
            array_shift($lines);

            foreach ($lines as $line) {
                [$name, $image, $city, $address, $desc, $stars, $lat, $lon] = str_getcsv($line, ';');

                $name = trim($name);
                $address = trim($address);

                try {
                    if (!$model = $repo->findByNameAndAddress($name, $address)) {
                        $command = new HotelCommand();
                        $command->name = $name;
                        $command->image = $this->createImageFromUrl($image);
                        $command->city = trim($city);
                        $command->address = $address;
                        $command->description = trim($desc);
                        empty($stars) ?: $command->stars = (int)$stars;
                        empty($lat) ?: $command->latitude = (float)$lat;
                        empty($lon) ?: $command->longitude = (float)$lon;

                        $model = $handler->create($command);

                        $this->info('Added ' . $model->name . ' #' . $model->id);
                    }
                } catch (\Exception $e) {
                    $this->error($e->getMessage());
                }
            }
        }

        return 0;
    }

    public function createImageFromUrl(string $urlImage): ?string
    {
        $extOrigin = strtolower((string)pathinfo($urlImage, PATHINFO_EXTENSION));

        if (!in_array($extOrigin, ['webp', 'gif', 'png', 'jpg', 'jpeg', 'svg'])) {
            $extOrigin = $this->defaultExt;
        }

        $newFileName = 'images/' . Str::random(32) . '.' . $extOrigin;

        $client = new Client(['verify' => false]);
        $response = $client->get($urlImage);

        if ($response->getStatusCode() === 200 && Storage::put($newFileName, $response->getBody()->getContents())) {
            return $newFileName;
        }

        return null;
    }
}
