<div>
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol><!-- End breadcrumb -->

    </div>
    <!-- END PAGE HEADER -->

    <!-- ROW -->
    <div class="row">
        {{-- <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header custom-header d-flex justify-content-between align-items-center border-bottom">
                    <h3 class="card-title">Revenue Analytics</h3>
                    <div class="dropdown">
                        <a href="javascript:void(0);"
                            class="d-flex align-items-center bg-primary btn btn-sm mx-1 fw-semibold"
                            data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Sort by:
                            Weekly<i class="fe fe-chevron-down fw-semibold mx-1"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" role="menu" data-popper-placement="bottom-end">
                            <li><a href="javascript:void(0);">Monthly</a></li>
                            <li><a href="javascript:void(0);">Yearly</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex ms-5">
                        <div>
                            <p class="mb-0 fs-15 text-muted">
                                This month
                            </p>
                            <span class="text-primary fs-20 fw-semibold"><i
                                    class="fe fe-dollar-sign fs-13"></i>815,320</span>
                        </div>
                        <div class="ms-5">
                            <p class="mb-0 fs-15 text-muted">
                                Last month
                            </p>
                            <span class="fs-20 text-secondary fw-semibold"><i
                                    class="fe fe-dollar-sign fs-13"></i>743,950</span>
                        </div>
                    </div>
                    <div id="revenue_chart">
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12"> --}}
        {{-- <div class="row row-sm"> --}}

        <div class="d-flex flex-wrap">
            <div class="col-md-4 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <div class="mb-0 fw-semibold text-dark">Total Users</div>
                                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($totalUsers) }}</h3>
                            </div>
                            {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <div class="mb-0 fw-semibold text-dark">Verified Users (BVN) </div>
                                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($totalUsersWithBVN) }}</h3>
                            </div>
                            {{-- <i class="ri-thumb-up-line ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <div class="mb-0 fw-semibold text-dark">BVN Cost </div>
                                <h3 class="mt-1 mb-1 text-dark fw-semibold">₦{{ number_format($totalUsersWithBVN * 10) }}</h3>
                            </div>
                            {{-- <i class="ri-thumb-up-line ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <div class="mb-0 fw-semibold text-dark">Total Agents</div>
                                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($totalAgents) }}</h3>
                            </div>
                            {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <div class="mb-0 fw-semibold text-dark">Agent Revenue </div>
                                <h3 class="mt-1 mb-1 text-dark fw-semibold">₦{{ number_format($totalAgents * 10000) }}</h3>
                            </div>
                            {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <div class="mb-0 fw-semibold text-dark">Total Admins</div>
                                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ $totalAdmins }}</h3>
                            </div>
                            <i
                                class="ri-team-line ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-4 mb-4">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <div class="mb-0 fw-semibold text-dark">Total Transaction</div>
                                        <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ $totalTransactions }}</h3>
        </div>
        <i
            class="fe fe-debit-card ms-auto fs-5 my-auto bg-danger-transparent p-3 br-7 text-danger"></i>
    </div>
</div>
</div>
</div> --}}

</div>
</div>
<!-- END ROW -->

<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <!-- breadcrumb -->
        {{-- <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li> --}}
        <li class="breadcrumb-item active" aria-current="page">Transactions</li>
    </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div class="row">




    <div class="d-flex flex-wrap">

        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Total Amount Funded </div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($totalFundWallet) }}</h3>
                        </div>
                        {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Approved Transactions</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($approvedTransactions) }}</h3>
                        </div>
                        {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Pending Transactions</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($pendingTransactions) }}</h3>
                        </div>
                        {{-- <i class="ri-thumb-up-line ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>
        {{--
            <div class="col-md-4 mb-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <div class="mb-0 fw-semibold text-dark">Failed Transactions</div>
                                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($failedTransactions) }}</h3>
    </div>

</div>
</div>
</div>
</div> --}}


</div>
</div>
<!-- END ROW -->






<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <!-- breadcrumb -->
        {{-- <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li> --}}
        <li class="breadcrumb-item active" aria-current="page">Wallet</li>
    </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div class="row">


    <div class="d-flex flex-wrap">
        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Total Wallet Balance</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">₦{{ number_format($totalWalletBalance) }}</h3>
                        </div>
                        {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Total Agent Wallet Balance</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold"> ₦{{ number_format($totalWalletBalanceForAgents) }}</h3>
                        </div>
                        {{-- <i class="ri-thumb-up-line ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Total Amount Withdraw</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">₦{{ number_format($totalAmountWithdrew) }}</h3>
                        </div>
                        {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- END ROW -->


<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <!-- breadcrumb -->
        {{-- <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li> --}}
        <li class="breadcrumb-item active" aria-current="page">Sales Insights</li>
    </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div class="row">


    <div class="d-flex flex-wrap">

        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Data Topup</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($dataTopup) }}</h3>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">₦{{ number_format($dataTopupValue) }}</h3>
                        </div>
                        {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Buy Airtime</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($buyAirtime) }}</h3>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">₦{{ number_format($buyAirtimeValue) }}</h3>
                        </div>
                        {{-- <i class="ri-thumb-up-line ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Bill Payments</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($billPayment) }}</h3>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">₦{{ number_format($billPaymentValue) }}</h3>
                        </div>
                        {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
<!-- END ROW -->

<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
    <ol class="breadcrumb mb-sm-0 mb-3">
        <!-- breadcrumb -->
        {{-- <li class="breadcrumb-item"><a href="{{ url('admin.dashboard') }}">Home</a></li> --}}
        <li class="breadcrumb-item active" aria-current="page">Daily Sales</li>
    </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div class="row">


    <div class="d-flex flex-wrap">
        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Today Sales Count</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ number_format($todayTotalSales) }}</h3>
                        </div>
                        {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">Today Sales Amount</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">₦{{ number_format($todaySales, 2) }}</h3>
                        </div>
                        {{-- <i class="ri-thumb-up-line ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END ROW -->






<!-- ROW -->
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Recent Transactions</h3>
                {{-- <a href="javascript:void(0);" class="fw-semibold btn btn-sm btn-primary"><i
                            class="fe fe-file-text"></i> Download Report
                    </a> --}}
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <input type="text" wire:model="search" class="form-control w-25" placeholder="Search...">
                </div>
                <div class="table-responsive">
                    <table id="data-table3" class="table table-bordered text-nowrap mb-0">
                        <thead class="text-dark">
                            <tr>

                                <th class="fw-semibold">#</th>
                                <th class="fw-semibold">Transaction-ID</th>
                                <th class="fw-semibold">Fullname</th>
                                {{-- <th class="fw-semibold">Product</th> --}}
                                <th class="fw-semibold">Sub Product</th>
                                <th class="fw-semibold">Beneficiary</th>
                                <th class="fw-semibold">Channel</th>
                                {{-- <th class="fw-semibold">Amount</th> --}}
                                <th class="fw-semibold">Discount Amount</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold">Date Created</th>
                                <th class="fw-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactionsLists as $transactionsList)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>

                                <td>
                                    <h6 class="mb-0 fw-semibold text-primary">{{ $transactionsList->trans_ref }}</h6>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 fs-14 fw-semibold text-dark">{{ ucfirst($transactionsList?->user_name) }}</h6>
                                    </div>
                                </td>
                                {{-- <td class="fw-semibold text-muted-dark">{{ $transactionsList->product_name }}</td> --}}
                                <td class="fw-semibold text-dark">
                                    {{-- {{ $transactionsList->sub_product_name }} --}}
                                    @if($transactionsList->trans_type == "fund_wallet"  )
                                    <span>ACCT : {{$transactionsList->cr_acc}}</span>
                                   @else
                                   <span>{{ $transactionsList->sub_product_name }}</span>
                                   @endif
                                </td>
                                <td class="fw-semibold text-dark">
                                    @if($transactionsList->trans_type == "airtime" || $transactionsList->trans_type == "mobile_data" || $transactionsList->trans_type == "withdrawal" )
                                     <span>{{$transactionsList->cr_acc}}</span>
                                    @elseif($transactionsList->trans_type == "fund_wallet")
                                    <span>{{$transactionsList->cr_acc}}</span>
                                    @else
                                    <span></span>
                                    @endif
                                </td>
                                <td class="fw-semibold text-muted-dark">
                                    @if($transactionsList->trans_type == "fund_wallet"  )
                                    <span>{{$transactionsList->channel}}</span>
                                   @else
                                   <span>{{ $transactionsList->trx_from }}</span>
                                   @endif
                                </td>
                                {{-- <td class="text-dark fw-semibold">{{ number_format($transactionsList->amount, 2) }}</td> --}}
                                <td class="text-dark fw-semibold">{{ number_format($transactionsList->amount-$transactionsList->discountAmount, 2) }}</td>

                                {{-- <td><span class="badge bg-primary-transparent text-primary">Available</span> --}}
                                <td>
                                    @if($transactionsList->status == 'pending')
                                    <span class="badge bg-warning text-dark" style="padding: 0.2rem 0.5rem;">Pending</span>
                                    @elseif($transactionsList->status == 'success')
                                    <span class="badge bg-success text-white" style="padding: 0.2rem 0.5rem;">Successful</span>
                                    @elseif($transactionsList->status == 'failed')
                                    <span class="badge bg-danger text-white" style="padding: 0.2rem 0.5rem;">Failed</span>
                                    @elseif($transactionsList->status == 'processing')
                                    <span class="badge bg-danger text-white" style="padding: 0.2rem 0.5rem;">Failed</span>
                                    @else
                                    <span class="badge bg-secondary text-white">Unknown</span>
                                    @endif
                                </td>
                                <td class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($transactionsList->created_at)->format('d M Y, H:i') }}</td>
                                <td>
                                    <div class="btn-group mt-2 mb-2">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="dropdown-header">
                                                <strong>Options</strong>
                                                <b class="fa fa-angle-up float-end" aria-hidden="true"></b>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.view-transaction', ['id' => $transactionsList->id]) }}"> View </a>
                                            </li>
                                            <li>

                                                @if($transactionsList->status == 'pending')
                                                <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#confirmDeclineModal-{{ $transactionsList->id }}"> Decline</button>

                                                <button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#confirmApprovalModal-{{ $transactionsList->id }}"">  Approve </button>
                                        @endif
                                                </li>

                                            </ul>
                                        </div>

                                          <!-- Confirmation Modal for Deactivation -->
                                          <div class=" modal fade" id="confirmDeclineModal-{{ $transactionsList->id }}" tabindex="-1" aria-labelledby="confirmDeclineMdalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm Declination</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to decline this transaction <strong>{{ ucfirst($transactionsList->product_name) }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" data-bs-dismiss="modal" type="button" wire:click="toggleStatus('decline', {{ $transactionsList->id }})" class="btn btn-danger">Yes, Decline</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </div>

                                    <!-- Confirmation Modal for activation -->
                                    <div class="modal fade" id="confirmApprovalModal-{{ $transactionsList->id }}" tabindex="-1" aria-labelledby="confirmApprovalModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm UnBan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to approve this transaction <strong>{{ ucfirst($transactionsList->product_name) }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" type="button" data-bs-dismiss="modal" wire:click="toggleStatus('approve',{{ $transactionsList->id }})" class="btn btn-success">Yes, approve</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- ROW -->
<div class="row">
    <div class="col-sm-12 col-md-6 ">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><b>Successful Monthly Transactions</b></div>
            </div>
            <div class="card-body">
                <div>
                    {{-- <canvas id="chartBar1" class="h-300"></canvas> --}}
                    <canvas id="monthlySuccessChart" class="h-300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Successful Monthly Transactions</div>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="pieSuccessfulTransactions" class="h-300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ROW -->



<!-- ROW -->
<div class="row">

    <!-- col-6 -->
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Total Network Sold Per Plan Stat</div>
            </div>
            <div class="card-body">
                <div class="chartjs-wrapper-demo">
                    <canvas id="countData" class="h-300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- col-6 -->

    <!-- col-6 -->
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Total Data Sold Per Plan Stat</div>
            </div>
            <div class="card-body">
                <div class="chartjs-wrapper-demo">
                    <canvas id="transactionsChart" class="h-300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- col-6 -->
</div>
<!-- END ROW -->


<!-- ROW -->
<div class="row">

    <!-- col-6 -->
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Total Airtime Sold Per Plan Stat</div>
            </div>
            <div class="card-body">
                <div class="chartjs-wrapper-demo">
                    <canvas id="countairtime" class="h-300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- col-6 -->

    <!-- col-6 -->
    {{-- <div class="col-sm-12 col-md-6">
       <div class="card">
           <div class="card-header">
               <div class="card-title">Total Data Sold Per Plan Stat</div>
           </div>
           <div class="card-body">
               <div class="chartjs-wrapper-demo">
                  <canvas id="transactionsChart" class="h-300"></canvas>
               </div>
           </div>
       </div>
   </div> --}}
    <!-- col-6 -->
</div>
<!-- END ROW -->


<!-- ROW -->
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Today's Withdrawals</div>
            </div>
            <div class="card-body">
                <div>
                    <canvas id="dailyTransactionChart" class="h-300"></canvas>
                    {{-- <pre>{{ json_encode($transactionData, JSON_PRETTY_PRINT) }}</pre> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- col-6 -->
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Daily Fund Wallet</div>
            </div>
            <div class="card-body">
                <div class="chartjs-wrapper-demo">
                    <canvas id="dailyFundWalletChart" class="h-300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- col-6 -->
</div>
<!-- END ROW -->






@section('scripts')
<!-- SELECT2 JS -->
<script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>

<!-- APEXCHART JS -->
<script src="{{ asset('build/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>



<script src="{{asset('build/assets/plugins/chart/chart.bundle.js')}}"></script>
<script src="{{asset('build/assets/plugins/chart/utils.js')}}"></script>

{{-- @vite('resources/assets/js/chart.js') --}}
<!-- CUSTOM-CHARTS JS -->
{{-- @vite('resources/assets/js/dashboardChart.js') --}}

<script>
    document.addEventListener('livewire:load', function() {



        const ctx = document.getElementById('monthlySuccessChart').getContext('2d');

        // Data from Livewire
        const labels = @json(array_keys($monthlySuccessfulTransactions)).map(month => {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            return months[month - 1]; // Convert month number to month name
        });

        const data = @json(array_values($monthlySuccessfulTransactions));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Successful Transactions',
                    data: data,
                    // backgroundColor: 'rgba(70, 127, 207, 0.5)'
                    backgroundColor: ['#e24934', '#ec82ef', '#3ec7e8', '#ffca4a', '#867efc', '#1cc8e3', '#f39c12', '#27ae60', '#e74c3c', '#8e44ad', '#2ecc71', '#3498db']
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                barPercentage: 0.5,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            display: true
                        }
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            beginAtZero: true,
                            fontSize: 10,
                            fontColor: "rgba(180, 183, 197, 0.4)",
                        },
                        title: {
                            display: false,
                            text: 'Successful Transactions',
                        },
                        grid: {
                            display: true,
                            color: 'rgba(180, 183, 197, 0.4)																																					',
                            drawBorder: false,
                        },
                    },
                    y: {
                        ticks: {
                            beginAtZero: true,
                            fontSize: 10,
                            fontColor: "rgba(180, 183, 197, 0.4)",
                            stepSize: 10,
                            min: 0,
                            max: 80
                        },
                        title: {
                            display: false,
                            text: 'Successful Transactions',
                        },
                        grid: {
                            display: true,
                            color: 'rgba(180, 183, 197, 0.4)',
                            drawBorder: false,
                        },
                    }
                },
            }
        });



    });
</script>

<script>
    document.addEventListener('livewire:load', function() {

        // Assuming monthlySuccessfulTransactions is passed from the backend as JSON
        // var monthlySuccessfulTransactions = JSON.parse('{{ json_encode($monthlySuccessfulTransactions) }}');


        // // Map backend data to labels (e.g., 'Jan', 'Feb', 'Mar'...)
        // var labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        // var transactionData = labels.map((label, index) => monthlySuccessfulTransactions[index + 1] || 0);


        // Data from Livewire
        const labels = @json(array_keys($monthlySuccessfulTransactions)).map(month => {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            return months[month - 1]; // Convert month number to month name
        });

        const data = @json(array_values($monthlySuccessfulTransactions));

        var datapie = {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#e24934', '#ec82ef', '#3ec7e8', '#ffca4a', '#867efc', '#1cc8e3', '#f39c12', '#27ae60', '#e74c3c', '#8e44ad', '#2ecc71', '#3498db']
            }]
        };

        var optionpie = {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        display: true
                    }
                },
                tooltip: {
                    enabled: true
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        // Render the chart
        var ctx6 = document.getElementById('pieSuccessfulTransactions');
        var myPieChart6 = new Chart(ctx6, {
            type: 'doughnut',
            data: datapie,
            options: optionpie
        });

    });
</script>
<script>
    document.addEventListener('livewire:load', function() {
        const ctx = document.getElementById('dailyTransactionChart').getContext('2d');

        // Data from Livewire
        const labels = @json(array_keys($transactionData)); // Status labels (e.g., pending, success, etc.)
        const data = @json(array_values($transactionData)); // Corresponding counts for today

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels.map(status => status.charAt(0).toUpperCase() + status.slice(1)), // Capitalize status labels
                datasets: [{
                    label: 'Today\'s Withdrawals',
                    data: data,
                    backgroundColor: [
                        '#f39c12', // Pending
                        '#27ae60', // Success
                        '#e67e22', // Cancelled
                        '#3498db', // Reversed
                        '#e74c3c', // Failed
                        '#8e44ad' // Processing
                    ].slice(0, data.length), // Ensure colors match data length
                    // barPercentage: 0.5, // Set bar thickness
                    barPercentage: 0.8, // Set bar thickness relative to category width
                    categoryPercentage: 0.8, // Adjust spacing between bars
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: "rgba(180, 183, 197, 0.6)", // Label color
                        },
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            beginAtZero: true,
                            color: "rgba(180, 183, 197, 0.6)",
                            callback: function(value, index) {
                                return labels[index]; // Display the corresponding label
                            },
                        },
                        title: {
                            display: false,
                        },
                        grid: {
                            display: true,
                            color: 'rgba(180, 183, 197, 0.4)',
                            drawBorder: false,
                        },
                    },
                    y: {
                        ticks: {
                            beginAtZero: true,
                            color: "rgba(180, 183, 197, 0.6)",
                            // stepSize: 5,
                            stepSize: 1, // Force y-axis to use whole numbers
                            min: 0,
                        },
                        title: {
                            display: false,
                        },
                        grid: {
                            display: true,
                            color: 'rgba(180, 183, 197, 0.4)',
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    });
</script>


<script>
    document.addEventListener('livewire:load', function() {
        const ctx = document.getElementById('dailyFundWalletChart').getContext('2d');

        // Data from Livewire
        const fundWalletData = @json($dailyFundWallet); // Decoded JSON
        const labels = Object.keys(fundWalletData); // Extract channels (keys)
        const data = Object.values(fundWalletData); // Extract counts (values)

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Channels (e.g., Squad, Monnify)
                datasets: [{
                    label: 'Wallet Funding Today',
                    data: data,
                    backgroundColor: [
                        '#3498db', // Squad
                        '#27ae60', // Monnify
                    ],
                    barPercentage: 0.5, // Adjust bar thickness
                    categoryPercentage: 0.8, // Adjust spacing between bars
                }],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: "rgba(180, 183, 197, 0.6)",
                        },
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            beginAtZero: true,
                            color: "rgba(180, 183, 197, 0.6)",
                        },
                        grid: {
                            display: true,
                            color: 'rgba(180, 183, 197, 0.4)',
                            drawBorder: false,
                        },
                    },
                    y: {
                        ticks: {
                            beginAtZero: true,
                            color: "rgba(180, 183, 197, 0.6)",
                            stepSize: 1, // Use whole numbers for y-axis
                        },
                        grid: {
                            display: true,
                            color: 'rgba(180, 183, 197, 0.4)',
                            drawBorder: false,
                        },
                    },
                },
            },
        });
    });
</script>

<script>
    document.addEventListener('livewire:load', () => {
        const chartData = @json($chartData);

        const ctx = document.getElementById('transactionsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(chartData),
                datasets: [{
                    label: 'Transactions by Type',
                    data: Object.values(chartData),
                    backgroundColor: ['#4CAF50', '#2196F3', '#FFC107', '#E91E63'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    });
</script>


<script>
    document.addEventListener('livewire:load', () => {
        // Access chart data passed from PHP
        const countdata = @json($dataCounts);

        // Initialize Chart.js

        const ctx = document.getElementById('countData').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Chart type (bar chart in this case)
            data: {
                labels: Object.keys(countdata), // X-axis labels (e.g., MTN, Airtel, etc.)
                datasets: [{
                    label: 'Transactions by Type', // Dataset label
                    data: Object.values(countdata), // Y-axis data
                    backgroundColor: ['#4CAF50', '#2196F3', '#FFC107', '#E91E63'], // Bar colors
                }]
            },
            options: {
                responsive: true, // Make the chart responsive
                plugins: {
                    legend: {
                        display: true
                    }, // Show the legend
                    tooltip: {
                        enabled: true
                    } // Enable tooltips
                },
                scales: {
                    y: {
                        beginAtZero: true, // Start the y-axis at 0
                    },
                },
            }
        });
    });
</script>


<script>
    document.addEventListener('livewire:load', () => {
        // Access chart data passed from PHP
        const countairtime = @json($airtimeCounts);

        // Initialize Chart.js

        const ctx = document.getElementById('countairtime').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // Chart type (bar chart in this case)
            data: {
                labels: Object.keys(countairtime), // X-axis labels (e.g., MTN, Airtel, etc.)
                datasets: [{
                    label: 'Transactions by Type', // Dataset label
                    data: Object.values(countairtime), // Y-axis data
                    backgroundColor: ['#FFC107', '#e24934', '#4CAF50', '#E91E63'], // Bar colors
                }]
            },
            options: {
                responsive: true, // Make the chart responsive
                plugins: {
                    legend: {
                        display: true
                    }, // Show the legend
                    tooltip: {
                        enabled: true
                    } // Enable tooltips
                },
                scales: {
                    y: {
                        beginAtZero: true, // Start the y-axis at 0
                    },
                },
            }
        });
    });
</script>




<!-- DATA TABLES JS -->
{{-- <script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script> --}}

<!-- INDEX JS -->
@vite('resources/assets/js/index3.js')
@endsection
</div>
