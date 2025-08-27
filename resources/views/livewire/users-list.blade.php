<div>
{{-- @extends('layouts.app') --}}

{{-- @section('styles')

@endsection

@section('content') --}}

                            <!-- PAGE HEADER -->
                            <div class="page-header d-sm-flex d-block">
                                <ol class="breadcrumb mb-sm-0 mb-3">
                                    <!-- breadcrumb -->
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">All Users</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User List</li>
                                </ol><!-- End breadcrumb -->
                                <div class="ms-auto">
                                    <div>

                                    </div>
                                </div>
                            </div>
                            <!-- END PAGE HEADER -->

                            <!-- ROW -->
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="e-panel card">
                                        <div class="card-header">
                                            {{-- <h2 class="card-title">1 - 30 of 546 users</h2> --}}
                                            <h2 class="card-title">1 - {{ $users->count() }} of {{ $users->total() }} users</h2>

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

                <!-- Real-time Search input -->
                <input type="text" wire:model.debounce.500ms="searchTerm" class="form-control w-25" placeholder="Search...">

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
                                                                <th class="text-dark fw-semibold">S/N</th>
                                                                <th class="text-dark fw-semibold">Username</th>
                                                                <th class="text-dark fw-semibold w-25">Name</th>
                                                                <th class="text-dark fw-semibold">Email</th>
                                                                <th class="text-dark fw-semibold">Phone no</th>
                                                                <th class="text-dark fw-semibold">Wallet Balance</th>
                                                                <th class="text-dark fw-semibold">Gender</th>
                                                                <th class="text-dark fw-semibold"> Status</th>
                                                                {{-- <th class="text-dark fw-semibold">Joined</th> --}}
                                                                <th class="fw-semibold">Actions</th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($users as $user)
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                {{-- <td class="text-nowrap align-middle"><span>{{ $user->username }}</span> </td> --}}
                                                                <td class="text-nowrap align-middle"><span>{{ $user->username }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span>{{ $user->first_name }} {{ $user->last_name }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span>{{ $user->email }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span>{{ $user->phone  }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span> ₦{{ $user->wallet_balance }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span>{{ $user->gender  }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span class="badge {{ $user->status === 'active' ? 'bg-success' : ($user->status === 'banned' ? 'bg-warning' : 'bg-danger') }}">{{ $user->status}}</span> </td>
                                                                {{-- <td class="text-nowrap align-middle"><span>{{ $user->created_at }}</span> </td> --}}
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
                                                                                <a href="{{ route('admin.view-users', ['id' => $user->id]) }}" class="dropdown-item text-info" >
                                                                                    <i class="fe fe-edit text-info me-2"></i>  View Profile
                                                                                </a>
                                                                                 <!-- View Profile Button -->
                    {{-- <button type='button' class="dropdown-item text-info" wire:click="showUserProfile({{ $user->id }})" >
                        <i class="fe fe-edit text-info me-2"></i> Profile
                    </button> --}}
                                                                                {{-- <a class="dropdown-item" href="{{ route('admin.view-users', ['id' => $user->id]) }}"><i class="fe fe-edit text-info me-2"></i> Profile </a> --}}
                                                                            </li>
                                                                            <li>
                                                                                @if($user->status == 'active')
                                                                                    <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#confirmBanModal-{{ $user->id }}">
                                                                                        <i class="fe fe-trash-2 text-danger me-2"></i> Ban
                                                                                    </button>
                                                                                @else
                                                                                    <button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#confirmUnBanModal-{{ $user->id }}">
                                                                                        <i class="fe fe-trash-2 text-danger me-2"></i> UnBan
                                                                                    </button>
                                                                                @endif
                                                                            </li>
                                                                            <li>
                                                                                <button class="dropdown-item text-danger" type="button">
                                                                                    <i class="fe fe-edit me-2"></i> Edit
                                                                                </button>
                                                                            </li>
                                                                            <li>
                                                                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $user->id }}">
                                                                                    <i class="fe fe-trash me-2"></i> Delete
                                                                                </button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>


                                                                        <!-- Confirmation Modal for Deactivation -->
                                                                        <div class="modal fade" id="confirmBanModal-{{ $user->id }}" tabindex="-1" aria-labelledby="confirmBanModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm Ban</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Are you sure you want to ban  this user <strong>{{ ucfirst($user->username) }}</strong>?
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                            <button type="submit" data-bs-dismiss="modal" type="button"  wire:click="toggleBan('ban',{{ $user->id }})" class="btn btn-danger">Yes, ban</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                          <!-- Confirmation Modal for activation -->
                                                                          <div class="modal fade" id="confirmUnBanModal-{{ $user->id }}" tabindex="-1" aria-labelledby="confirmUnBanModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm UnBan</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Are you sure you want to unban this user <strong>{{ ucfirst($user->username) }}</strong>?
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                            <button type="submit" type="button" data-bs-dismiss="modal"   wire:click="toggleBan('unban',{{ $user->id }})" class="btn btn-success">Yes, unban</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Confirmation Modal for Deletion -->
<div class="modal fade" id="confirmDeleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user <strong>{{ ucfirst($user->username) }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" wire:click="deleteUser({{ $user->id }})" class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>



                                              </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $users->links() }}
                                            </div>
                                        </div>
                                        @if (session()->has('statusUpdated'))
                                        <div class="alert alert-success">
                                            {{ session('statusUpdated') }}
                                        </div>
                                    @endif
                                        {{-- {{ $users->links() }} --}}
                                        {{--  --}}
                                    </div>
                                </div>
                            </div>
                            <!-- END ROW -->

{{-- @endsection --}}

@section('scripts')

 <!-- SELECT2 JS -->
 {{-- <script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>

 <!-- APEXCHART JS -->
 <script src="{{ asset('build/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>

 <!-- DATA TABLES JS -->
 <script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
 <script src="{{ asset('build/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script> --}}
{{--
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('openModal', () => {
            console.log('Modal event received, opening modal...'); // Debugging

            var myModal = new bootstrap.Modal(document.getElementById('userProfileModal'));
            myModal.show();

            console.log('Bootstrap modal is now showing...'); // Debugging
        });
    });
</script> --}}


 <!-- INDEX JS -->
 @vite('resources/assets/js/index3.js')
 @vite('resources/assets/js/select2.js')

@endsection
                        </div>
