<?php

namespace App\Http\Livewire;

use App\Models\Locations;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;


class MultiStepForm extends Component
{
    use WithFileUploads;

    public $name;
    public $lastname;
    public $email;
    public $mobile;
    public $password;
    public $address;
    public $municipality;
    public $profile_image;
    public $biography;

    public $totalSteps = 3;
    public $currentStep = 1;

    protected $rules = [
        'name' => 'required|alpha|min:2|max:20',
        'lastname' => 'required|alpha|min:2|max:20',
        "email" => "required|email|unique:users",
        "mobile" => "required|regex:/(07)?[0-9]{3}-?[0-9]{3}-?[0-9]{3}/|max:11",
        "password" => "required|min:6|max:255"
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

        'mobile.required' => 'Полето за :attribute е задолжително.',
        'mobile.regex' => 'Внесете валиден :attribute, пример шема [077-123-456]',
        'mobile.max' => 'Полето за :attribute не смее да биде поголемо од 11 знаци.',

        'password.required' => 'Полето за :attribute е задолжително.',
        'password.min' => 'Внесете минимум 6 карактери.',
        'password.max' => 'Полето за :attribute не смее да биде поголемо од 255 знаци.',
    ];

    protected $validationAttributes = [
        'name' => 'име',
        'lastname' => "презиме",
        'email' => "е-мајл",
        'mobile' => "телефонски број",
        'password' => "лозинка",
    ];

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateFields();
        $this->currentStep++;
        if($this->currentStep > $this->totalSteps){
            $this->currentStep = $this->totalSteps;
        }
    }

    public function render()
    {
        return view('livewire.multi-step-form');
    }

    public function validateFields()
    {
        if($this->currentStep == 1){
            $this->validate();
        }elseif($this->currentStep == 2){
            $nextStepRules = [
                "address" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,-]+$/u|min:2|max:255",
                "municipality" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,-]+$/u|min:2|max:255",
                "profile_image" => "required|image|max:1024",
                "biography" => "required|regex:/^[A-Za-z0-9\x{0400}-\x{04FF}\s.,!?¥'$''€'-]+$/u|min:2|max:255"
            ];
            $nextStepMessages = [
                'address.required' => 'Полето за :attribute е задолжително.',
                'address.regex' => 'Полето за :attribute е невалидно.',
                'address.min' => 'Внесете минимум 2 карактери.',
                'address.max' => 'Полето за :attribute не смее да биде поголемо од 255 знаци.',

                'municipality.required' => 'Полето за :attribute е задолжително.',
                'municipality.alpha' => 'Полето за :attribute е невалидно.',
                'municipality.min' => 'Внесете минимум 2 карактери.',
                'municipality.max' => 'Полето за :attribute не смее да биде поголемо од 255 знаци.',

                'profile_image.required' => 'Полето за :attribute е задолжително.',
                'profile_image.image' => 'Полето мора да биде слика.',
                'profile_image.max' => 'Полето за :attribute не смее да биде поголемо од 1MB|1024kb.',

                'biography.required' => 'Полето за :attribute е задолжително.',
                'biography.regex' => 'Полето за :attribute е невалидно.',
                'biography.min' => 'Внесете минимум 2 карактери.',
                'biography.max' => 'Полето за :attribute не смее да биде поголемо од 255 знаци.',

            ];
            $nextStepAttributes = [
                'address' => "адреса",
                'municipality' => "општина",
                'profile_image' => "слика",
                'biography' => "биографија"
            ];

            $this->rules = array_merge($this->rules,$nextStepRules);
            $this->messages = array_merge($this->messages,$nextStepMessages);
            $this->validationAttributes = array_merge($this->validationAttributes,$nextStepAttributes);
            
            $this->validate();
        }
    }
    
    public function register()
    {
        $this->resetErrorBag();
        
        $imageName = md5($this->profile_image . microtime()) . '.' . $this->profile_image->extension();
        $this->profile_image->storeAs('public/images', $imageName);

        $userValues = array(
            "name" => $this->name,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "password" => bcrypt($this->password),
            "biography" => $this->biography,
            "profile_image" => $imageName,
            "role_id" => "2",
            'is_active' => true,
        );

        $user = User::create($userValues);
        
        $userAddressValues = array(
            "user_id" => $user->id,
            "address" => $this->address,
            "municipality" => $this->municipality,
        );

        Locations::insert($userAddressValues);
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
