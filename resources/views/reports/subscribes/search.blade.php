<!-- resources/views/subscribers/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Subscriber Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Subscriber Search</h1>

    <form id="searchForm">
        <label for="month">Month:</label>
        <select name="month" id="month">
            <!-- Add month options here -->
        </select>
        <label for="year">Year:</label>
        <input type="text" name="year" id="year">
        <button type="submit">Search</button>
    </form>

    <div id="results">
        <!-- Results will be displayed here -->
    </div>

    <script>
        $(document).ready(function () {
            $('#searchForm').submit(function (e) {
                e.preventDefault();
                var month = $('#month').val();
                var year = $('#year').val();
                $.ajax({
                    type: 'GET',
                    url: '/search',
                    data: { month: month, year: year },
                    success: function (data) {
                        var results = '<ul>';
                        $.each(data, function (index, subscriber) {
                            results += '<li>' + subscriber.name + '</li>';
                        });
                        results += '</ul>';
                        $('#results').html(results);
                    }
                });
            });
        });
    </script>
</body>
</html>
