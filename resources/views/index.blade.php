@extends('components.page')

@section('title', 'inicial')

@section('content')
    <div class="container m-4">
        <div class="row">
            <div class="col-1 mt-4">
                <div class="row">
                    <button type="button" class="btn btn-primary ml-4" data-toggle="modal"
                            data-target="#exampleModalCenter">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-film m-2" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0h8v6H4V1zm8 8H4v6h8V9zM1 1h2v2H1V1zm2 3H1v2h2V4zM1 7h2v2H1V7zm2 3H1v2h2v-2zm-2 3h2v2H1v-2zM15 1h-2v2h2V1zm-2 3h2v2h-2V4zm2 3h-2v2h2V7zm-2 3h2v2h-2v-2zm2 3h-2v2h2v-2z"/>
                        </svg>
                    </button>
                </div>
                <div class="row mt-2">
                    <button type="button" class="btn btn-primary ml-4" data-toggle="modal"
                            data-target="#exampleModalCenter2">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tag m-2" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M2 2v4.586l7 7L13.586 9l-7-7H2zM1 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2z"/>
                            <path fill-rule="evenodd"
                                  d="M4.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="col-7">
                <div style="background-color: whitesmoke">
                    <div class="row">
                        <div class="col pt-3 pl-5 pr-4">
                            @for($i = 0; $i < count($favs); $i++)
                                <div class="row pl-3 pr-3">
                                    <div class="" style="width: 95%; background-color: white">
                                        <div class="pl-4 pt-2"><h4>{{$favs[$i]['namecategoria']}}</h4></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="" style="width: 95%; background-color: white">
                                        <div id="listavideo">
                                            @for($j = 0; $j < count($favs[$i]['videos']); $j++)
                                                <a href="{{env('APP_URL')}}/video/view/{{$favs[$i]['videos'][$j]->idvideo}}">
                                                    <div class="row justify-content-center">
                                                        <div class="col-2">
                                                            <iframe src="{{$favs[$i]['videos'][$j]->videourl}}" style="width: 200px; height: 150px"></iframe>
                                                        </div>
                                                        <div class="col ml-5" style=" width: 50px; height: 150px;">
                                                            <div class="col ml-5">
                                                                <div class="row m-3">
                                                                    <h3>{{$favs[$i]['videos'][$j]->videotitle}}</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="mb-1" style="background-color: #005cbf;width: 100%; height: 285px">
                        <div class="container mt-2 div-scroll">
                            <ul class="list-group">
                                @foreach($category as $value)
                                    <li class="list-group-item m-1"><a
                                            href="{{ route('to-category',$value->idcategory) }}">{{$value->categoryname}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-1" style="width: 100%; height: 285px">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div>
                            <form action="{{route('save')}}">
                                @csrf
                                <div class="pt-3">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group mb-3">
                                                    <input type="text" id="title" name="title"
                                                           class="form-control" placeholder="Titulo"
                                                           aria-label="Titulo"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Url"
                                                           id="url"
                                                           name="url"
                                                           onchange="videourl(this.value)" aria-label="Titulo"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="form-control" id="category" name="category">
                                                        <option value="0">Selecione a Categoria</option>
                                                        @foreach($category as $value)
                                                            <option
                                                                value="{{$value->idcategory}}">{{$value->categoryname}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col ml-5">
                                                <div class="col ml-5">
                                                    <div class="col ml-4 mt-3 mb-2">
                                                        <div class="col">
                                                            <button type="submit" class="btn btn-primary">
                                                                Salvar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div>
                            <form action="{{route('save-category')}}" method="POST">
                                @csrf
                                <div class="pt-3">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group mb-3">
                                                    <input type="text" id="categoryname" name="categoryname"
                                                           class="form-control" placeholder="Nome Categoria"
                                                           aria-label="Titulo"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Favorito</label>
                                                    <select class="form-control" id="fav" name="fav">
                                                        <option value="false">Selecione</option>
                                                        <option value="true">Sim</option>
                                                        <option value="false">Não</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col ml-5">
                                                <div class="col ml-5">
                                                    <div class="col ml-4 mt-3 mb-2">
                                                        <div class="col">
                                                            <button type="submit" class="btn btn-primary">
                                                                Salvar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function videourl(id) {
            console.log(id)
            $('#video').attr('src', id)
        }
    </script>

    <script>
        function listvideo() {
            console.log('oi')
        }
    </script>
@endsection
