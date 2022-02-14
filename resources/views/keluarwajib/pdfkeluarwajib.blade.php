<style>
    #table {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    #table td, #table th {
      border: 1px solid #000000;
      padding: 8px;
    }
    
    #table tr:nth-child(even){background-color: #f2f2f2;}
    
    #table tr:hover {background-color: #ddd;}
    
    #table th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #00BFFF;
      color: white;
    }
    </style>
<h1>Laporan Pengeluaran Kewajiban Amoora </h1>
<table id="table" class="table" ref="content">
    <tr>
         <th>Tanggal Pengeluaran</th>
         <th>Keterangan Pengeluaran</th>
         <th>Nominal</th>
    </tr>
    
       @foreach ($data_pengeluarankewajiban as $kewajiban)
        <tr>
            <td>{{$kewajiban->tgl_pengeluaran}}</td>
            <td>{{$kewajiban->ket_pengeluaran}}</td>
            <td>@currency($kewajiban->jml_pengeluaran)</td>
        </tr>
      @endforeach
  </table> 