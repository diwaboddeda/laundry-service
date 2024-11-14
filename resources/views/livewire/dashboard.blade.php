<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/sidebar')
        </div>
        <div class="col-md-9">
            <h2>Dashboard Page</h2>

            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5>Total Received:</h5>
                                </div>
                                <div class="col-md-4">
                                    <h1>{{$count_received}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5>Total Washed:</h5>
                                </div>
                                <div class="col-md-4">
                                    <h1>{{$count_washed}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5>Total Dried:</h5>
                                </div>
                                <div class="col-md-4">
                                    <h1>{{$count_dried}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5>Total Ironed:</h5>
                                </div>
                                <div class="col-md-4">
                                    <h1>{{$count_ironed}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5>Total Pending:</h5>
                                </div>
                                <div class="col-md-4">
                                    <h1>{{$count_waiting_payment}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5>Total Completed:</h5>
                                </div>
                                <div class="col-md-4">
                                    <h1>{{$count_completed}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                   <div class="card">
                       <div class="card-body">
                        <h5 class="card-title">Completed Transactions</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="10%" scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Total Payment</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Received Date</th>
                                    <th scope="col">Pickup Date</th>
                                </tr>
                            </thead>
                            <tbody>
    @foreach ($completed_transactions as $item)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->item->user->name }}</td> <!-- Translated 'barang' to 'item' -->
            <td>Rp. {{ number_format($item->total_payment) }}</td> <!-- Translated 'total_bayar' to 'total_payment' -->
            <td>{{ $item->service->name }}</td> <!-- Translated 'layanan' to 'service' -->
            <td>{{ \Carbon\Carbon::parse($item->received_date)->format('d m Y, H:i') }}</td> <!-- Translated 'tanggal_diterima' to 'received_date' -->
            <td>{{ \Carbon\Carbon::parse($item->pickup_date)->format('d m Y, H:i') }}</td> <!-- Translated 'tanggal_diambil' to 'pickup_date' -->
        </tr>
    @endforeach
</tbody>

                        </table>
                       </div>
                   </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Completed Transactions Chart</h5>
                            <div style="height: 32rem;">
                                <livewire:livewire-column-chart
                                    key="{{ $chart->reactiveKey() }}"
                                    :column-chart-model="$chart"
                                />
                             </div>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
