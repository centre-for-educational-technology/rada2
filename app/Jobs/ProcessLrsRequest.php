<?php
/**
 * Created by PhpStorm.
 * Date: 11.10.19
 * Time: 13:01
 */
namespace App\Jobs;

use App\HT2Labs\XApi\LrsService;
use App\HT2Labs\XApi\StatementData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use \Exception;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessLrsRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $statementData;

    public function __construct(StatementData $statementData)
    {
        $this->statementData = $statementData;
    }

    public function handle(): void
    {
        $lrsService = new LrsService();
        try {
            response()->json($lrsService->sendToLrs($this->statementData->getData()));
        } catch (Exception $exception) {
            static::dispatch($this->statementData)->delay(5);
        }
    }
}