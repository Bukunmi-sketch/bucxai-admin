<div>
    {{-- @extends('layouts.app') --}}

    @section('styles')

    @endsection

    {{-- @section('content') --}}

    <!-- PAGE-HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);"> Transaction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
        </ol><!-- End breadcrumb -->

    </div>
    <!-- END PAGE-HEADER -->

    <!-- ROW -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card overflow-hidden">
                <div class="card-body">
                    {{-- <div class="profile-bg h-250 cover-image" data-bs-image-src="{{asset('build/assets/images/photos/30.jpg')}}">
                </div> --}}
                <div class="py-4 position-relative">
                    {{-- <div class="profile-img">
                                                        <img src="{{asset('build/assets/images/users/male/24.jpg')}}" class="avatar avatar-xxl br-7" alt="person-image">
                </div> --}}
                <div class="mt-5 d-sm-flex align-items-center">
                    <div>
                        <h3 class="fw-semibold mb-1"> </h3>
                    </div>

                </div>

            </div>


            <div class="profile-section">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Transaction Details</h3>
                    </div>
                    <div class="card-body myTab">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="transaction-history-tab" data-bs-toggle="tab" href="#transaction-history" role="tab">Transaction Details</a>
                            </li>
                            <li class="nav-item  fw-bold">
                                <a class="nav-link " id="profile-info-tab" data-bs-toggle="tab" href="#profile-info" role="tab">User Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="bank-details-tab" data-bs-toggle="tab" href="#bank-details" role="tab">Security Info</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-3">
                            <!-- Profile Info Tab -->
                            <div class="tab-pane fade " id="profile-info" role="tabpanel">
                                @if($user)


                                <p><strong>NAME:</strong> {{ $user['first_name'] }} {{ $user['last_name'] }}</p>
        <p><strong>EMAIL:</strong> {{ $user['email'] }}</p>
        <p><strong>Phone:</strong> {{ $user['phone'] }}</p>
        <p><strong>Joined:</strong> {{ \Carbon\Carbon::parse($user['created_at'])->format('M d, Y') }}</p>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="bank-details" role="tabpanel">
                                @if($transaction)

                                <p><strong>Mac Address:</strong> {{ $transaction['mac_address'] }}</p>
                                <p><strong>IP Address:</strong> {{ ucfirst($transaction['ip_address']) }}</p>
                                <p><strong>Longitude:</strong> {{ ucfirst($transaction['longitude']) }}</p>
                                <p><strong>Latitude:</strong> {{ $transaction['latitude'] }}</p>
                                @endif
                            </div>

                        <!-- Transaction History Tab -->
                        <div class="tab-pane fade show active" id="transaction-history" role="tabpanel">
                            @if($transaction)

                            <p><strong>AMOUNT:</strong> {{ $transaction['amount'] }}</p>
                            <p><strong>STATUS:</strong> {{ ucfirst($transaction['status']) }}</p>
                            <p><strong>TRANSACTION TYPE:</strong> {{ ucfirst($transaction['trans_type']) }}</p>
                            <p><strong>DISCOUNT AMOUNT:</strong> ₦{{ $transaction['amount']-$transaction['discountAmount'] }}</p>
                            <p><strong>REFERENCE:</strong> {{ $transaction['trans_ref'] }}</p>
                            <p><strong>CREATED DATE:</strong> {{ \Carbon\Carbon::parse($transaction['created_at'])->format('M d, Y') }}</p>


                            <hr>

                            <!-- Button to trigger modal (optional) -->
                            {{-- <button class="btn btn-primary" wire:click="showModal">Show Details in Modal</button> --}}

                            <!-- Transaction Details Modal -->
                            {{-- <div wire:ignore.self class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="transactionModalLabel">Transaction Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Amount:</strong> {{ $transaction->amount }}</p>
                                            <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
                                            <p><strong>Transaction Type:</strong> {{ ucfirst($transaction->trans_type) }}</p>
                                            <p><strong>Reference:</strong> {{ $transaction->trans_ref }}</p>
                                            <p><strong>Created At:</strong> {{ $transaction->created_at }}</p>
                                            <!-- Add more details if needed -->
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            @else
                            <p>Transaction not found or no user data available.</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
</div>

</div>
<!-- END ROW -->

{{-- @endsection --}}

@section('scripts')

<!-- SELECT2 JS -->
<script src="{{asset('build/assets/plugins/select2/select2.full.min.js')}}"></script>
@vite('resources/assets/js/select2.js')

<!-- SELECT2 JS -->
<script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>

<!-- APEXCHART JS -->
<script src="{{ asset('build/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>

<!-- DATA TABLES JS -->
<script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

@endsection
</div>
