<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class DeleteUserBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:user_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '30日経過ユーザーの削除';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereDate('created_at', '<', now()->subDay(30))->get();

        DB::beginTransaction();
        try {
            foreach ($users as $user){
                $user->delete();
                DB::commit();
            }    
        } catch(Exception $e) { 
            DB::rollback(); 
        }
    }
}
