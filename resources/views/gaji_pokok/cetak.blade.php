<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gaji Pegawai Desa Pakemitan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .center {
            text-align: center;
        }

        .top-left {
            text-align: left;
            vertical-align: top;
        }

        .top-right {
            text-align: right;
            vertical-align: top;
        }

		.tinggi{
			height: 45px;
		}

		.no-border td {
            border: none;
        }
    </style>
</head>
<body>
    <h4 style="text-align: center">PEMBAYARAN PENGHASILAN TETAP (SILTAP) PERANGKAT DESA PAKEMITAN</h4>
    <h4 style="text-align: center">BULAN {{ strtoupper($bulanGaji) }} TAHUN {{ $tahunGaji }}</h4>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <td align="center"><b>No</b></td>
                <td align="center"><b>Nama Penerima</b></td>
                <td align="center"><b>Jabatan</b></td>
                <td align="center"><b>Jumlah Gaji</b></td>
                <td align="center"><b>Tanda Tangan</b></td>
            </tr>
        </thead>
        <tbody>
            @if($gaji_pokok->isEmpty())
				<tr>
					<td colspan="5" align="center">Data Tidak Ada</td>
				</tr>
			@else
				@foreach($gaji_pokok as $gaji)
				<tr>
					<td align="center">{{ $loop->iteration }}</td>
					<td>{{ strtoupper($gaji->nama_pegawai) }}<div style="font-size: 14px;margin-top: 15px;">{{ $gaji->nip }}</div></td>
					<td align="center">{{ $gaji->jabatan}}</td>
					<td align="center">Rp. {{number_format($gaji->jumlah_gaji, 0, ',', '.')}}</td>
					<td class="tinggi @if($loop->iteration % 2 == 1) top-left @else top-right @endif">
						{{ $loop->iteration }}
					</td>
				</tr>
				@endforeach
			@endif
			<tr>
				<td colspan="6"></td>
			</tr>
			<tr>
				<td colspan="3" align="center">JUMLAH</td>
				<td>Rp. {{ number_format($totalGaji, 0, ',', '.') }}</td>
				<td></td>
			</tr>
        </tbody>
    </table>

    <div class="footer">
        <table class="no-border">
			<tr>
				<td colspan="2">Mengetahui, </td>
			</tr>
            <tr>
                <td class="center">Kepala Desa <br><br><br><br>___________________________<br><br>{{ $kepala_desa->nama_pegawai }}<div style="margin-top: 4px;">{{ $kepala_desa->nip }}</div></td>
                <td class="center">Kaur Keuangan <br><br><br><br>___________________________<br><br>{{ $kaur_keuangan->nama_pegawai }}<div style="margin-top: 4px;">{{ $kaur_keuangan->nip }}</div></td>
            </tr>
        </table>
        <p>Terima kasih</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
