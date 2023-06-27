<div>
    <x-adminlte-input
        name="search"
        label="Search"
        placeholder="search"
        igroup-size="md"
        wire:model="search"
    >
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-search"></i>
            </div>
        </x-slot>
    </x-adminlte-input>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">No Batch</th>
                    <th scope="col">No Exp</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stocks as $stock)
                    <tr scope="row">
                        <td>{{ $stock->medicine->nama_obat }}</td>
                        <td>{{ $stock->no_batch }}</td>
                        <td>{{ $stock->no_exp }}</td>
                        <td>Rp. {{ number_format($stock->harga_jual) }}</td>
                        <td>{{ $stock->stok }}</td>
                        <td>
                            <span
                                @class([
                                    'badge',
                                    'badge-primary' => in_array($stock->status, ['Active']),
                                    'badge-warning' => in_array($stock->status, ['Almost Expired']),
                                    'badge-danger' => in_array($stock->status, ['Expired', 'Archived'])
                                ])
                            >
                                {{ $stock->status }}
                            </span>
                        </td>
                        <td>
                            @can('gudang')
                            @endcan
                            <button
                                class="btn btn-xs btn-default text-success mx-1"
                                title="Confirm"
                                data-toggle="modal"
                                data-target="#edit-modal"
                                wire:click="$emitTo('stocks.edit-modal', 'setStock', {{ $stock->id }})"
                            >
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            <button
                                class="btn btn-xs btn-default text-danger mx-1"
                                title="Delete"
                                data-toggle="modal"
                                data-target="#delete-modal"
                                wire:click="$emitTo('stocks.delete-modal', 'setStockId', {{ $stock->id }})"
                            >
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Records found ...</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $stocks->links() }}

    <livewire:stocks.edit-modal />

    <livewire:stocks.delete-modal />
</div>