<!DOCTYPE html>

<html>

<head>

    <title>Ajax Post Request Example</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body>
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">

                Ajax Post Request Example

            </div>

            <div class="card-body">
                <table class="table table-bordered mt-3">

                    <tr>

                        <th colspan="5">

                            List Of Posts

                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal"
                                data-bs-target="#postModal">

                                Create Post

                            </button>

                        </th>

                    </tr>

                    <tr>

                        <th>ID</th>

                        <th>Title</th>
                        <th>Body</th>
                        <th>Email</th>
                        <th>Information</th>

                    </tr>

                    @foreach ($posts as $post)
                        <tr>

                            <td>{{ $post->id }}</td>

                            <td>{{ $post->title ?? "N/A"}}</td>

                            <td>{{ $post->body ?? 'N/A' }}</td>
                            <td>{{ $post->email ?? "N/A" }}</td>
                            <td>
                                ID: {{ $post->Information['id'] }},
                                Title: {{ $post->Information['title'] }},
                                Body: {{ $post->Information['body'] }},
                                Email: {{ $post->Information['email'] }}
                            </td>

                        </tr>
                    @endforeach

                </table>



            </div>

        </div>

    </div>

    <!-- Modal -->

    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <form>
                        <div class="alert alert-danger print-error-msg" style="display:none">

                            <ul>

                            </ul>

                        </div>
                        <div class="mb-3">

                            <label for="titleID" class="form-label">Title:</label>

                            <input type="text" id="titleID" name="name" class="form-control" placeholder="Name"
                                required="">

                        </div>



                        <div class="mb-3">

                            <label for="bodyID" class="form-label">Body:</label>

                            <textarea name="body" class="form-control" id="bodyID"></textarea>

                        </div>
                        <div class="mb-3">
                            <label for="emailID" class="form-label">Email:</label>

                            <input type="email" id="emailID" name="email" class="form-control" placeholder="Email"
                                required="">

                        </div>



                        <div class="mb-3 text-center">

                            <button class="btn btn-success btn-submit">Submit</button>

                        </div>



                    </form>

                </div>

            </div>

        </div>

    </div>



</body>



<script type="text/javascript">
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });



    $(".btn-submit").click(function(e) {
        e.preventDefault();
        var title = $("#titleID").val();
        var body = $("#bodyID").val();
        var email = $("#emailID").val();
        $.ajax({
            type: 'POST',
            url: "{{ route('posts.store') }}",
            data: {
                title: title,
                body: body,
                email: email
            },
            success: function(data) {

                if ($.isEmptyObject(data.error)) {

                    alert(data.success);

                    location.reload();

                } else {

                    printErrorMsg(data.error);

                }

            }

        });

    });



    function printErrorMsg(msg) {

        $(".print-error-msg").find("ul").html('');

        $(".print-error-msg").css('display', 'block');

        $.each(msg, function(key, value) {

            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');

        });

    }
</script>



</html>
