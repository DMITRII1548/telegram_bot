<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class ParseKwork extends Command
{
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
        $response = Http::get('https://kwork.ru/projects');
        $html = (string)$response->body();

        $crawler = new Crawler($html);

        $script = $crawler->filter('script')->eq(11)->text();

        if (preg_match('/window\.stateData\s*=\s*(\{.*\});/s', $script, $matches)) {
            $script = $matches[1];

            $json = json_decode($script, true);
        }
    }
}
