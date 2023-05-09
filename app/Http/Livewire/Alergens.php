<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Allergens;
use Exception;

class Alergens extends Component
{
    public $allAlergens;
    public $allergen_name;
    public $allergen_id;
    public $selectedForDeletingAllergen = 0;

    protected $rules = [
        'allergen_name' => 'required|alpha|min:2|max:20',
    ];

    protected $messages = [
        'allergen_name.required' => 'Полето за :attribute е задолжително.',
        'allergen_name.alpha' => 'Полето за :attribute е невалидно.',
        'allergen_name.min' => 'Внесете минимум 2 карактери.',
        'allergen_name.max' => 'Полето за :attribute не смее да биде поголемо од 20 знаци.',
    ];

    protected $validationAttributes = [
        'allergen_name' => 'алерген',
    ];


    public function allergensIndex()
    {
        $allAlergens = $this->fetchAllergens();
        return view('dashboard', compact("allAlergens"));
    }

    public function fetchAllergens()
    {
        $allergens = Allergens::all();
        return $allergens;
    }

    public function addAllergen()
    {
        $this->validate();

        try{
            $allergensData = [
                "allergen_name" => $this->allergen_name
            ];
            Allergens::create($allergensData);
            return redirect()->to('/allergens');
        }catch(Exception $e){
            $this->dispatchBrowserEvent("error", ['message' => 'Грешка при додавање на алергенот!']);
        }
    }

    public function changeDelete($allergen)
    {
        $this->selectedForDeletingAllergen = $allergen;
    }
    public function deleteAllergen()
    {
        if($this->selectedForDeletingAllergen == 0){
            return;
        }
        try{
            $allergens = Allergens::findOrFail($this->selectedForDeletingAllergen);
            $allergens->delete();
            $this->allAlergens = $this->fetchAllergens();
            $this->selectedForDeletingAllergen = 0;
            $this->dispatchBrowserEvent("success", ['message' => 'Алергенот е избришан!']);
        }catch(Exception $e){
            $this->dispatchBrowserEvent("error", ['message' => 'Грешка при бришење на алергенот!']);
        }
    }
    public function editAllergen($allergenID)
    {
        $allergen = Allergens::find($allergenID);
        if($allergen){
            $this->allergen_id = $allergen->id;
            $this->allergen_name = $allergen->allergen_name;
        }
    }
    public function updateAllergen()
    {
        $this->validate();
        try{
            Allergens::where("id", $this->allergen_id)->update([
                "allergen_name" => $this->allergen_name,
            ]);
            $this->dispatchBrowserEvent("close-modal", ["modalId" => "edit-Modal"]);
            $this->dispatchBrowserEvent("success", ['message' => 'Алергенот е успешно ажуриран!']);
            $this->allAlergens = $this->fetchAllergens();
        }catch(Exception $e){
            $this->dispatchBrowserEvent("error", ['message' => 'Грешка при ажурирање!']);
        }
    }
}
