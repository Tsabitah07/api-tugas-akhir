<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Counseling;
use Carbon\Carbon;

class CheckExpiredCounselingSessions extends Command
{
    protected $signature = 'counseling:check-expired';
    protected $description = 'Check and update expired counseling sessions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $counselingSessions = Counseling::all();

        foreach ($counselingSessions as $session) {
            if ($session->isExpired()) {
                // Update the status to expired
                $session->counseling_status_id = 6;
                $session->expired = true;
                $session->save();
            }
        }

        $this->info('Expired counseling sessions have been updated.');
    }
}
