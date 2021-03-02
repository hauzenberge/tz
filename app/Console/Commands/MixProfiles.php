<?php

namespace App\Console\Commands;

use App\Helpers\PrimeDateAuth;
use App\Task;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Console\Command;

class MixProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profiles:mix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mix profiles between operators';

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
     * @return void
     */
    public function handle()
    {

        $tasks = Task::with('items')->get();
        foreach ($tasks as $task) {
            foreach ($task->items as $taskItem) {
                if ($this->isTimeForMixing($taskItem)) {
                    $otherTaskItems = $this->getOtherTaskItems($task->items, $taskItem);
                    $currentTaskItemProfiles = $this->getProfiles($taskItem->operator_id);
                    $otherTaskItemProfiles = [];
                    foreach ($otherTaskItems as $otherTaskItem) {
                        $otherTaskItemProfiles[] = $this->getProfiles($otherTaskItem->operator_id);
                        $this->info($this->logProfileOperatorChanged($currentTaskItemProfiles, $otherTaskItem->operator_id));
                        $this->setProfilesToOperator($otherTaskItem->operator_id, $currentTaskItemProfiles);
                    }
                    $this->setProfilesToOperator($taskItem->operator_id, $otherTaskItemProfiles);
                }
            }
        }
    }

    private function setProfilesToOperator($operatorId, $profiles)
    {
        foreach ($profiles->data as $profile) {
            // todo uncomment here when you're ready to run
            /*
            $token = PrimeDateAuth::getAuthToken();
            $client = new Client();
            $cookieJar = new CookieJar();
            $cookieJar->setCookie(SetCookie::fromString($token));
            $response = $client->post('https://api.prime.date/operator/assign', [
                'cookies' => $cookieJar,
                'body' => json_encode(['idUser' => $profile->id, 'idOperator' => $operatorId]),
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
                ]);
            return json_decode($response->getBody()->getContents());*/
        }
    }

    private function getProfiles($operatorId)
    {
        $token = PrimeDateAuth::getAuthToken();
        $client = new Client();
        $cookieJar = new CookieJar();
        $cookieJar->setCookie(SetCookie::fromString($token));
        $response = $client->post('https://api.prime.date/female/list?id=' . $operatorId, ['cookies' => $cookieJar]);
        return json_decode($response->getBody()->getContents());
    }

    private function getOtherTaskItems($taskItems, $currentTaskItem)
    {
        return collect($taskItems)->filter(function ($item) use ($currentTaskItem) {
            return $item->id !== $currentTaskItem->id;
        });
    }

    /**
     * Check if it's time for profiles mixing:
     * Returns TRUE if current time = shift time and last mixing time (for current item) was more then 60 seconds ago
     *
     * @param $taskItem
     * @return bool
     */
    private function isTimeForMixing($taskItem)
    {
        return $this->convertCurrentTime() == $this->convertShift($taskItem->shift) &&
            $this->convertShift($taskItem->shift) - $this->convertRecentLaunchTime($taskItem->recent_launch_time) > 60;
    }

    private function convertCurrentTime()
    {
        return Carbon::now()->second(0)->timestamp;
    }

    private function convertShift($shift)
    {
        return Carbon::now()
            ->setTimeFromTimeString(Carbon::parse($shift)->toTimeString())
            ->subHours(2)
            ->second(0)
            ->timestamp;
    }

    private function convertRecentLaunchTime($recentLaunchTime)
    {
        return Carbon::parse($recentLaunchTime)
            ->subHours(2)
            ->second(0)
            ->timestamp;
    }

    private function logProfileOperatorChanged($profiles, $operatorId)
    {
        $output = '';
        foreach ($profiles->data as $profile) {
            $output .= "Updating operator for " . $profile->name . ' [ID=' . $profile->id . '], set id_operator=' . $operatorId . "\n";
        }
        return $output;
    }
}
