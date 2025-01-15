<!DOCTYPE html>
<html>
<head>
    <title>Autocomplete Search with Full Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h1>Autocomplete Search</h1>
    <input class="typeahead form-control" id="search" type="text" placeholder="Search Post Titles">

    <!-- Post Details Section -->
    <div id="post-details" style="margin-top: 20px; display: none;">
        <h3>Post Details</h3>
        <p><strong>ID:</strong> <span id="post-id"></span></p>
        <p><strong>Title:</strong> <span id="post-title"></span></p>
        <p><strong>Body:</strong> <span id="post-body"></span></p>
        <p><strong>Email:</strong> <span id="post-email"></span></p>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var path = "{{ route('autocomplete') }}";

        $('#search').typeahead({
            minLength: 1, // Minimum characters to start search
            highlight: true, // Highlight matching parts in suggestions
            source: function (query, process) {
                $.get(path, { query: query }, function (data) {
                    console.log("Fetched Data:", data); // Log the fetched data
                    if (data && data.length > 0) {
                        $('#search').data('results', data); // Store full results
                        return process(data.map(item => item.title)); // Extract titles for suggestions
                    } else {
                        return process([]); // No results
                    }
                }).fail(function () {
                    console.error('Autocomplete request failed.');
                });
            },
            updater: function (item) {
                // Get the full object based on the selected title
                let results = $('#search').data('results');
                let selected = results.find(post => post.title === item);

                if (selected) {
                    // Populate post details
                    $('#post-id').text(selected.id);
                    $('#post-title').text(selected.title);
                    $('#post-body').text(selected.body);
                    $('#post-email').text(selected.email);

                    // Show post details section
                    $('#post-details').show();
                }

                return item; // Return selected item
            }
        });
    });
</script>
</body>
</html>
