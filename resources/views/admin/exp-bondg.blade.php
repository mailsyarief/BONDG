<table>
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($bondg as $data)
        <tr>
            <td>{{ $no++ }}.</td>
            <td>{{ $data->posko }}</td>
            <td><?php echo Carbon\Carbon::createFromDate($data->tgldg)->format('d-m-Y');?></td>
            <td>{{ $data->nodg }}</td>
            <td>{{ $data->namapel }}</td>
            <td>{{ $data->idpel }}&nbsp;</td>
            <td>{{ $data->gardu }}</td>
            <td>{{ $data->tarif }}</td>
            <td>{{ $data->daya }}</td>
            <td>{{ $data->noagenda  }}&nbsp;</td>
            <td>{{ $data->nohp }}</td>
            <td>{{ $data->nometerlama }}&nbsp;</td>
            <td>{{ $data->nometerbaru }}&nbsp;</td>
            <td>
                @if ($data->petugas!= null)
                    {{ $data->petugas->name }}
                @else
                     
                @endif
            </td>
            <td>{{ $data->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>