<table  class="table table-bordered table-hover" style=";width: 100%">
    <thead>

    <tr>
        <th>Id</th>
        <th>Chủ đơn</th>
        <th>CMTND</th>
        <th>Địa Chỉ</th>
        <th>Nội Dung</th>
    </tr>

    </thead>
    <tbody>
    @if(!empty($output))
        @foreach($output as $val)
            <tr>
                <td>{{$val['Id']}}</td>
                <td>{{$val['ChuDon']}}</td>
                <td>{{$val['DiaChi']}}</td>
                <td>{{$val['CMTND']}}</td>
                <td>{{$val['NoiDung']}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>