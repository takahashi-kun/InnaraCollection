<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice Innara Collection</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #000;
      font-size: 13px;
      margin: 40px;
      background-color: #fff;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #00b14f;
      padding-bottom: 10px;
      margin-bottom: 25px;
    }

    .header h1 {
      color: #00b14f;
      font-size: 22px;
      margin: 0;
      letter-spacing: 0.5px;
    }

    .invoice-info {
      text-align: right;
      font-size: 13px;
      line-height: 1.5;
    }

    .invoice-info strong {
      font-size: 15px;
    }

    .section {
      display: flex;
      justify-content: space-between;
      margin-bottom: 25px;
    }

    .col {
      width: 48%;
    }

    .col h3 {
      font-size: 14px;
      color: #333;
      margin-bottom: 6px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 4px;
    }

    .col p {
      margin: 3px 0;
      line-height: 1.4;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
    }

    th {
      background-color: #f3f3f3;
      text-align: left;
      padding: 8px;
      border: 1px solid #ddd;
    }

    td {
      padding: 8px;
      border: 1px solid #ddd;
      vertical-align: top;
    }

    .text-right {
      text-align: right;
    }

    .totals {
      width: 300px;
      float: right;
      margin-top: 10px;
    }

    .totals td {
      border: none;
      padding: 4px 0;
    }

    .totals tr:last-child td {
      border-top: 1px solid #000;
      font-weight: bold;
      padding-top: 8px;
    }

    .footer {
      margin-top: 50px;
      font-size: 11px;
      color: #555;
      border-top: 1px solid #ccc;
      padding-top: 8px;
    }

    .footer p {
      margin: 2px 0;
    }

    .no-print {
      text-align: center;
      margin-top: 30px;
    }

    .btn-print {
      background-color: #00b14f;
      color: white;
      padding: 8px 18px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-print:hover {
      background-color: #019a44;
    }

    @media print {
      .no-print { display: none; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <h1>INNARA COLLECTION</h1>
    <div class="invoice-info">
      <strong>INVOICE</strong><br>
      No: INV/2025/11/03/001<br>
      Tanggal: 03 November 2025
    </div>
  </div>

  <!-- Info Section -->
  <div class="section">
    <div class="col">
      <h3>Diterbitkan Atas Nama</h3>
      <p><strong>Perusahaan:</strong> Innara Collection</p>
      <p><strong>Email:</strong> innara.collection@gmail.com</p>
      <p><strong>Alamat:</strong> Jl. Melati Raya No. 12, Cimahi, Jawa Barat</p>
    </div>

    <div class="col">
      <h3>Untuk</h3>
      <p><strong>Nama:</strong> Rimuru Tempest</p>
      <p><strong>Periode:</strong> 01 - 30 Oktober 2025</p>
      <p><strong>Tanggal Pembayaran:</strong> 03 November 2025</p>
    </div>
  </div>

  <!-- Tabel Produk -->
  <table>
    <thead>
      <tr>
        <th>Deskripsi</th>
        <th class="text-right">Jumlah</th>
        <th class="text-right">Harga Satuan</th>
        <th class="text-right">Total Harga</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Gaji Pokok Bulanan</td>
        <td class="text-right">1</td>
        <td class="text-right">Rp 3.900.000</td>
        <td class="text-right">Rp 3.900.000</td>
      </tr>
    </tbody>
  </table>

  <!-- Total -->
  <table class="totals">
    <tr>
      <td>Subtotal</td>
      <td class="text-right">Rp 3.900.000</td>
    </tr>
    <tr>
      <td>Potongan</td>
      <td class="text-right">Rp 0</td>
    </tr>
    <tr>
      <td><strong>Total Dibayar</strong></td>
      <td class="text-right"><strong>Rp 3.900.000</strong></td>
    </tr>
  </table>

  <div style="clear: both;"></div>

  <!-- Footer -->
  <div class="footer">
    <p>Invoice ini sah dan diproses secara otomatis oleh sistem komputer.</p>
    <p>Silakan hubungi Innara Collection Care apabila memerlukan bantuan.</p>
    <p>Terakhir diperbarui: 03 November 2025 23:12 WIB</p>
  </div>

  <div class="no-print">
    <button class="btn-print" onclick="window.print()">Cetak Invoice</button>
  </div>

</body>
</html>