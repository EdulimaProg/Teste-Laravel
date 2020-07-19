@extends('components.page')

@section('title', 'Category list')

@section('content')
    <div class="row">
        <div class="col">
            <div class="row p-4 justify-content-center" style="background-color: whitesmoke">
                <h3>{{$title}}</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col mt-2">
                    <div class="col mr-5">
                        <div class="col mt-5">
                            <div class="col">
                                <div class="col">
                                    <div class="col">
                                        @foreach($list as $value)
                                            <a href="{{env('APP_URL')}}/video/view/{{$value->idvideo}}">
                                                <div class="row justify-content-center">
                                                    <div class="col-2">
                                                        <iframe src="{{$value->videourl}}" style="width: 200px; height: 150px"></iframe>
                                                    </div>
                                                    <div class="col-4 ml-5" style="width: 60px; height: 150px; border: black solid 1px">
                                                        <div class="row m-3">
                                                            <h3>{{$value->videotitle}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
