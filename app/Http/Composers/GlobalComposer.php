<?php

namespace App\Http\Composers;

use App\Models\Item;
use Illuminate\View\View;

/**
 * Class GlobalComposer.
 */
class GlobalComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $qty_alert = Item::where('qty_alert_disabled', 0)
            ->whereRaw('qty_alert < qty_left')
            ->get();

        $view->with('logged_in_user', auth()->user())
            ->with('qty_alert', $qty_alert);
    }
}
