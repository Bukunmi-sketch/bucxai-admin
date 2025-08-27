<div>


      <!-- PAGE HEADER -->
      <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="javascript:void(0);">Manage </a></li>
            <li class="breadcrumb-item active" aria-current="page">Noticeboard</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                {{-- <button class="btn btn-primary mb-4" wire:click="$set('showModal', true)">Add Notice</button> --}}
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->


    <!-- Noticeboard Table -->
    <div class="row">
        <div class="col-lg-12">

    <div class="e-panel card">
        <div class="card-header">
            {{-- <h2 class="card-title">1 - 30 of 546 users</h2> --}}
            <h2 class="card-title">1 - {{ $notices->count() }}  Notice</h2>
             <div class="page-options">
                <button class="btn btn-primary mb-4" wire:click="$set('showModal', true)">Add Notice</button>
            </div>

        </div>
    <div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Published By</th>
                <th>Date Added</th>
                <th>Visible For</th>
                <th>Impressions</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notices as $index => $notice)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $notice->title }}</td>
                    <td>{{ $notice->published_by }}</td>
                    <td>{{ $notice->created_at->format('jS F Y') }}</td>
                    <td>{{ ucfirst($notice->visible_for) }}</td>
                    <td>{{ $notice->impression }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#" wire:click="viewDetails({{ $notice->id }})">View Details</a></li>
                                {{-- <li><a class="dropdown-item" href="#">Edit</a></li> --}}
                                <li><a class="dropdown-item" href="#" wire:click="confirmDelete({{ $notice->id }})">Delete</a></li>
                            </ul>
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
    <!-- Add Notice Modal -->
    <div class="modal @if($showModal) show d-block @endif" tabindex="-1" role="dialog" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Notice</h5>
                    <button type="button" class="close" wire:click="$set('showModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createNotice">
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" wire:model="title" class="form-control" placeholder="Enter Notice Title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" wire:model="description" class="form-control" placeholder="Enter Notice Description"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Visibility -->
                        <div class="form-group">
                            <label for="visible_for">Visible For</label>
                            <select id="visible_for" wire:model="visible_for" class="form-control">
                                <option value="">Select Visibility</option>
                                <option value="all">All</option>
                                <option value="users">Users</option>
                                <option value="agents">Agents</option>
                                <option value="staffs">Staffs</option>
                                {{-- <option value="clients">Clients</option> --}}
                            </select>
                            @error('visible_for') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add Notice</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="alert alert-success mt-3">
        {{ session('message') }}
    </div>
   @endif

    <!-- Modal backdrop to close the modal -->
    @if($showModal)
        <div class="modal-backdrop fade show"></div>
    @endif

     <!-- Delete Confirmation Modal -->
     <div class="modal @if($confirmingNoticeDeletion) show d-block @endif" tabindex="-1" role="dialog" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" wire:click="$set('confirmingNoticeDeletion', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this notice?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('confirmingNoticeDeletion', false)">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteNotice">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal backdrop to close the modal -->
    @if($confirmingNoticeDeletion)
        <div class="modal-backdrop fade show"></div>
    @endif

    <!-- View Details Modal -->
    <div class="modal @if($viewingNoticeDetails) show d-block @endif" tabindex="-1" role="dialog" style="background-color: rgba(0,0,0,0.5);" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notice Details</h5>
                    <button type="button" class="close" wire:click="$set('viewingNoticeDetails', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($selectedNotice)
                        <h5><strong>Title:</strong>{{ $selectedNotice->title }}</h5>
                        <p><strong>Description:</strong>{{ $selectedNotice->description }}</p>
                        <p><strong>Published By:</strong> {{ $selectedNotice->published_by }}</p>
                        <p><strong>Date Added:</strong> {{ $selectedNotice->created_at->format('jS F Y') }}</p>
                        <p><strong>Visible For:</strong> {{ ucfirst($selectedNotice->visible_for) }}</p>
                        <p><strong>Impressions:</strong> {{ $selectedNotice->impression }}</p>
                    @else
                        <p>No notice details available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal backdrop to close the modal -->
    @if($viewingNoticeDetails)
        <div class="modal-backdrop fade show"></div>
    @endif


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
