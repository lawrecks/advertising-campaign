<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function getImages ($id) {
        $images = $this->campaign->find($id)->images;
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'data' => $images
        ]);
    }
}
