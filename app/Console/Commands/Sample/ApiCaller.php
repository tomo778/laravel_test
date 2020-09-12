<?php

namespace App\Console\Commands\Sample;

use Illuminate\Console\Command;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ApiCaller extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apicall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'API呼び出し処理';

    /**
     * API呼び出し処理
     */
    public function handle()
    {
        $this->multiReq();
    }

    private function multiReq()
    {

        // $uri = [
        //     'http://localhost/api/wait?sec=1',
        //     'http://localhost/api/wait?sec=10',
        //     'http://localhost/api/wait?sec=1',
        //     'http://localhost/api/wait?sec=1',
        //     'http://localhost/api/wait?sec=1',
        //     'http://localhost/api/wait?sec=1',
        //     'http://localhost/api/wait?sec=1',
        //     'http://localhost/api/wait?sec=1',
        //     'http://localhost/api/wait?sec=1',
        //     'http://localhost/api/wait?sec=1',
        // ];

        // $client = new Client();
        // $requests = function () use ($uri) {
        //     foreach ($uri as $u) {
        //         yield new Request('GET', $u);
        //     }
        // };

        // $pool = new Pool($client, $requests(), [
        //     'concurrency' => 2,
        //     'fulfilled' => function ($response, $index) {
        //         // this is delivered each successful response
        //         \Log::info("成功::index::" . $index);
        //     },
        //     'rejected' => function ($reason, $index) {
        //         // this is delivered each failed request
        //         \Log::info("失敗::index::" . $index);
        //     },
        // ]);

        // // Initiate the transfers and create a promise
        // $promise = $pool->promise();

        // // Force the pool of requests to complete.
        // $promise->wait();

        $client = new Client();

        $urlList = [
            'http://localhost/api/wait?sec=1',
            'http://localhost/api/wait?sec=10',
            'http://localhost/api/wait?sec=1',
            'http://localhost/api/wait?sec=1',
            'http://localhost/api/wait?sec=1',
            'http://localhost/api/wait?sec=1',
            'http://localhost/api/wait?sec=1',
            'http://localhost/api/wait?sec=1',
            'http://localhost/api/wait?sec=1',
            'http://localhost/api/wait?sec=1',
        ];
        $requests = function ($urlList) use ($client) {
            foreach ($urlList as $url) {
                yield function () use ($client, $url) {
                    return $client->requestAsync('GET', $url);
                };
            }
        };
    
        $contents = [];
    
        $pool = new Pool($client, $requests($urlList), [
            'concurrency' => 10,
            'fulfilled' => function ($response, $index) use ($urlList, &$contents) {
                $contents[$urlList[$index]] = [
                  'html'             => $response->getBody()->getContents(),
                  'status_code'      => $response->getStatusCode(),
                  'response_header'  => $response->getHeaders()
                ];
                \Log::info("成功::index::" . $index);
            },
            'rejected' => function ($reason, $index) use ($urlList, &$contents) {
                // this is delivered each failed request
                $contents[$urlList[$index]] = [
                  'html'   => '',
                  'reason' => $reason
                ];
                \Log::info("22::index::" . $reason);
            },
        ]);
    
        $promise = $pool->promise();
        $promise->wait();
    }
}
