@if(Route::current()->getName() == 'cooks')

<div>
    <div class = "relative overflow-x-auto">
        @livewire("cooks-dashboard", ['recipes' => $recipes, "allAllergens" => $allAllergens, "allTypes" => $allTypes])
    </div>
</div>

@elseif(Route::current()->getName() == 'userDashboard')
<div class = "relative overflow-x-auto">
    <div>
        @include("layouts.dashboard-partials.userDashboard", ['orders' => $orders])
    </div>
</div>

@elseif(Route::current()->getName() == 'dashboard')
<div class = "relative overflow-x-auto">
    <div>
        @livewire("all-users", ["users" => $users])
    </div>
</div>

@elseif(Route::current()->getName() == 'cooksOrders')
<div class = "relative overflow-x-auto">
    <div>
        @include("layouts.dashboard-partials.cookOrders", ['orders' => $orders])
    </div>
</div>

@elseif(Route::current()->getName() == 'RecipesIndex')
    <div>
        <div class = "relative overflow-x-auto">
            @livewire("recipes-cook", ["allTypes" => $allTypes, "allAllergens" => $allAllergens])
        </div>
    </div>
    @elseif(Route::current()->getName() == 'cooksInfo')

    @forelse ($users as $user)

    <div class = "relative overflow-x-auto">
        <div>
            @livewire("cooks-form", ['user' => $user])
        </div>
    </div>  
    @empty
    
    @endforelse

@elseif(Route::current()->getName() == 'categoriesIndex')
<div class = "relative overflow-x-auto">
    <div>
        @livewire("categories", ['allTypes' => $allTypes])
    </div>
</div>
@elseif(Route::current()->getName() == 'allergensIndex')
<div class = "relative overflow-x-auto">
    <div>
        @livewire("alergens", ['allAlergens' => $allAlergens])
    </div>
</div> 
@endif