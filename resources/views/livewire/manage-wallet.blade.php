<div>
    {{-- @section('styles')

    @endsection

    @section('content') --}}
     <!-- PAGE HEADER -->
     <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);">Manage</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$pageTitle ?? null }}</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">

                <div class="card-body myTab">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item fw-bold">
                            <a class="nav-link {{ $activeTab === 'Monnify' ? 'active' : '' }}" wire:click.prevent="switchTab('Monnify')" href="#">
                                Monnify Fund Wallet
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab === 'Squad' ? 'active' : '' }}" wire:click.prevent="switchTab('Squad')" href="#">
                                Squad Fund Wallet
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab === 'withdrawal' ? 'active' : '' }}" wire:click.prevent="switchTab('withdrawal')" href="#">
                                Withdraw
                            </a>
                        </li>
                    </ul>
                </div>





                <div class="card-body">

                      <!-- Search, Filters, and Rows Per Page Selector -->
                 <div class="d-flex justify-content-between mb-3">
                    <!-- Search input -->


                    <!-- Rows per page selector -->
                    <select wire:model="perPage" class="form-control w-25">
                        <option value="5">Show 5 rows</option>
                        <option value="10">Show 10 rows</option>
                        <option value="25">Show 25 rows</option>
                        <option value="50">Show 50 rows</option>
                        <option value="100">Show 100 rows</option>
                        <option value="200">Show 200 rows</option>
                        <option value="500">Show 500 rows</option>
                    </select>

                    <div class="page-options mr-2">
                        <select class="form-control select2 w-auto" wire:model="sortOrder">
                            <option value="desc">Latest</option>
                            <option value="asc">Oldest</option>
                        </select>
                    </div>

                    <input type="text" wire:model="search" class="form-control w-25" placeholder="Search...">

                    <!-- Status filter dropdown -->
                    {{-- <select wire:model="status" class="form-control w-25">
                        <option value="">All Statuses</option>
                        @foreach ($statuses as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                        @endforeach
                    </select> --}}
                </div>

                    <div class="table-responsive">
                        <table id="data-table3" class="table table-bordered text-nowrap mb-0">
                            <thead class="text-dark">
                                <tr>
                                    <th class="fw-semibold">#</th>
                                    <th class="fw-semibold">Transaction-ID</th>
                                    {{-- <th class="fw-semibold">UserID</th> --}}
                                    <th class="fw-semibold">Fullname</th>
                                    <th class="fw-semibold">Beneficiary</th>
                                    <th class="fw-semibold">From</th>
                                    <th class="fw-semibold">Payment Type</th>
                                    <th class="fw-semibold">Channel</th>
                                    <th class="fw-semibold">Amount</th>
                                    <th class="fw-semibold">Status</th>
                                    <th class="fw-semibold">Date Created</th>
                                    <th class="fw-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contents as $count => $content)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <h6 class="mb-0 fw-semibold text-primary">{{ $content->trans_ref }}</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 fs-14 fw-semibold text-dark">{{ ucfirst($content?->user_name) }}</h6>
                                        </div>
                                    </td>
                                     <td class="fw-semibold text-muted-dark">{{ $content->cr_acc }}</td>

                                        <td class="fw-semibold text-muted-dark">{{ $content->trx_from }}</td>
                                        <td class="fw-semibold text-muted-dark">{{ $content->payment_type == 'bank_deposit' ? "Bank Deposit" : $content->payment_type }}</td>
                                        <td class="fw-semibold text-muted-dark">{{ $content->channel }}</td>
                                    <td class="text-dark fw-semibold">{{ number_format($content->amount, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $content->status === 'success' ? 'bg-success' : ($content->status === 'pending' || $content->status === 'processing' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ ucfirst($content->status == "success" ? 'approved' : $content->status) }}
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($content->created_at)->format('d M Y, H:i') }}</td>
                                    <td>

                                        {{-- <button type="button" class="btn btn-sm bg-info-transparent"> <a href="{{ route('admin.view-transaction', ['id' => $content->id]) }}"> View </a></button> --}}




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
                                                    <a href="{{ route('admin.view-transaction', ['id' => $content->id]) }}"> View </a>
                                                </li>
                                                <li>

                                        @if($content->status == 'pending' || $content->status == 'processing')
                                        <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#confirmDeclineModal-{{ $content->id }}"> Decline</button>

                                        <button  type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#confirmApprovalModal-{{ $content->id }}"">  Approve </button>
                                        @endif
                                                </li>

                                            </ul>
                                        </div>

                                          <!-- Confirmation Modal for Deactivation -->
                                          <div class="modal fade" id="confirmDeclineModal-{{ $content->id }}" tabindex="-1" aria-labelledby="confirmDeclineMdalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm Declination</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to decline this transaction <strong>{{ ucfirst($content->trans_ref) }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" data-bs-dismiss="modal" type="button"   wire:click="toggleStatus('decline', {{ $content->id }})" class="btn btn-danger">Yes, Decline</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                          <!-- Confirmation Modal for activation -->
                                          <div class="modal fade" id="confirmApprovalModal-{{ $content->id }}" tabindex="-1" aria-labelledby="confirmApprovalModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm UnBan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to approve  this transaction <strong>{{ ucfirst($content->trans_ref) }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" type="button" data-bs-dismiss="modal"   wire:click="toggleStatus('approve',{{ $content->id }})" class="btn btn-success">Yes, approve</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{ $contents->links() }}
                    </div>
                </div>

                @if (session()->has('statusUpdated'))
                <div class="alert alert-success">
                    {{ session('statusUpdated') }}
                </div>
            @endif
            </div>
        </div>
    </div>


    @section('scripts')
    <!-- SELECT2 JS -->
    {{-- <script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- APEXCHART JS -->
    <script src="{{ asset('build/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>

    <!-- DATA TABLES JS -->
    <script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

    <!-- INDEX JS -->
    @vite('resources/assets/js/index3.js')
    @vite('resources/assets/js/select2.js') --}}

    @endsection

    </div>
