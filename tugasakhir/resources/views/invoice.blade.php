@extends('partials.header')

<style type="text/css">
     .container-border{
        border: 1px solid #ccc;
        border-radius: 15px;  
        padding : 1%;
     }

     @media print {
        .page-title{display: none;}
        .title{display: none;}
        .footer{display: none;}
        .btn{display: none;}
        @page {
            size: A4;
        }
    }
</style>

<div class="container container-border">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><br>
    		</div><hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Invoice :</strong><br>
    					{{ $pelanggan->nama_pelanggan }}<br>
    					{{ $pelanggan->no_telepon }}<br>
    					{{ $pelanggan->alamat }}
    				</address>
    			</div>
                <div class="col-xs-6 text-right">
                    <address>
                        <h3>Order #{{ $transaksi->id_transaksi }}</h3>
                        <strong>Order Date:</strong><br>
                        {{ date('d-m-Y', strtotime($transaksi->created_at)) }}<br><br>
                    </address>
                </div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Harga Sewa (/hari)</th>
                                    <th class="text-center">Mulai Sewa</th>
                                    <th class="text-center">Akhir Sewa</th>
                                    <th class="text-center">Masa Sewa</th>
                                    <th class="text-center">Total Harga</th>
                                </tr>
    						</thead>
    						<tbody>
                                <?php $total_harga = 0;?>
    							@foreach($list_item as $item_transaksi)
    							<tr>
    								<td>{{ $item_transaksi->nama_alat }}</td>
    								<td class="text-center">{{ ke_rupiah($item_transaksi->harga_sewa) }}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($item_transaksi->mulai_sewa)) }}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($item_transaksi->akhir_sewa)) }}</td>
                                    <td class="text-center">
                                        <?php
                                            $mulai_sewa = new DateTime($item_transaksi->mulai_sewa);
                                            $akhir_sewa = new DateTime($item_transaksi->akhir_sewa);
                                            $lama_sewa = $mulai_sewa->diff($akhir_sewa)->d;
                                        ?>
                                        <b>{{ $lama_sewa }} Hari</b>
                                    </td>
    								<td class="text-right">{{ ke_rupiah($item_transaksi->harga_sewa * $lama_sewa) }}</td>
    							</tr>
                                <?php $total_harga += ($item_transaksi->harga_sewa  * $lama_sewa) ?>
                                @endforeach
    						</tbody>
                            <tfoot>
                                <tr>
                                    <td class="no-line text-right" colspan="5"><strong>Total</strong></td>
                                    <td class="no-line text-right"><?= ke_rupiah($total_harga) ?></td>
                                </tr>
                            </tfoot>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>

        <div class="col-md-12">
            <button type="button" class="btn btn-warning btn-print" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
</div>