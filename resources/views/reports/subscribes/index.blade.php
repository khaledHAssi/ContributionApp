<!DOCTYPE html>
<html lang="ar">

<head>
    <title>Subscriber Search</title>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&family=Poppins:wght@500&family=Tajawal&display=swap" rel="stylesheet">

<style>
   * {
    font-family: 'Tajawal', 'Cairo', sans-serif;
}

        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #dddddd;
            margin-top: 2em;
            text-align: right !important;
        }

        td,
        th {
            border: 1px solid #dddddd;
            padding: 12px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #333;
            color: #fff;
        }
        .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
    </style>
</head>

<body dir="rtl" id="pdfContainer">
    <h1>ابحث عن المشتركين</h1>
    <form id="searchForm">
        <label for="day">اليوم:</label>
        <select name="day" id="day">
            @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <label for="month">الشهر:</label>
        <select name="month" id="month">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <label for="year">السنة:</label>
        <input type="text" name="year" id="year">
        <button type="submit">بحث</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>العضو</th>
                <th>اسم الاشتراك</th>
                <th>قيمة الاشتراك</th>
                <th>المتبقي عليه</th>
            </tr>
        </thead>

        <tbody id="results"></tbody>

    </table>
    <button  id="generatePdfButton" class="button">تنزيل</button>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js"></script>

    <!-- Your script -->

    <script>
        $(document).ready(function() {

            $('#searchForm').submit(function(e) {
                e.preventDefault();
                var day = $('#day').val();
                var month = $('#month').val();
                var year = $('#year').val();
                $.ajax({
                    type: 'GET',
                    url: '/search',
                    data: {
                        day: day,
                        month: month,
                        year: year
                    },
                    success: function(data) {
                        var results = '';
                        $.each(data, function(index, subscriber) {
                            results += '<tr>';
                            results += '<td>' + subscriber.members.name + '</td>';
                            results += '<td>' + subscriber.name + '</td>';
                            results += '<td>' + subscriber.value + '</td>';
                            results += '<td id="remainingAmount-' + subscriber.id +
                                '"></td>';
                            results += '</tr>';

                            // Calculate remaining amount for this subscriber
                            $.ajax({
                                type: 'GET',
                                url: '/calculateRemainingAmount/' + subscriber
                                    .id,
                                dataType: 'json',
                                success: function(data) {
                                    var remainingAmount = data
                                        .remaining_amount;
                                    $('#remainingAmount-' + subscriber.id)
                                        .text(remainingAmount);
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        });
                        $('#results').html(results);
                    }

                });
            });
        });
        $('#generatePdfButton').click(function() {
            var element = document.getElementById('pdfContainer');
            html2pdf(element);
});

    </script>


</body>

</html>
