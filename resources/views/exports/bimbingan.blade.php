<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NISN</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Bimbingan</th>
            <th>Solusi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item['nama_siswa'] }}</td>
                <td>{{ $item['nis'] }}</td>
                <td>{{ $item['kelas'] }}</td>
                <td>{{ $item['tanggal'] }}</td>
                <td>{{ $item['bimbingan'] }}</td>
                <td>{{ $item['solusi'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
