<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    private function checkAuth () {
        if (auth()->guest()) {
            return view('home');
        }
    }

    private function validate_campaign ($request) {
        $request->validate([
            'name' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'total_budget'=> 'required|numeric',
            'daily_budget'=> 'required|numeric',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    public function store (Request $request) {
        // Validate request
        $this->validate_campaign($request);
        // Get request body
        $data = $request->all();
        $images = $data['images'];
        unset($data['images']);
        // Save campaign
        $campaign = $this->campaign->create($data);
        // Process images
        foreach ($images as $image) {
            $name = md5(\Str::random(16). time());
            $extension = $image->extension();
            $image_url = $image->storeAs(
                '/campaign-images',
                $name.".".$extension,
                ['disk' => 'public']
            );
            // Save image
            $campaign->images()->create([
                'file_url' => $image_url,
            ]);
        }
        return redirect('home')->with('status', 'Campaign created successfully');
    }

    public function fetch () {
        $campaigns = $this->campaign->orderBy('id', 'desc')->get();
        return view('home', compact('campaigns'));
    }

    public function show_create () {
        $this->checkAuth();
        return view('create');
    }
}
