<?php

namespace App\Http\Controllers;

use App\Models\OurTrip;
use App\Models\ReviewVideo;
use Illuminate\Http\Request;
use App\Models\CustomerReview;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $ourtrips = OurTrip::get();
            $customerReviews = CustomerReview::inRandomOrder()->limit(3)->get();
            $reviewVideo = ReviewVideo::latest()->first();
            $response = Http::get('https://img.ourcrm.app/public/api/getCountries');
            if ($response->successful()) {
                $data = $response->json();
                $coutries = $data['data'];
                return view('pages.index', compact('coutries','ourtrips','customerReviews','reviewVideo'));
            } else {
                return back()->withErrors(['error' => 'Failed to fetch data from the external API.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function getCitiesByCountryId($id)
    {
        try {
            $response = Http::get('https://img.ourcrm.app/public/api/getCitiesByCountryId/' . $id);
            if ($response->successful()) {
                $data = $response->json();
                $cities = $data;
                return response()->json($cities);
            } else {
                return response()->json(['error' => 'Failed to fetch data from the external API.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function submitForm(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'mobile' => 'required|string',
        'custom_attributes.mobile2' => 'nullable|string',
        'country_id' => 'required|integer',
        'city_id' => 'required|integer',
        'custom_attributes.level' => 'nullable|string',
        'trip' => 'nullable|integer',
        'activity_id' => 'nullable|integer',
    ]);

    try {
        $response = Http::timeout(30)->post('https://img.ourcrm.app/api/campaign_contacts/1', [
            'name' => $validatedData['name'],
            'mobile' => $validatedData['mobile'],
            'custom_attributes' => [
                'mobile2' => $validatedData['custom_attributes']['mobile2'] ?? null,
                'level' => $validatedData['custom_attributes']['level'] ?? null,
            ],
            'country_id' => $validatedData['country_id'],
            'city_id' => $validatedData['city_id'],
            'campaign_id' => $validatedData['trip'],
            'activity_id' => $validatedData['activity_id'],
        ]);
        if ($response->successful() && $response->json('status') === 200) {
            session()->flash('success', 'تم التسجيل بنجاح');
            return redirect()->back();

        } else {
            session()->flash('error', 'فشل في تسجيل البيانات.');
            return redirect()->back();

        }
    } catch (\Exception $e) {
        session()->flash('error', 'حدث خطأ أثناء محاولة الاتصال بالخادم.');
    }
}
}
