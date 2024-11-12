<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Concurrency;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Symfony\Component\DomCrawler\Crawler;

class ParseKwork extends Command
{
    private int $lastPage = 1;
    private array $projects;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:kwork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse kwork projects page';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $projects = [];

        $lastPage = $this->getLastPage();

        $actions = [];

        for ($i = 1; $i <= $lastPage; $i++) {
            $actions[] = function () use ($i) {
                $response = Http::get("https://kwork.ru/projects?price-to=15000&keyword=laravel+лара+ларавел+ларавель+php+figma&page=$i");
                $html = (string)$response->body();

                $crawler = new Crawler($html);

                $script = $crawler->filter('script')->eq(11)->text();

                if (preg_match('/window\.stateData\s*=\s*(\{.*\});/s', $script, $matches)) {
                    $script = $matches[1];

                    $json = json_decode($script, true);

                    foreach ($json['wants'] as $project) {
                        $projects[] = [
                            'id' => $project['id'],
                            'title' => $project['name'],
                            'description' => $project['description'],
                            'price' => $project['priceLimit'],
                            'username' => $project['user']['username'],
                        ];
                    }
                }

                return $projects;
            };
        }


        $projects = Concurrency::run($actions);
    }

    private function getLastPage(): int
    {
        $response = Http::get("https://kwork.ru/projects?price-to=15000&keyword=laravel+лара+ларавел+ларавель+php+figma");
        $html = (string)$response->body();

        $crawler = new Crawler($html);

        $script = $crawler->filter('script')->eq(11)->text();

        if (preg_match('/window\.stateData\s*=\s*(\{.*\});/s', $script, $matches)) {
            $script = $matches[1];

            $json = json_decode($script, true);

            return $json['pagination']['last_page'];
        }
    }
}
