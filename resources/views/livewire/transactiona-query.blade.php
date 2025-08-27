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

                <div class="card-header">

                    {{-- <h2 class="card-title">1 - {{ $contents->count() }} of {{ $contents->total() }} users</h2> --}}
                    <form wire:submit.prevent="searchBasedOnQuery">
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Product :</label>
                        <div class="col-md-9">
                            <select id="product_entity_id" class="form-control form-select" wire:model="product_entity_id">
                                <option value="">---- choose sub product ----</option>
                                @foreach($productContents as $productContent)
                                    <option value="{{ $productContent->id }}">
                                        {{ ucfirst($productContent->product_name) }} [{{ $productContent->product_description }}]
                                    </option>
                                @endforeach
                            </select>
                            @error('product_entity_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Transaction Status:</label>
                        <div class="col-md-9">
                            <select class="form-control form-select select2" data-bs-placeholder="Select Type" wire:model="status">
                                <option value="approved" {{ old('type') == 'approved' ? 'selected' : '' }}>approved</option>
                                <option value="pending" {{ old('type') == 'pending' ? 'selected' : '' }}>pending</option>
                                <option value="declined" {{ old('type') == 'declined' ? 'selected' : '' }}>declined</option>
                                <option value="failed" {{ old('type') == 'failed' ? 'selected' : '' }}>failed</option>
                            </select>
                        </div>
                        {{-- @error('type') <span class="text-danger">{{ $message }}</span> @enderror --}}
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Date From:</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" wire:model="date_from">
                            @error('date_from') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Date To:</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" wire:model="date_to">
                            @error('date_to') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>

                    </form>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table3" class="table table-bordered text-nowrap mb-0">
                            <thead class="text-dark">
                                <tr>

                                    <th class="fw-semibold">#</th>
                                    <th class="fw-semibold">Actions</th>
                                    <th class="fw-semibold">Transaction-ID</th>
                                    <th class="fw-semibold">Fullname</th>
                                    <th class="fw-semibold">Product</th>
                                    <th class="fw-semibold">Sub Product</th>
                                    <th class="fw-semibold">Channel</th>
                                    <th class="fw-semibold">Amount</th>
                                    <th class="fw-semibold">Status</th>
                                    <th class="fw-semibold">Date Created</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contents as $count => $content)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>

                                        <button type="button" class="btn btn-sm bg-info-transparent"> <a href="{{ route('admin.view-transaction', ['id' => $content->id]) }}"> View </a></button>

                                        @if($content->status == 'pending')
                                        <button wire:click="toggleStatus('decline', {{ $content->id }})" type="button" class="btn btn-sm bg-warning-transparent"> Decline</button>

                                        <button wire:click="toggleStatus('approve',{{ $content->id }})"  wire:confirm="Are you sure want to approve this transaction?" type="button" class="btn btn-sm bg-success-transparent">  Approve </button>
                                        @endif

                                    </td>
                                    <td>
                                        <h6 class="mb-0 fw-semibold text-primary">{{ $content->trans_ref }}</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 fs-14 fw-semibold text-dark">{{ ucfirst($content?->user_name) }}</h6>
                                        </div>
                                    </td>
                                    <td class="fw-semibold text-muted-dark">{{ $content->product_name }}</td>
                                    <td class="fw-semibold text-dark">{{ $content->sub_product_name }}</td>
                                    <td class="fw-semibold text-muted-dark">{{ $content->trx_from }}</td>
                                    <td class="text-dark fw-semibold">{{ number_format($content->amount, 2) }}</td>

                                    {{-- <td><span class="badge bg-primary-transparent text-primary">Available</span> --}}
                                    <td>
                                        @if($content->status == 'pending')
                                        <span class="badge bg-warning text-dark" style="padding: 0.2rem 0.5rem;">Pending</span>
                                        @elseif($content->status == 'success')
                                        <span class="badge bg-success text-white" style="padding: 0.2rem 0.5rem;">Successful</span>
                                        @elseif($content->status == 'failed')
                                        <span class="badge bg-danger text-white" style="padding: 0.2rem 0.5rem;">Failed</span>
                                        @else
                                        <span class="badge bg-secondary text-white">Unknown</span>
                                        @endif
                                    </td>
                                    <td class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($content->created_at)->format('d M Y, H:i') }}</td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
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
