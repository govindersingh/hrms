<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Announcement;
use Carbon\Carbon;

class TodaysAnnouncements extends Component
{
    public $announcements;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->announcements = Announcement::whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today())
            ->where('status', 'active')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.todays-announcements');
    }

    public function getDetails($id)
    {
        return Announcement::findOrFail($id);
    }
}
