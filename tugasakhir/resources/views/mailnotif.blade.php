<body>
    <h3>{{ $title }}</h3e>
    <p>{{ $body }}</p>

    <table border="1">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Tanggal Sewa</th>
                <th>Akhir Sewa</th>
                <th>Lama Telat</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_email as $item) { ?>
                <tr>
                    <td> {{ $item['nama_item'] }} </td>
                    <td> {{ $item['tanggal_sewa'] }} </td>
                    <td> {{ $item['akhir_sewa'] }} </td>
                    <td> {{ $item['lama_telat'] }} </td>
                    <td> {{ ke_rupiah($item['denda']) }} </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
     
    <p>Terima Kasih</p>
    <h4>Bakool Outdoor</h4>
</body>