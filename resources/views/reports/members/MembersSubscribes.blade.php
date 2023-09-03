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
    <h3 style="font-weight: 900; font-size: 2em">
        العضو:{{ $member->name }}</h3>
        <span style="color: red">ملاحظة : الترتيب من الأحدث للأقدم.</span>
        <br>
        <br>
    <table border="1" cellspacing="0" cellpadding="0">

        <tr>
            <th>إسم الإشتراك</th>
            <th>اسم الصندوق</th>
            <th>تاريخ الإشتراك</th>
            <th>قيمة الإشتراك</th>
        </tr>
        @foreach ($member->subscribes as $subscribes)
            <tr>
                <td>{{ $subscribes->name }}</td>
                <td>{{ $subscribes->investments->name }}</td>
                <td>{{ Carbon::parse($subscribes->date)->locale('ar')->isoFormat('LL') }}</td>
                <td>{{ $subscribes->value }}</td>
            </tr>
        @endforeach
    </table>
    @if ($member->subscribes->isEmpty())
        <h3>لا يوجد اشتراكات لهذا العضو</h3>
    @endif
</body>

</html>
