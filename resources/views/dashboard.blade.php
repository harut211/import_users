@vite(['resources/sass/app.scss', 'resources/js/app.js','resources/js/custom.js','resources/css/custom.css'])
<link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="container mt-5">
                        <div id="file-upload" class="file-upload">
                            <p>Drag & drop files here or click to upload</p>
                            <input type="file" id="file-input" multiple class="form-control">
                        </div>
                        <div id="file-list" class="mt-3"></div>
                        @if(!empty($errors))
                            <div>{{$errors->first()}}</div>
                        @endif
                        <button class="btn btn-success file-upload">submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
