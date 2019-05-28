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
            <td>{{ $data->namapel }}</td>            
            <td>{{ $data->idpel }}&nbsp;</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->tarif }}</td>
            <td>{{ $data->daya }}</td>
            <td>{{ $data->gardu }}</td>
            <td></td>
            <td>{{ $data->tglterpasang }}</td>
            <td>{{ $data->kwhmeterlama_merk }}</td>
            <td>{{ $data->kwhmeterlama_type }}</td>
            <td>{{ $data->nometerlama }}&nbsp;</td>
            <td>{{ $data->kwhmeterlama_th }}</td>
            <td>{{ $data->kwhmeterlama_sisakwh }}</td>
            <td>{{ $data->kwhmeterbaru_merk }}</td>
            <td>{{ $data->kwhmeterbaru_type }}</td>
            <td>{{ $data->nometerbaru }}&nbsp;</td>
            <td>{{ $data->kwhmeterbaru_th }}</td>
            <td><?php echo Carbon\Carbon::createFromDate($data->tgldg)->format('d-m-Y');?></td>
            <td>{{ $data->nodg }}&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $data->tglterpasang }}</td>
            <td>{{ $data->keluhan }}</td>
            <td></td>
            <td>
                @if ($data->petugas!= null)
                    {{ $data->petugas->name }}
                @else
                     
                @endif
            </td>
        </tr>
    @endforeach
    <tbody>
    
    </tbody>
</table>