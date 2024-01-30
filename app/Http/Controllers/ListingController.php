<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use GuzzleHttp\Promise\Create;
use Illuminate\Validation\Rule;
class ListingController extends Controller
{
    // All listings
    public function index(){
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6),
            ]);
    }
    // Single listing
    public function show(Listing $listing){
        return view('listings.show' ,[
            'listing' => $listing,
           ]);
    }
    public function create(){
        return view('listings.create');
    }
    public function store(Request $request){
        // dd($request->all());
     $formFields = $request->validate([
           'title' => 'required',
           'tags' =>  'required',
           'logo' =>  'sometimes',
           'company' => ['required', Rule::unique('listings', 'company')],
           'location'  => 'required',
           'email' => ['required', 'email'],
           'website' => 'required',
           'description' => 'required',

     ]);
     if($request->hasFile('logo')){
      $formFields['logo'] = $request->file('logo')->store('logos', 'public');
     }

     $formFields['user_id'] = auth()->user()->id;
      Listing::create($formFields);
     return redirect('/')->with('message', 'List Created Successfully');
    }

    public function edit(Listing $listing){
        // dd($listing);
        return view('listings.edit',compact('listing'));
    }

    public function update(Request $request ,Listing $listing)  {
        if ($listing->user_id != auth()->user()->id) {
             abort('404', 'Unauthorised Action');
        }
        $formFields = $request->validate([
            'title' => 'required',
            'tags' =>  'required',
            'logo' =>  'sometimes',
            'company' => 'required',
            'location'  => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'description' => 'required',

      ]);
      if($request->hasFile('logo')){
       $formFields['logo'] = $request->file('logo')->store('logos', 'public');
      }
       $listing->update($formFields);
      return back()->with('message', 'List updated Successfully');
    }
    public function destroy(Listing $listing){

        if ($listing->user_id != auth()->user()->id) {
            abort('404', 'Unauthorised Action');
       }
        $listing->delete();
        return redirect('/')->with('message', 'List Deleted Successfully');
    }
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);

    }

}
