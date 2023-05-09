<?php

namespace App\Http\Livewire;

use App\Models\Types;
use Exception;
use Livewire\Component;


class Categories extends Component
{
    public $allTypes;
    public $type_name;
    public $type_id;
    public $selectedForDeletingType = 0;

    protected $rules = [
        'type_name' => 'required|alpha|min:2|max:20',
    ];

    protected $messages = [
        'type_name.required' => 'Полето за :attribute е задолжително.',
        'type_name.alpha' => 'Полето за :attribute е невалидно.',
        'type_name.min' => 'Внесете минимум 2 карактери.',
        'type_name.max' => 'Полето за :attribute не смее да биде поголемо од 20 знаци.',
    ];

    protected $validationAttributes = [
        'type_name' => 'тип на храна',
    ];

    public function categoriesIndex()
    {
        $allTypes = $this->fetchTypes();

        return view('dashboard', compact("allTypes"));
    }
    public function fetchTypes()
    {
        $types = Types::all();
        return $types;
    }
    public function addType()
    {
        $this->validate();

        try{
            $typeData = [
                "type_name" => $this->type_name
            ];
            Types::create($typeData);
            return redirect()->to('/categories');
        }catch(Exception $e){
            $this->dispatchBrowserEvent("error", ['message' => 'Грешка при додавање на типот!']);
        }
    }

    public function changeDelete($type){
        $this->selectedForDeletingType = $type;
    }

    public function deleteType()
    {
        if($this->selectedForDeletingType == 0){
            return;
        }
        $types = Types::findOrFail($this->selectedForDeletingType);
        $types->delete();
        $this->allTypes = $this->fetchTypes();
        $this->selectedForDeletingType = 0;
        $this->dispatchBrowserEvent("success", ['message' => 'Типот на јадење е избришан!']);
    }
    public function editType($typeID)
    {
        $type = Types::find($typeID);
        if($type){
            $this->type_id = $type->id;
            $this->type_name = $type->type_name;
        }
    }
    public function updateType()
    {
        $this->validate();
        try{
            Types::where("id", $this->type_id)->update([
                "type_name" => $this->type_name,
            ]);
            $this->dispatchBrowserEvent("close-modal", ["modalId" => "edit-Modal"]);
            $this->dispatchBrowserEvent("success", ['message' => 'Типот на јадење е ажуриран!']);
            $this->allTypes = $this->fetchTypes();
        }catch(Exception $e){
            $this->dispatchBrowserEvent("error", ['message' => 'Грешка при ажурирање!']);
        }
    }


}
