<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Invoce_{{ $tanggal }}_{{ $no_faktur }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css" media="screen">
            html {
                font-family: sans-serif;
                line-height: 1.15;
                margin: 0;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
            }

            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }

            strong {
                font-weight: bolder;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            table {
                border-collapse: collapse;
            }

            th {
                text-align: inherit;
            }

            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h4, .h4 {
                font-size: 1.5rem;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
            }

            .table.table-items td {
                border-top: 1px solid #dee2e6;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }

            .mt-5 {
                margin-top: 3rem !important;
            }

            .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }

            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }

            .text-right {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }
            * {
                font-family: "DejaVu Sans";
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .border-0 {
                border: none !important;
            }
            .cool-gray {
                color: #6B7280;
            }
        </style>
    </head>

    <body>
        {{-- Header --}}
        <h1>Apotek Berkah</h1>

        <table class="table mt-5">
            <tbody>
                <tr>
                    <td class="border-0 pl-0" width="70%">
                        <h4 class="text-uppercase">
                            <strong>Invoice</strong>
                        </h4>
                    </td>
                    <td class="border-0 pl-0">
                        <p>No Faktur: <strong>#{{ $no_faktur }}</strong></p>
                        <p>Tanggal: <strong>{{ $tanggal }}</strong></p>
                    </td>
                </tr>
            </tbody>
        </table>

        @if($tipe == 'Resep')
            {{-- Seller - Buyer --}}
            <table class="table">
                <thead>
                    <tr>
                        <th class="border-0 pl-0 party-header">
                            {{ Buyer }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-0">
                            @if($nama_pelanggan)
                                <p class="buyer-name">
                                    <strong>{{ $nama_pelanggan }}</strong>
                                </p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif

        {{-- Table --}}
        <table class="table table-items">
            <thead>
                <tr>
                    <th scope="col" class="border-0 pl-0">Nama Obat</th>
                    <th scope="col" class="text-center border-0">Kuantitas</th>
                    <th scope="col" class="text-right border-0">No Batch</th>
                    <th scope="col" class="text-right border-0">No Exp</th>
                    <th scope="col" class="text-right border-0">Sub total</th>
                </tr>
            </thead>
            <tbody>
                {{-- Items --}}
                @foreach($order_list as $index => $item)
                <tr>
                    <td class="pl-0">
                        {{ $item['medicine']['medicine']['nama_obat'] }}
                    </td>
                    <td class="text-center">{{ $item['kuantitas'] }}</td>
                    <td class="text-right">{{ $item['medicine']['no_batch'] }}</td>
                    <td class="text-right">{{ $item['medicine']['no_exp'] }}</td>
                    <td class="text-right">
                        Rp. {{ number_format($item['total']) }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="border-0"></td>
                    <td class="text-right pl-0">Grand Total</td>
                    <td class="text-right pr-0 total-amount">
                        Rp. {{ number_format($jumlah) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>