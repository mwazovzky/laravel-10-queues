<?php

namespace App\Jobs;

use App\Enums\Transactions\Status;
use App\Models\Transaction;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConfirmTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The maximum number of seconds a child worker may run.
     *
     * @var int
     */
    public $timeout = 1;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public $maxExceptions = 2;

    /**
     * The number of seconds to wait before retrying a job that encountered an uncaught exception.
     *
     * @var int|int[]
     */
    public $backoff = [1, 2, 3]; // wait for 1, 2, 3, 3, 3 ... seconds

    /**
     * Create a new job instance.
     */
    public function __construct(private Transaction $tx)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (in_array($this->tx->status, [Status::CONFIRMED, Status::CANCELLED])) {
            throw new Exception('Bad status.');
        }

        $this->tx->update(['status' => Status::CONFIRMED]);

        logger()->info('ConfirmTransaction::handle');
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    // public function retryUntil()
    // {
    //     return now()->addSecond(30);
    // }

    public function failed(Exception $e)
    {
        logger()->error($e->getMessage());
    }
}
