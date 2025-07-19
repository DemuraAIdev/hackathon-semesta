<?php

namespace App\Console\Commands;

use App\Models\Assignment;
use Illuminate\Console\Command;
use Carbon\Carbon;
use PhpParser\Node\Expr\Assign;

class ReAssignmentSuperVisor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 're:assignment-super-visor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re Assignment to SuperVisor after 2 hourse without closed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lates = Assignment::where(
            'created_at',
            '>',
            Carbon::now()->subHours(2)->toDateTimeString()
        );
        foreach ($lates as $late) {
            Assignment::find($late->id)->update([
                'isLate' => true
            ]);
        }
        ;
    }
}
