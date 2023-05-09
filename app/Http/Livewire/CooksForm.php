<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Request;
use App\Models\Recipes;
use Livewire\Component;
use App\Models\Locations;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CooksForm extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $lastname;
    public $email;
    public $mobile;
    public $biography;
    public $address;
    public $municipality;
    public $profile_image;
    public $pickup_instrucntions;
    public $website_link;
    public $facebook_link;
    public $instagram_link;
    public $other_link;

    protected $rules = [
        'name' => 'required|alpha|min:2|max:20',
        'lastname' => 'required|alpha|min:2|max:20',
        "email" => "required|email",
        "mobile" => "required|regex:/(07)?[0-9]{3}-?[0-9]{3}-?[0-9]{3}/|max:11",
        "profile_image" => "nullable|image|max:1024",
        "biography" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?¥'$''€'-]+$/u|min:25|max:255",
        "address" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,-]+$/u|min:2|max:255",
        "municipality" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,-]+$/u|min:2|max:255",

        "pickup_instrucntions" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?¥'$''€'-]+$/u|min:25|max:255",
        "website_link" => "nullable|url",
        "facebook_link" => "nullable|url",
        "instagram_link" => "nullable|url",
        "other_link" => "nullable|url",
    ];

    protected $messages = [
        'name.required' => 'Полето за :attribute е задолжително.',
        'name.alpha' => 'Полето за :attribute е невалидно.',
        'name.min' => 'Внесете минимум 2 карактери.',
        'name.max' => 'Полето за :attribute не смее да биде поголемо од 20 знаци.',

        'lastname.required' => 'Полето за :attribute е задолжително.',
        'lastname.alpha' => 'Полето за :attribute е невалидно.',
        'lastname.min' => 'Внесете минимум 2 карактери.',
        'lastname.max' => 'Полето за :attribute не смее да биде поголемо од 20 знаци.',

        'email.required' => 'Полето за :attribute е задолжително.',
        'email.email' => 'Внесете валиден :attribute.',
        'email.unique' => 'Внесивте веќе постоечки :attribute.',

        'profile_image.required' => 'Полето за :attribute е задолжително.',
        'profile_image.image' => 'Полето мора да биде слика.',
        'profile_image.max' => 'Полето за :attribute не смее да биде поголемо од 1MB|1024kb.',


        'mobile.required' => 'Полето за :attribute е задолжително.',
        'mobile.regex' => 'Внесете валиден :attribute, пример шема [077-123-456]',
        'mobile.max' => 'Полето за :attribute не смее да биде поголемо од 11 знаци.',

        'biography.required' => 'Полето за :attribute е задолжително.',
        'biography.regex' => 'Внесете валиден :attribute, пример шема [077-123-456]',
        'biography.max' => 'Полето за :attribute не смее да биде поголемо од 11 знаци.',
        'biography.min' => 'Полето за :attribute треба да има барем 25 значи.',

        'address.required' => 'Полето за :attribute е задолжително.',
        'address.regex' => 'Полето за :attribute е невалидно.',
        'address.min' => 'Внесете минимум 2 карактери.',
        'address.max' => 'Полето за :attribute не смее да биде поголемо од 255 знаци.',

        'municipality.required' => 'Полето за :attribute е задолжително.',
        'municipality.alpha' => 'Полето за :attribute е невалидно.',
        'municipality.min' => 'Внесете минимум 2 карактери.',
        'municipality.max' => 'Полето за :attribute не смее да биде поголемо од 255 знаци.',

        'pickup_instrucntions.required' => 'Полето за :attribute е задолжително.',
        'pickup_instrucntions.regex' => 'Полето за :attribute е невалидно.',
        'pickup_instrucntions.min' => 'Внесете минимум 25 карактери.',
        'pickup_instrucntions.max' => 'Полето за :attribute не смее да биде поголемо од 255 знаци.',

        'website_link.url' => 'Внесете валидна :attribute.',
        'instagram_link.url' => 'Внесете валиден :attribute линк.',
        'facebook_link.url' => 'Внесете валиден :attribute линк.',
        'other_link.url' => 'Внесете валиден :attribute.',
    ];

    protected $validationAttributes = [
        'name' => 'име',
        'lastname' => "презиме",
        'email' => "е-маил",
        'mobile' => "телефонски број",
        'biography' => "бографија",
        'address' => "адреса",
        'municipality' => "општина",
        'profile_image' => "слика",
        'pickup_instrucntions' => "инструкции за подигање",
        'website_link' => "веб страна",
        'instagram_link' => "инстаграм",
        'facebook_link' => "фејсбук",
        'other_link' => "друг линк"
    ];


    public function mount($user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->biography = $user->biography;
        $this->address = $user->location->address;
        $this->municipality = $user->location->municipality;

        
        //For some reason the records found on the cooks table could't be fetched
        //so was forced to do this jfl 😝
        $cookInfo = DB::table('cooks')
        ->join('locations', 'cooks.location_id', '=', 'locations.id')
        ->where('locations.user_id', $user->id)
        ->select('cooks.*')
        ->first();
        $this->pickup_instrucntions = $cookInfo ? $cookInfo->pickup_instrucntions : null;
        $this->website_link = $cookInfo ? $cookInfo->website_link : null;
        $this->facebook_link = $cookInfo ? $cookInfo->facebook_link : null;
        $this->instagram_link = $cookInfo ? $cookInfo->instagram_link : null;
        $this->other_link = $cookInfo ? $cookInfo->other_link : null;


    }
    
    public function cooksInfo()
    {
        return view("cooks.cooks-info", ['users' => $this->getCurrentCooksInfo()]);
    }
    
    public function getCurrentCooksInfo()
    {
        $userID = Auth::id();
    
        $users = User::with("location","cooks")
            ->where("id", $userID )->get();
        return $users;
    }
    
    private function updateLocation()
    {
            $userID = Auth::id();
            $location = DB::table('locations')->where('user_id', $userID)->first();

            if ($location) {
                DB::table('locations')
                    ->where('user_id', $userID)
                    ->update([
                        'address' => $this->address,
                        'municipality' => $this->municipality,
                    ]);

                DB::commit();
            }
            //Well that is an inconvenient way to update locations but it did work jfl 😝
            session()->flash('success', 'Корисникот е ажуриран!');
    }
    private function updateCookAdditional()
    {
        $userID = Auth::id();
        $location = DB::table('locations')->where('user_id', $userID)->first();

        if ($location) {
            $cook = DB::table('cooks')->where('location_id', $location->id)->first();

            if ($cook) {
                DB::table('cooks')
                    ->where('location_id', $location->id)
                    ->update([
                        'pickup_instrucntions' => $this->pickup_instrucntions,
                        'website_link' => $this->website_link,
                        'facebook_link' => $this->facebook_link,
                        'instagram_link' => $this->instagram_link,
                        'other_link' => $this->other_link,
                    ]);

                // Additional fields to update in the `cooks` table can be added here

                DB::commit();
            }
        }

        session()->flash('success', 'Корисникот е ажуриран!');

    }
    public function updateCook()
    {
        $this->validate();
        try {
            //If the user entered a email that already exists
            $existingUser = User::where('email', $this->email)->where('id', '!=', $this->user->id)->first();

            if($existingUser){
                session()->flash('error', 'Е-Маил адресата веќе постои во системот.');
                return;
            }
            if ($this->profile_image) {
                $imageName = md5($this->profile_image . microtime()) . '.' . $this->profile_image->extension();
                $this->profile_image->storeAs('public/images', $imageName);
                $this->user->update([
                    'name' => $this->name,
                    'lastname' => $this->lastname,
                    'email' => $this->email,
                    "profile_image" => $imageName,
                    'mobile' => $this->mobile,
                    'biography' => $this->biography
                ]);
                $this->updateLocation();
                $this->updateCookAdditional();
            }else{
                $this->user->update([
                    'name' => $this->name,
                    'lastname' => $this->lastname,
                    'email' => $this->email,
                    'mobile' => $this->mobile,
                    'biography' => $this->biography
                ]);
                $this->updateLocation();
                $this->updateCookAdditional();
            }
    

        } catch (\Exception $e) {
            session()->flash('error', 'Грешка при ажурирањето на корисникот.');
        }
    }

    public function destroy(string $id)
    {
        //
    }
}
