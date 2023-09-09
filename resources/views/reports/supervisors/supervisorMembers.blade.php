<!DOCTYPE html>
<html lang="ar">
<?php
// Import the Carbon\Carbon class at the top of your Blade template
use Carbon\Carbon;
$total = 0;
$RemainingAmount = 0;
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
        المشرف:{{ $supervisor->name }}</h3>
    <span style="color: red">ملاحظة : الترتيب من الأقدم للأحدث .</span>
    <br>
    <br>
    <table border="1" cellspacing="0" cellpadding="0">
        <tr>
            <th>إسم العضو</th>
            <th>رقم الجوال</th>
            <th>اجمالي المساهمات</th>
            <th>المتبقي دفعه</th>
            <th>تاريخ الإنضمام</th>
        </tr>
        @foreach ($supervisor->members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>{{ $member->phone }}</td>
            @php
                $creationDate = new DateTime($member->created_at);
                $currentDate = new DateTime();
                $interval = $creationDate->diff($currentDate);
                $monthDiff = $interval->format('%m') + 12 * $interval->format('%y');
                $contribution = $member->contributions;
                $totalAmount = $contribution * $monthDiff;
                $total = 0;
            @endphp
                @foreach ($member->subscribes as $item)
                    @php
                        $total += $item->value;
                    @endphp
                @endforeach
            <td>{{ $total }}</td>
            <td>{{ $totalAmount - $total }}</td>
            <td>{{ $member->created_at->diffForHumans() }}<br><br> {{ $member->created_at->format('Y-m-d') }}</td>
        </tr>
    @endforeach

    </table>
    @if ($supervisor->members->isEmpty())
        <h3>لا يوجد أعضاء لهذا المشرف</h3>
    @endif
</body>
</html>
