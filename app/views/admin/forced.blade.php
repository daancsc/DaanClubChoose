<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body style="background-color:#f7f7f9;" onload="start()">
<table width="100%">
    <tr>
        <td colspan="3" style="text-align: center;">選擇強制課程</td>
    </tr>
    @foreach($clubs as $club)
        <tr>
            <td colspan="3">
                <a href="./admin.forced.{{$id}}.{{$club->id}}">{{$club->name}}</a>
            </td>
        </tr>
    @endforeach
</table>
</body>

</html>