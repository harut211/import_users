@vite(['resources/sass/app.scss'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <div class="card">
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
            <div class="card-body d-flex justify-content-between"
                 style=" width: 600px; margin-left: auto;margin-right: auto;">
                <div class="left">
                    <div class="alert alert-light" role="alert" style="width: 200px">
                        firstname
                    </div>
                    <div class="alert alert-light" role="alert" style="width: 200px">
                        lastname
                    </div>
                    <div class="alert alert-light" role="alert" style="width: 200px">
                        gender
                    </div>
                    <div class="alert alert-light" role="alert" style="width: 200px">
                        age
                    </div>
                    <div class="alert alert-light" role="alert" style="width: 200px">
                        country
                    </div>
                    <div class="alert alert-light" role="alert" style="width: 200px">
                        locale
                    </div>
                </div>
                <div class="right">
                    <form action="{{route('store')}}" method="post">
                        <input type="hidden" name="filename" value="{{$filename}}">
                        <div class="alert alert-light" role="alert" style="width: 250px;    margin-bottom: 0;">
                            <select class="form-select" name="firstname" aria-label="Default select example"
                                    style="width: 200px">
                                @foreach($headers as $header)
                                    <option value="{{$header}}">{{$header}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-light" role="alert" style="width: 250px;    margin-bottom: 0;">
                            <select class="form-select" name="lastname" aria-label="Default select example"
                                    style="width: 200px">
                                @foreach($headers as $header)
                                    <option value="{{$header}}">{{$header}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-light" role="alert" style="width: 250px;    margin-bottom: 0;">
                            <select class="form-select" name="gender" aria-label="Default select example"
                                    style="width: 200px">
                                @foreach($headers as $header)
                                    <option value="{{$header}}">{{$header}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-light" role="alert" style="width: 250px;    margin-bottom: 0;">
                            <select class="form-select" name="age" aria-label="Default select example"
                                    style="width: 200px">
                                @foreach($headers as $header)
                                    <option value="{{$header}}">{{$header}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-light" role="alert" style="width: 250px;    margin-bottom: 0;">
                            <select class="form-select" name="country" aria-label="Default select example"
                                    style="width: 200px">
                                @foreach($headers as $header)
                                    <option value="{{$header}}">{{$header}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-light" role="alert" style="width: 250px;    margin-bottom: 0;">
                            <select class="form-select" name="locale" aria-label="Default select example"
                                    style="width: 200px">
                                @foreach($headers as $header)
                                    <option value="{{$header}}">{{$header}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success">store</button>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
