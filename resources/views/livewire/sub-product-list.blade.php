<div>
{{-- @extends('layouts.app') --}}

 {{-- @section('styles')

@endsection --}}

{{-- @section('content') --}}

                            <!-- PAGE HEADER -->
                            <div class="page-header d-sm-flex d-block">
                                <ol class="breadcrumb mb-sm-0 mb-3">
                                    <!-- breadcrumb -->
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Manage  Sub Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$pageTitle ?? null}}</li>
                                </ol><!-- End breadcrumb -->
                                <div class="ms-auto">
                                    <div>
                                        <a href="{{ route('admin.create-sub-product', ['type' => $pageType, 'slug' => $slug]) }}" class="btn bg-primary text-white btn-sm" data-bs-toggle="tooltip"
                                            title="" data-bs-placement="bottom" data-bs-original-title="Add New">
                                            Add New
                                            <span> <i class="fa fa-plus"></i> </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- END PAGE HEADER -->

                            <!-- ROW -->
                            <div class="row">
                                <div class="col-lg-12">
                                    {{-- <div class="input-group mb-5 float-end">
                                        <input type="text" class="form-control" placeholder="Search here..." wire:model.debounce.500ms="searchTerm">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div> --}}
                                    <div class="e-panel card">
                                        <div class="card-header">
                                            {{-- <h2 class="card-title">1 - 30 of 546 users</h2> --}}
                                            <h2 class="card-title">
                                                {{-- 1 - {{ $contents->count() }} of  --}}
                                               Showing {{ $contents->total() }} subproducts</h2>
                                            {{-- <div class="page-options">
                                                <select class="form-control select2 w-auto" wire:model="sortOrder">
                                                    <option value="desc">Latest</option>
                                                    <option value="asc">Oldest</option>
                                                </select>
                                            </div> --}}
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="data-table3" class="table table-bordered text-nowrap mb-0">
                                                    <thead class="text-dark">
                                                            <tr>
                                                                {{-- <th class="text-center text-dark fw-semibold">
                                                                    All
                                                                </th> --}}
                                                                <th class="fw-semibold">#</th>

                                                                <th class="text-dark fw-semibold w-25">Sub Product</th>
                                                                <th class="text-dark fw-semibold">Price</th>
                                                                <th class="text-dark fw-semibold">User Percentage</th>
                                                                <th class="text-dark fw-semibold">Agent Percentage</th>
                                                                <th class="text-dark fw-semibold"> Status</th>
                                                                <th class="fw-semibold">Actions</th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($contents as $count => $content)
                                                            <tr>
                                                                <td class="text-nowrap align-middle"><span>{{ $loop->iteration }}</span> </td>

                                                                <td class="text-nowrap align-middle"><span>{{ ucfirst($content->sub_name) ?? null }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span>{{ number_format($content->sub_price, 2) ?? null }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span>{{ ($content->user_percent ?? 'N/A') }}</span> </td>
                                                                <td class="text-nowrap align-middle"><span>{{ ($content->agent_percent ?? 'N/A') }}</span> </td>
                                                                <td>
                                                                    <span class="badge {{ $content->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                                                        <i class="fa {{ $content->status == '1' ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                                                        {{ $content->status == '1' ? 'Active' : 'Inactive' }}
                                                                    </span>
                                                                  </td>
                                                                  <td>

                                                                    {{-- <button type="button" class="btn btn-sm bg-info-transparent"> <a href="{{ route('admin.view-users', ['id' => $content->id]) }}"><i class="fe fe-edit text-info"></i> View </a></button> --}}
                                                                    <a href="{{ route('admin.edit-sub-product', ['type' => $pageType, 'slug' => $slug,'id' => $content->id]) }}"><button class="btn btn-sm bg-danger-transparent badge" type="button">Edit</button></a>
                                                                    @if($content->status == '1')
                                                                    <button data-bs-toggle="modal" data-bs-target="#confirmDeactivateModal-{{ $content->id }}" class="btn btn-sm btn-primary badge">De-activate</button>
                                                                    @else
                                                                    <button  data-bs-toggle="modal" data-bs-target="#confirmactivateModal-{{ $content->id }}" class="btn btn-sm bg-success badge" type="button">Activate</button>
                                                                    @endif

                                                                     <!-- Confirmation Modal for Deactivation -->
                                                                     <div class="modal fade" id="confirmDeactivateModal-{{ $content->id }}" tabindex="-1" aria-labelledby="confirmDeactivateModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm Deactivation</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    Are you sure you want to deactivate the product <strong>{{ ucfirst($content->sub_name) }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                        <button type="submit" data-bs-dismiss="modal" type="button" wire:click="updateStatus('disable', {{ $content->id }})" class="btn btn-danger">Yes, Deactivate</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                      <!-- Confirmation Modal for activation -->
                                                                      <div class="modal fade" id="confirmactivateModal-{{ $content->id }}" tabindex="-1" aria-labelledby="confirmactivateModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm activation</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    Are you sure you want to activate the product <strong>{{ ucfirst($content->sub_name) }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                        <button type="submit" type="button" data-bs-dismiss="modal" wire:click="updateStatus('enable',{{ $content->id }})" class="btn btn-success">Yes, activate</button>
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


                                        {{-- {{ $users->links() }} --}}
                                        {{--  --}}
                                    </div>
                                </div>
                            </div>
                            @if (session()->has('statusUpdated'))
                            <div class="alert alert-success">
                                {{ session('statusUpdated') }}
                            </div>
                        @endif
                            <!-- END ROW -->

{{-- @endsection --}}

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
