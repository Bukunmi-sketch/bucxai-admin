<div>
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);">Manage</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$pageTitle ?? null }}</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <!-- Optionally, you can add more controls here -->
            </div>
        </div>
    </div>



<div class="card">
<div class="card-header">
    {{-- <h3>FILTER TRANSACTION BY PAYMENT METHOD</h3> --}}
    <form wire:submit.prevent="searchBasedOnQuery">
        <div class="row align-items-end">
            <!-- Product Selection -->
            <div class="col-md-3">
                <label class="form-label">Wallet Type</label>
                <select id="channel_type" class="form-control form-select" wire:model.defer="channel_type">
                    <option value=""> select wallet type </option>
                    <option value="monnify">Monnify</option>
                    <option value="squad">Squad</option>
                    <option value="withdrawal">Withdrawal</option>
                </select>
                @error('channel_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Transaction Status -->
            <div class="col-md-3">
                <label class="form-label">Transaction Status:</label>
                <select class="form-control form-select" wire:model.defer="status">
                    <option value=""> Select Status</option>
                    <option value="success">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="declined">Declined</option>
                    <option value="failed">Failed</option>
                </select>
                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Date From -->
            <div class="col-md-3">
                <label class="form-label">Date From:</label>
                <input type="date" class="form-control" wire:model.defer="date_from">
                @error('date_from') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Date To -->
            <div class="col-md-3">
                <label class="form-label">Date To:</label>
                <input type="date" class="form-control"  wire:model.defer="date_to">
                @error('date_to') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Search Button -->
            <div class="col-md-12 text-end mt-3">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
</div>
</div>

<div class="row">


    <div class="d-flex flex-wrap">
        <div class="col-md-4 mb-4">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <div class="mb-0 fw-semibold text-dark">TRANSACTION COUNT</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ $counts }}</h3>
                            {{-- <h3 class="mt-1 mb-1 text-dark fw-semibold"></h3> --}}
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
                            <div class="mb-0 fw-semibold text-dark">TRANSACTION AMOUNT</div>
                            <h3 class="mt-1 mb-1 text-dark fw-semibold"> ₦{{ number_format($sumAmount) }}</h3>
                        </div>
                        {{-- <i class="ri-thumb-up-line ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">




                <div class="card-body">

                  <!-- Search, Filters, and Rows Per Page Selector -->
    <div class="d-flex justify-content-between mb-3">
        <!-- Search input -->
        <input type="text" wire:model="search" class="form-control w-25" placeholder="Search...">

        <!-- Rows per page selector -->
        <select wire:model="perPage" class="form-control w-25">
            <option value="25">Show 25 rows</option>
            <option value="50">Show 50 rows</option>
            <option value="100">Show 100 rows</option>
            <option value="200">Show 200 rows</option>
            <option value="500">Show 500 rows</option>
        </select>

        <!-- Status filter dropdown -->
        <select wire:model="status" class="form-control w-25">
            <option value="">All Statuses</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>


                    <div class="table-responsive">
                        <table id="data-table3" class="table table-bordered text-nowrap mb-0">
                            <thead class="text-dark">
                                <tr>
                                    <th class="fw-semibold">#</th>

                                    <th class="fw-semibold">Transaction ID</th>
                                    <th class="fw-semibold">Fullname</th>
                                    <th class="fw-semibold">Beneficiary</th>
                                    <th class="fw-semibold">From</th>
                                    <th class="fw-semibold">Channel</th>
                                    <th class="fw-semibold">Platform</th>
                                    <th class="fw-semibold">Amount</th>
                                    <th class="fw-semibold">Status</th>
                                    <th class="fw-semibold">Date Created</th>
                                    <th class="fw-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($contents)
                                @forelse($contents as $count => $content)
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
                                        <td class="fw-semibold text-muted-dark">{{ $content->channel }}</td>
                                        <td class="fw-semibold text-muted-dark">{{ $content->platform }}</td>
                                        <td class="text-dark fw-semiboldHere is">
                                            {{ number_format($content->amount, 2) }}</td>
                                        <td class="fw-semibold">
                                            <span class="badge bg-{{ $content->status == 'success' ? 'success' : ($content->status == 'pending' || $content->status === 'processing' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($content->status) }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold text-muted-dark">{{ $content->created_at->format('Y-m-d') }}</td>
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

                                            <button  type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#confirmApprovalModal-{{ $content->id }}">  Approve </button>
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
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No transactions found</td>
                                    </tr>
                                @endforelse
                                @else
                                <tr>
                                    <td colspan="10" class="text-center">Please initiate a search to view transactions.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($contents)
                    <div class="mt-3">
                        {{ $contents->links() }}
                    </div>
                @endif

                @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                </div>
            </div>
        </div>
    </div>


    @section('scripts')
    <!-- SELECT2 JS -->
    <script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- APEXCHART JS -->
    <script src="{{ asset('build/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>

    <!-- DATA TABLES JS -->
    <script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

    <!-- INDEX JS -->
    @vite('resources/assets/js/index3.js')
    @vite('resources/assets/js/select2.js')

    @endsection
</div>
