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
    table tr td ,
   table tr th  {
           padding: 10px 15px ;
   }

</style>
<body dir="rtl">
   <h3>تقرير المشرفين</h3>
    <table border="1" cellspacing="0" cellpadding="0">
        <tr>
            <th>الإسم</th>
            <th>الإيميل</th>
            <th>رقم الجوال</th>
            <th>عدد المشتركين</th>
            <th>مجمل قيمة مبالغ الإشتراكات</th>
        </tr>
        @if ($supervisors->isNotEmpty())
            @foreach ($supervisors as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        {{ $item->members->sum(function ($member) {
                            return $member->subscribes->count();
                        }) }}
                    </td>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($item->members as $mm)
                        @php
                            $total += $mm->subscribes->sum('value');
                        @endphp
                    @endforeach
                    <td>{{ $total }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" style="color: red">لا يوجد بيانات</td>
            </tr>
        @endif


    </table>

</body>

</html>
