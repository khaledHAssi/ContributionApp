<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Document</title>
</head>
<style>
     table tr td ,
    table tr th  {
            padding: 10px 15px ;
    }

</style>
<body dir="rtl">
    <h3>تقرير الأعضاء</h3>
    <table border="1" cellspacing="0" cellpadding="0" >
        <tr>
            <th>الإسم</th>
            <th>المشرف</th>
            <th>النوع</th>
            <th>رقم الجوال</th>
            <th>مبلغ المساهمة</th>
        </tr>
        @if ($members)
        @foreach ($members as $item)
        <tr 0>
            <td>{{$item->name}}</td>
            <td>{{$item->supervisor->name}}</td>
            @if($item->type ==='subscriber')
            <td>مشترك</td>
            @else
            <td>متبرع</td>
            @endif
            <td>{{$item->phone}}</td>
            <td>{{$item->contributions}}</td>
        </tr>
        @if($members->isEmpty())
        <h1>لا يوجد اعضاء</h1>
        @endif
        @endforeach
        @endif
    </table>
</body>
</html>
