<div>
    @if($currentStep == 1)
    <div>
        <div class = "flex mb-5">
            <a href="{{ route('register') }}" class = "w-full mr-6">
                <button type="button" class="text-white w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center bg-main-orange mr-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    клиент
                </button>
            </a>

            <a href="{{ route('register-cooks') }}" class = "w-full">
                <button type="button" class="bg-gray-50 text-gray-900 border-2 hover:bg-gray-100 border-gray-300 w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="24px" width="24px" version="1.1" id="Capa_1" viewBox="0 0 219.792 219.792" xml:space="preserve" class = "mr-2">
                        <g>
                            <path d="M159.4,25.975c-0.916,0-1.836,0.024-2.759,0.07C146.664,9.856,129.195,0,109.896,0c-19.3,0-36.769,9.856-46.744,26.045   c-0.923-0.047-1.844-0.07-2.76-0.07c-30.306,0-54.961,24.656-54.961,54.962c0,25.355,17.397,47.182,41.432,53.264v78.092   c0,4.143,3.357,7.5,7.5,7.5h111.066c4.143,0,7.5-3.357,7.5-7.5v-78.088c24.031-6.084,41.432-27.917,41.432-53.268   C214.361,50.631,189.706,25.975,159.4,25.975z M157.929,204.792H61.863v-14.136h20.639h27.395h27.396h20.638V204.792z    M164.485,120.563c-3.747,0.476-6.556,3.663-6.556,7.44v50.152h-14.388v-46.779c0-3.452-2.798-6.25-6.25-6.25   c-3.452,0-6.25,2.798-6.25,6.25v46.779h-14.896v-46.779c0-3.452-2.798-6.25-6.25-6.25c-3.452,0-6.25,2.798-6.25,6.25v46.779H88.752   v-46.779c0-3.452-2.798-6.25-6.25-6.25c-3.452,0-6.25,2.798-6.25,6.25v46.779H61.863V128.73c0.008-0.085,0.015-0.17,0.021-0.255   c0.248-3.952-2.618-7.416-6.547-7.912c-19.899-2.51-34.905-19.546-34.905-39.626c0-22.035,17.927-39.962,39.961-39.962   c1.929,0,3.893,0.144,5.842,0.431c3.221,0.472,6.374-1.184,7.813-4.102C80.837,23.546,94.575,15,109.896,15   c15.32,0,29.058,8.547,35.852,22.305c1.439,2.917,4.587,4.571,7.814,4.101c1.944-0.286,3.908-0.431,5.838-0.431   c22.034,0,39.961,17.927,39.961,39.962C199.361,101.005,184.368,118.04,164.485,120.563z"/>
                        </g>
                        </svg>
                    готвач
                </button>           
            </a>

        </div>
    </div>
    @endif

    @include('livewire.registerForm')

</div>
