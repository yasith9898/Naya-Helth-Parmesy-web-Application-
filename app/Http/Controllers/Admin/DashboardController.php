<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Partner;
use App\Models\Feedback;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_items' => Item::count(),
            'active_items' => Item::where('is_active', true)->count(),
            'total_partners' => Partner::count(),
            'total_feedback' => Feedback::count(),
        ];

        $recentItems = Item::latest()->take(5)->get();
        $recentPartners = Partner::latest()->take(5)->get();
        $recentFeedback = Feedback::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentItems', 'recentPartners', 'recentFeedback'));
    }
}
