<!DOCTYPE html>
<html lang="ar">
    <?php
    // Import the Carbon\Carbon class at the top of your Blade template
    use Carbon\Carbon;
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>investment</title>
</head>
<style>
    table tr td,
    table tr th {
        padding: 10px 15px;
    }

</style>

<body dir="rtl">
    <table border="1" cellspacing="0" cellpadding="0">

        <tr>
            <th>اسم الصندوق</th>
            <th>عدد مصروفات الصندوق</th>
            <th>رصيد الصندوق</th>
            <th>عدد اشتراكات الصندوق</th>
        </tr>
        @if ($investments->isNotEmpty() )

        @foreach ($investments as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->expenses->count() }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->subscribers->count() }}</td>
                </tr>
        @endforeach
        @else
        <tr>
                <td colspan="5" style="color: red">لا يوجد بيانات </td>
        </tr>
        @endif

    </table>

</body>

</html>
