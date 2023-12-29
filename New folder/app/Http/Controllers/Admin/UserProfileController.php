<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Profile;
use App\Models\Thana;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   final public function index()
    {
        $divisions = Division::pluck('name', 'id');
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('backend.modules.profile.profile', compact('divisions', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required',
            'address' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'gender' => 'required',
        ]);
        
        $profile_data = $request->all();

        $profile_data['user_id'] = Auth::id();
        
        $existing_profile = Profile::where('user_id', Auth::id())->first();
        if ($existing_profile){
            $existing_profile->update($profile_data);
        }else{
            Profile::create($profile_data);
        }
       
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

   
    final public function getDistrict($division_id)
    {
        $districts = District::select('id', 'name')->where('division_id', $division_id)->get();
        return response()->json($districts);

    }
    final public function getThana($district_id)
    {
        $thanas = Thana::select('id', 'name')->where('district_id', $district_id)->get();
        return response()->json($thanas);

    }
    final public function upload_photo(Request $request)
    { 
        $photo = $request->input('image');
        $slug = str_slug(Auth::user()->name);
        
        if(isset($photo)){
            $currentDate = Carbon::now()->toDateString();
            $photoName = $slug.'-'.$currentDate.'-'.'.'.$photo->getClientOriginalExtension();
            if(!file_exists('uploads/user/photo')){
                mkdir('uploads/user/photo', 077, true);
            }
            $photo->move('uploads/user/$photo', $photoName);
        }else{
            $photoName = 'default.png';
        }
        $photo = new Profile();
        $photo->image = $photoName;
        $photo['image'] = url('uploads/user/photo/'.$photo->photo);
  
        return redirect()->back();

       
   
    }
}
