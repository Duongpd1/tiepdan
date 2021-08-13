<table  class="table table-bordered table-hover" style=";width: 100%">
    <thead>

    <tr>
        <th>Mã</th>
        <th>Tên</th>
    </tr>

    </thead>
    <tbody>
    @if(!empty($data))
        @foreach($data as $val)
            <tr>
                <td>{{$val['Ma']}}</td>
                <td>{{$val['Ten']}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>