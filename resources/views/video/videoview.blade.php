@extends('components.page')

@section('title', 'Video')

@section('content')
    <div class="container">
        <div class="container">
            <div class="container mt-2">
                <div class="row">
                    <div style="height: 500px; border: black solid 1px; border-radius: 0.50rem">
                        <iframe src="{{$video->videourl}}" style="height: 500px; width: 1050px"
                                title="Iframe Example"></iframe>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-3">

                        <input type="hidden" id="csrf" name="csrf" value="{{csrf_token()}}">
                        <input type="hidden" id="videoid" name="videoid" value="{{$video->idvideo}}">

                        <div class="row">
                            <div class="col">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 ml-3">
                                <div class="ml-5">
                                    <div class="ml-5">
                                        <div class="ml-3">
                                            <div class="ml-5">
                                                <div class="ml-5">
                                                    <div class="ml-3">
                                                        <div class="row">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control"
                                                                       placeholder="Username" id="author"
                                                                       name="author" aria-label="Username"
                                                                       aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-group">
                                                                        <textarea class="form-control"
                                                                                  aria-label="With textarea"
                                                                                  id="usercoment"
                                                                                  name="usercoment" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" onclick="savecomentary()" class="btn btn-primary">Adiconar
                                    comentario
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col p-3">
                                <div class="ml-5">
                                    <div class="ml-5">
                                        <div class="ml-2">
                                            <div class="ml-2">
                                                <div class="ml-5">
                                                    <div class="ml-3">
                                                        <div>
                                                            <p class="p-2">Comentarios</p>
                                                            <div id="card-comment" name="card-comment">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.onload = function () {
                onupdate();
            }

            function savecomentary() {
                var aut = document.getElementById('author').value;
                var usrcmt = document.getElementById('usercoment').value;
                var vid = document.getElementById('videoid').value;
                var tkn = document.getElementById('csrf').value;

                var url = '<?php echo env('APP_URL'); ?>' + '/comentary/add'

                //console.log("<?php echo env('APP_URL'); ?>")

                var data = {
                    token: tkn,
                    author: aut,
                    usercoment: usrcmt,
                    videoid: vid
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    crossDomain: true,
                    type: "POST",
                    url: url,
                    data: data,
                });

                onupdate()
            }

            function onupdate() {
                $('#card-comment').empty()
                var url = '<?php echo env('APP_URL'); ?>' + '/comentary/list/'+ document.getElementById('videoid').value
                $.ajax({
                    crossDomain: true,
                    type: "GET",
                    url: url,
                    success: function (data) {
                        console.log(data.length)
                        for (let i = 0; i < data.length; i++) {
                            $('#card-comment').append(
                                '<div class="p-1">' +
                                '<div class="card w-75">' +
                                '<div class="card-body">' +
                                '<div class="row justify-content-end">'+data[i].data+'</div>'+

                                '<p class="card-title">user: '+data[i].author+'</p>' +
                                '<p class="card-text">comentary:  '+data[i].coments+'</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            )
                        }
                    }
                });
            }

        </script>

@endsection
