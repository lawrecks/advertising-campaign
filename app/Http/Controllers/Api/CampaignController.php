<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    private function validate_campaign ($request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'total_budget'=> 'required|numeric',
            'daily_budget'=> 'required|numeric',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ]));
        }
    }

    public function get_images ($id) {
        $images = $this->campaign->find($id)->images;
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Campaign images fetched successfully',
            'data' => $images
        ]);
    }

    public function fetch (Request $request) {
        $data = $request->all();
        if (!isset($data['page'])) {
            $data['page'] = 1;
        }
        if (!isset($data['limit'])) {
            $data['limit'] = 10;
        }
        $offset = ($data['page'] - 1) * $data['limit'];
        $campaigns = $this->campaign->orderBy('id', 'desc')
            ->limit($data['limit'])
            ->offset($offset)
            ->get();
        $count = $this->campaign->orderBy('id', 'desc')->count();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Campaign fetched successfully',
            'data' => [
                'campaigns' => $campaigns,
                'total' => $count,
                'page' => $data['page']
            ],
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
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Campaign created successfully',
            'data' => $campaign,
        ]);
    }
}
