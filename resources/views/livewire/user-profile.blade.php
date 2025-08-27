<div>
    {{-- @extends('layouts.app') --}}

    @section('styles')

    @endsection

    {{-- @section('content') --}}

    <!-- PAGE-HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);"> {{ $user->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol><!-- End breadcrumb -->
        {{-- <div class="ms-auto">
                                        <div>
                                            <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm"
                                                data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
                                                data-bs-original-title="Rating">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </a>
                                            <a href="{{url('lockscreen')}}" class="btn bg-primary-transparent text-primary mx-2 btn-sm"
        data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
        data-bs-original-title="lock">
        <span>
            <i class="fa fa-lock"></i>
        </span>
        </a>
        <a href="javascript:void(0);" class="btn bg-warning-transparent text-warning btn-sm" data-bs-toggle="tooltip"
            title="" data-bs-placement="bottom" data-bs-original-title="Add New">
            <span>
                <i class="fa fa-plus"></i>
            </span>
        </a>
    </div>
</div> --}}
</div>
<!-- END PAGE-HEADER -->

<!-- ROW -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                {{-- <div class="profile-bg h-250 cover-image" data-bs-image-src="{{asset('build/assets/images/photos/30.jpg')}}">
            </div> --}}
            <div class="py-4 position-relative">
                {{-- <div class="profile-img">
                                                        <img src="{{asset('build/assets/images/users/male/24.jpg')}}" class="avatar avatar-xxl br-7" alt="person-image">
            </div> --}}
            <div class="mt-5 d-sm-flex align-items-center">
                <div class="profile-img me-3">
                    <!-- User Profile Icon -->
                    <i class="bi bi-person-circle text-primary display-3"></i>
                </div>
                <div>
                    <h3 class="fw-semibold mb-1">{{ $user->name }}</h3>
                </div>
            </div>
        </div>


        <div class="profile-section">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ $user->name }}'s Profile</h3>
                </div>
                <div class="card-body myTab">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item  fw-bold">
                            {{-- <a class="nav-link active" id="profile-info-tab" data-bs-toggle="tab" href="#profile-info" role="tab">Profile Info</a> --}}
                            <a class="nav-link {{ $activeTab === 'profile-info' ? 'active' : '' }}" wire:click.prevent="setActiveTab('profile-info')" href="#profile-info">Profile Info</a>
                        </li>
                         <li class="nav-item">
                            {{-- <a class="nav-link" id="wallet-tab" data-bs-toggle="tab" href="#wallet" role="tab">Wallet</a> --}}
                            <a class="nav-link {{ $activeTab === 'wallet' ? 'active' : '' }}" wire:click.prevent="setActiveTab('wallet')" href="#wallet">Wallet</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link {{ $activeTab === 'account' ? 'active' : '' }}" wire:click.prevent="setActiveTab('account')" href="#account-details" role="tab">Account Details</a>
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" id="bank-details-tab" data-bs-toggle="tab" href="#bank-details" role="tab">Banks</a> --}}
                            <a class="nav-link {{ $activeTab === 'bank' ? 'active' : '' }}" wire:click.prevent="setActiveTab('bank')"  href="#bank-details" role="tab"> Banks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="transaction-history-tab" data-bs-toggle="tab" href="#transaction-history" role="tab">Transaction History</a>
                        </li>

                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3">
                        <!-- Profile Info Tab -->
                        <div class="tab-pane fade  {{ $activeTab === 'profile-info' ? 'show active' : '' }}" id="profile-info" role="tabpanel">
                            @if($user)
                            <p><strong>NAME:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                            <p><strong>EMAIL:</strong> {{ $user->email }}</p>
                            <p><strong>PHONE NO:</strong> {{ $user->phone }}</p>
                            <p><strong>Date of Birth:</strong> {{ $user->dob }}</p>
                            <p><strong>Address:</strong> {{ $user->address }}</p>
                            <p><strong>Gender:</strong> {{ $user->gender }}</p>
                            <p><strong>JOINED:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                            @endif
                        </div>



                         <!-- USER WALLET Tab -->
                         <div class="tab-pane fade {{ $activeTab === 'wallet' ? 'show active' : '' }} " id="wallet" role="tabpanel">
                            <div >
                            @if($userWallet)
                            <p><strong>BALANCE :</strong>  <span class="text-primary">₦ {{ number_format($userWallet, 2) }} </span></p>
                            @else
                            <p>There is no amount in user's wallet</p>
                            @endif
                        </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 card-title">Action</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label class="form-label">Enter Amount</label>
                                                <input type="number" class="form-control" wire:model.defer="amount" placeholder="Enter an Amount">
                                                @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Action Wallet Type</label>
                                                <select class="form-control" wire:model="actionType">
                                                    <option value="">Select Action</option>
                                                    <option value="add">Add to Wallet</option>
                                                    <option value="deduct">Deduct From Wallet</option>
                                                </select>
                                                @error('actionType') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary" wire:click="updateWallet">Submit</button>
                                            </div>

                                        </div>
                                        @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                       @endif

                                    </div>
                                </div>
                            </div>


                        </div>

                         <!-- Bank Details Tab -->
                         <div class="tab-pane fade {{ $activeTab === 'account' ? 'show active' : '' }}" id="account-details" role="tabpanel">
                            <table class="table  table-bordered text-nowrap mb-0">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Virtual Account 1</th>
                                        <th>Virtual Account Name 1</th>
                                        <th>Virtual Account Bank 1</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($userBank as $bank) --}}
                                        <tr>
                                            <td>{{ $user->v_account_num_1 ?? 'N/A' }}</td>
                                            <td>{{ $user->v_account_name_1 ?? 'N/A' }}</td>
                                            <td>{{ $user->v_account_bank_1 ?? 'N/A' }}</td>
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>

                            <table class="table">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Virtual Account 2</th>
                                        <th>Virtual Account Name 2</th>
                                        <th>Virtual Account Bank 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($userBank as $bank) --}}
                                        <tr>
                                            <td>{{ $user->v_account_num_2 ?? 'N/A' }}</td>
                                            <td>{{ $user->v_account_name_2 ?? 'N/A' }}</td>
                                            <td>{{ $user->v_account_bank_2 ?? 'N/A' }}</td>
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>

                            <table class="table">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Virtual Account 3</th>
                                        <th>Virtual Account Name 3</th>
                                        <th>Virtual Account Bank 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($userBank as $bank) --}}
                                        <tr>
                                            <td>{{ $user->v_account_num_3 ?? 'N/A' }}</td>
                                            <td>{{ $user->v_account_name_3 ?? 'N/A' }}</td>
                                            <td>{{ $user->v_account_bank_3 ?? 'N/A' }}</td>
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>


                        </div>

                         <!-- Bank Details Tab -->
                         <div class="tab-pane fade {{ $activeTab === 'bank' ? 'show active' : '' }}" id="bank-details" role="tabpanel">
                            @if($userBank->isNotEmpty())
                            <table class="table  table-bordered text-nowrap mb-0">
                                <thead  class="bg-primary">
                                    <tr>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userBank as $bank)
                                        <tr>
                                            <td>{{ $bank->bank_name }}</td>
                                            <td>{{ $bank->account_name }}</td>
                                            <td>{{ $bank->account_number }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No bank details available.</p>
                        @endif

                        </div>

                        <!-- Transaction History Tab -->
                        <div class="tab-pane fade" id="transaction-history" role="tabpanel">
                            @if($userTransactions && $userTransactions->count() > 0)
                            1 - {{ $userTransactions->count() }} Transactions
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data-table3" class="table table-bordered text-nowrap mb-0">
                                        <thead class=" bg-primary">
                                            <tr>
                                                <th class="fw-semibold">#</th>
                                                <th class="fw-semibold">Transaction-ID</th>
                                                {{-- <th class="fw-semibold">UserID</th> --}}
                                                <th class="fw-semibold">Fullname</th>
                                                <th class="fw-semibold">Product</th>
                                                <th class="fw-semibold">Sub Product</th>
                                                <th class="fw-semibold">Channel</th>
                                                <th class="fw-semibold">Amount</th>
                                                <th class="fw-semibold">Status</th>
                                                <th class="fw-semibold">Date Created</th>
                                                <th class="fw-semibold">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($userTransactions as $count => $transactions)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    <h6 class="mb-0 fw-semibold text-primary">{{ $transactions->trans_ref }}</h6>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="mb-0 fs-14 fw-semibold text-dark">{{ ucfirst($transactions?->user_name) }}</h6>
                                                    </div>
                                                </td>
                                                <td class="fw-semibold text-muted-dark">{{ $transactions->product_name }}</td>
                                                <td class="fw-semibold text-dark">{{ $transactions->sub_product_name }}</td>
                                                <td class="fw-semibold text-muted-dark">{{ $transactions->trx_from }}</td>
                                                <td class="text-dark fw-semibold">{{ number_format($transactions->amount, 2) }}</td>
                                                <td>
                                                    <span class="badge {{ $transactions->status === 'success' ? 'bg-success' : ($transactions->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                                        {{ ucfirst($transactions->status == "success" ? 'approved' : $transactions->status) }}
                                                    </span>
                                                </td>
                                                <td class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($transactions->created_at)->format('d M Y, H:i') }}</td>
                                                <td>

                                                    {{-- <button type="button" class="btn btn-sm bg-info-transparent"> <a href="{{ route('admin.view-transaction', ['id' => $transactions->id]) }}"> View </a></button> --}}




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
                                                                <a href="{{ route('admin.view-transaction', ['id' => $transactions->id]) }}"> View </a>
                                                            </li>
                                                            <li>

                                                                @if($transactions->status == 'pending')
                                                                <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#confirmDeclineModal-{{ $transactions->id }}"> Decline</button>

                                                                <button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#confirmApprovalModal-{{ $transactions->id }}"">  Approve </button>
                                                                                            @endif
                                                                                                    </li>

                                                                                                </ul>
                                                                                            </div>

                                                                                              <!-- Confirmation Modal for Deactivation -->
                                                                                              <div class=" modal fade" id="confirmDeclineModal-{{ $transactions->id }}" tabindex="-1" aria-labelledby="confirmDeclineMdalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm Declination</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Are you sure you want to decline this transaction <strong>{{ ucfirst($transactions->product_name) }}</strong>?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                <button type="submit" data-bs-dismiss="modal" type="button" wire:click="toggleStatus('decline', {{ $transactions->id }})" class="btn btn-danger">Yes, Decline</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                    </div>

                                                    <!-- Confirmation Modal for activation -->
                                                    <div class="modal fade" id="confirmApprovalModal-{{ $transactions->id }}" tabindex="-1" aria-labelledby="confirmApprovalModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm UnBan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to approve this transaction <strong>{{ ucfirst($transactions->product_name) }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" type="button" data-bs-dismiss="modal" wire:click="toggleStatus('approve',{{ $transactions->id }})" class="btn btn-success">Yes, approve</button>
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
                                    {{-- {{ $userTransactions->links() }} --}}
                                </div>
                            </div>

                            @if (session()->has('statusUpdated'))
                            <div class="alert alert-success">
                                {{ session('statusUpdated') }}
                            </div>
                            @endif


                            @else
                            <p>No transaction history available.</p>
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

 <!-- MULTIPLE SELECT JS -->
 <script src="{{asset('build/assets/plugins/multipleselect/multiple-select.js')}}"></script>
 <script src="{{asset('build/assets/plugins/multipleselect/multi-select.js')}}"></script>

 <!-- JavaScript for Notifications -->
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('wallet-updated', event => {
            alert(event.message);
        });
    });
</script>


<!-- GALLERY JS -->
{{-- <script src="{{asset('build/assets/plugins/gallery/picturefill.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lightgallery.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lightgallery-1.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-pager.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-autoplay.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-fullscreen.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-zoom.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-hash.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-share.js')}}"></script> --}}

@endsection
</div>
