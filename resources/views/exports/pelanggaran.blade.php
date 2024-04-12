<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NISN</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Jenis Pelanggaran</th>
            <th>Poin</th>
            <th>Pelapor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item['nama_siswa'] }}</td>
                <td>{{ $item['nis'] }}</td>
                <td>{{ $item['kelas'] }}</td>
                <td>{{ $item['tanggal'] }}</td>
                <td>{{ $item['jenis_pelanggaran'] }}</td>
                <td>{{ $item['poin'] }}</td>
                <td>{{ $item['pelapor'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
