<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for polling
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Polling\GeneralResponse;
use App\Http\Responses\Polling\TimersResponse;
use App\Repositories\EventTrackingRepository;
use App\Repositories\TimerRepository;

class Polling extends Controller {

    /**
     * The tracking repository instance.
     */
    protected $trackingrepo;

    public function __construct(EventTrackingRepository $trackingrepo) {

        //parent
        parent::__construct();

        $this->trackingrepo = $trackingrepo;

        //authenticated
        $this->middleware('auth');

    }

    /**
     * Refresh notification icon if user has new notifications
     * @return \Illuminate\Http\Response
     */
    public function generalPoll() {

        //get users unread notifications
        $notifications_count = $this->trackingrepo->countUnread();

        //get users unread notifications
        $payload = [
            'type' => 'general',
            'notifications_count' => $notifications_count,
        ];

        //response
        return new GeneralResponse($payload);
    }

    /**
     * get the times of all stopped timers on this page. Limit to timers stopped 30 mins or less ago
     * We are doing this to refresh these timers, incase they were stopped as a result of a new timers
     * being starter, in which case, their display time was not updated.
     * @param object TimerRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function timersPoll(TimerRepository $timerrepo) {

        $payload = [];
        $timers = [];

        //first update the users running timer (if there is one)
        $timerrepo->updateUsersRunningTimer(auth()->id());

        //We are on a task list page
        if (is_array(request('timers'))) {
            //get the timers
            $tasks = [];
            foreach (request('timers') as $task_id => $value) {
                $tasks[] = $task_id;
            }
            $timers = \App\Models\Timer::selectRaw('timer_taskid, timer_time, timer_status')
                ->selectRaw('sum(timer_time) as timers_sum')
                ->WhereIn('timer_taskid', $tasks)
                ->Where('timer_creatorid', auth()->id())
                ->groupBy('timer_taskid')
                ->get();
        }

        //get users unread notifications
        $payload = [
            'timers' => $timers,
        ];

        //response
        return new TimersResponse($payload);
    }

}