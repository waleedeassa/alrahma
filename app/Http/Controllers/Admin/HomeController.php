<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\DifficultCaseFamily;
use App\Models\Family;
use App\Models\Governorate;
use App\Models\Orphan;
use App\Models\SpecialNeedsPerson;
use App\Models\Sponsor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  public function index()
  {
    $orphansTotal = Orphan::count();
    $sponsoredCount = Orphan::has('sponsor')->count();
    $notSponsoredCount = $orphansTotal - $sponsoredCount;
    $data = [
      'usersCount' => User::count(),
      'sponsorsCount' => Sponsor::count(),
      'governoratesCount' => Governorate::count(),
      'citiesCount' => City::count(),
      'familiesCount' => Family::count(),
      'difficultCaseFamiliesCount' => DifficultCaseFamily::count(),
      'specialNeedsPeopleCount' => SpecialNeedsPerson::count(),

      'orphans' => $orphansTotal,
      'orphansTotal' => $orphansTotal,
      'sponsoredCount' => $sponsoredCount,
      'notSponsoredCount' => $notSponsoredCount,
    ];
    if ($orphansTotal > 0) {
      $data['sponsorshipRate'] = round(($sponsoredCount / $orphansTotal) * 100, 1);
      $data['needRate'] = round(($notSponsoredCount / $orphansTotal) * 100, 1);
    } else {
      $data['sponsorshipRate'] = 0;
      $data['needRate'] = 0;
    }

    $genderCounts = Orphan::select('gender', DB::raw('count(*) as total'))
      ->groupBy('gender')
      ->pluck('total', 'gender')
      ->toArray();

    $data['malesCount'] = $genderCounts['1'] ?? 0;
    $data['femalesCount'] = $genderCounts['2'] ?? 0;

    $ageGroups = [
      '0-5' => 0,
      '6-12' => 0,
      '13-18' => 0,
      '+18' => 0,
    ];

    Orphan::select('birth_date')
      ->whereNotNull('birth_date')
      ->chunk(500, function ($orphans) use (&$ageGroups) {
        foreach ($orphans as $orphan) {
          $age = Carbon::parse($orphan->birth_date)->age;

          if ($age <= 5) {
            $ageGroups['0-5']++;
          } elseif ($age <= 12) {
            $ageGroups['6-12']++;
          } elseif ($age <= 18) {
            $ageGroups['13-18']++;
          } else {
            $ageGroups['+18']++;
          }
        }
      });
    // Get counts of orphans and families by governorate 
    $governorates = Governorate::withCount(['orphans', 'families'])
      ->orderBy('name') // ترتيب ثابت
      ->get();

    $data['govLabels'] = $governorates->pluck('name');
    $data['orphansGovCounts'] = $governorates->pluck('orphans_count');
    $data['familiesGovCounts'] = $governorates->pluck('families_count');

    $data['ageGroups'] = $ageGroups;
    return view('admins.index', $data);
  }
}
