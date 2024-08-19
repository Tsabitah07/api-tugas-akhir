<?php

namespace App\Console\Commands;

use App\Models\Counseling;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ExpireCounselings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-counselings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark counseling sessions as expired if they are past the counseling date';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        $expiredCounselings = Counseling::where('counseling_date', '<', $now)
            ->where('expired', false)
            ->update(['expired' => true, 'counseling_status_id' => 6]);

        $this->info("Expired {$expiredCounselings} counseling sessions.");
    }
}
