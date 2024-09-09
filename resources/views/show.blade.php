@vite(['resources/sass/app.scss'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="card">
            <div class="card-body  justify-content-between" style=" width: 600px; margin-left: auto;margin-right: auto;" >
               @if(!empty($peoples))
                    @foreach($peoples as $people)
                        <div class="alert alert-light" role="alert" style="width: 400px">
                            {{ "ID : " . $people->id . " " . $people->firstname . "  " . $people->lastname . "  " . $people->gender . " " . $people->age . " " . $people->country . " " . $people->locale }}
                        </div>
                    @endforeach
               @endif
            </div>
        </div>
    </x-slot>
</x-app-layout>
