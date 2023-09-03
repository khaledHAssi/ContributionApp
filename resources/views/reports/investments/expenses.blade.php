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
    <title>Document</title>
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
            <th>إسم الصرف</th>
            <th> الصندوق</th>
            <th> وجه الصرف</th>
            <th> التفاصيل</th>
            <th> قيمة الصرف</th>
            <th> ملاحظات وجه الصرف</th>
            <th> تاريخ الإنشاء</th>
        </tr>
        @if($expenses->isNotEmpty())
        @foreach ($expenses as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->investment->name }}</td>
                <td>{{ $item->expense_field->name }}</td>
                <td>{{ $item->details }}</td>
                <td>{{ $item->total_expenses }}</td>
                @if($item->expense_field->notes)
                <td>{{ $item->expense_field->notes }}</td>
                @else
                <td>لا يوجد ملاحظات لوجه الصرف </td>
                @endif
                <td>{{ Carbon::parse($item->created_at)->locale('ar')->isoFormat('LL') }}</td>
            </tr>
        @endforeach
    </table>
    @else
            <h3>لا يوجد بيانات</h3>
    @endif
</body>
</html>
