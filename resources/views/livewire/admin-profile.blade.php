<div>
    {{-- @extends('layouts.app') --}}

    @section('styles')

    @endsection

    {{-- @section('content') --}}

    <!-- PAGE-HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);"> {{ $admin->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol><!-- End breadcrumb -->
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
                    <h3 class="fw-semibold mb-1">{{ $admin->name }}</h3>
                </div>
            </div>
        </div>


        <div class="profile-section">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ $admin->name }}'s Profile</h3>
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
                            {{-- <a class="nav-link {{ $activeTab === 'wallet' ? 'active' : '' }}" wire:click.prevent="setActiveTab('wallet')" href="#wallet">Wallet</a> --}}
                        </li>
                         <li class="nav-item">
                            {{-- <a class="nav-link {{ $activeTab === 'account' ? 'active' : '' }}" wire:click.prevent="setActiveTab('account')" href="#account-details" role="tab">Account Details</a> --}}
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" id="bank-details-tab" data-bs-toggle="tab" href="#bank-details" role="tab">Banks</a> --}}
                            {{-- <a class="nav-link {{ $activeTab === 'bank' ? 'active' : '' }}" wire:click.prevent="setActiveTab('bank')"  href="#bank-details" role="tab"> Banks</a> --}}
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" id="transaction-history-tab" data-bs-toggle="tab" href="#transaction-history" role="tab">Transaction History</a> --}}
                        </li>

                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3">
                        <!-- Profile Info Tab -->
                        <div class="tab-pane fade  {{ $activeTab === 'profile-info' ? 'show active' : '' }}" id="profile-info" role="tabpanel">
                            @if($admin)
                            <p><strong>NAME:</strong> {{ $admin->name }}</p>
                            <p><strong>EMAIL:</strong> {{ $admin->email }}</p>
                            <p><strong>ROLE: </strong> {{ $admin->role }}</p>
                            <p><strong>JOINED:</strong> {{ $admin->created_at->format('M d, Y, h:i A') }}</p>
                            @endif
                        </div>







                        <!-- Transaction History Tab -->





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



@endsection
</div>
