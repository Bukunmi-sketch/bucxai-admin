<div>
    {{-- @extends('layouts.app') --}}

    {{-- @section('styles')

    @endsection

    @section('content') --}}

                                <!-- PAGE HEADER -->
                                <div class="page-header d-sm-flex d-block">
                                    <ol class="breadcrumb mb-sm-0 mb-3">
                                        <!-- breadcrumb -->
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{$productType ?? null}}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{$pageTitle ?? null}}</li>
                                    </ol><!-- End breadcrumb -->
                                    <div class="ms-auto">
                                        <div>
                                            {{-- <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm"
                                                data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
                                                data-bs-original-title="Rating">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            </a> --}}
                                            {{-- <a href="{{url('lockscreen')}}" class="btn bg-primary-transparent text-primary mx-2 btn-sm"
                                                data-bs-toggle="tooltip" title="" data-bs-placement="bottom"
                                                data-bs-original-title="lock">
                                                <span>
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                            </a> --}}
                                            {{-- <a href="javascript:void(0);" class="btn bg-warning-transparent text-warning btn-sm" data-bs-toggle="tooltip"
                                                title="" data-bs-placement="bottom" data-bs-original-title="Add New">
                                                Add New
                                                <span>
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                            </a> --}}
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
                                                    {{-- 1 - {{ $contents->count() }} --}}
                                                     showing {{ $contents->total() }} entries</h2>
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
                                                        <thead>
                                                            <tr>
                                                              <th scope="col">#</th>
                                                              <th scope="col">Product Name</th>
                                                              {{-- <th scope="col">Bill Description</th> --}}
                                                              <th scope="col">Status</th>
                                                              <th scope="col">Action</th>
                                                            </tr>
                                                          </thead>
                                                        <tbody>
                                                            @foreach($contents as $count => $content)

                                                                <tr>
                                                                    <td class="align-middle text-center">
                                                                        <div
                                                                            class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                                                {{ $loop->iteration }}
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-nowrap align-middle"><span>{{ ucfirst($content->product_name) ?? null }}</span> </td>
                                                                    {{-- <td class="text-nowrap align-middle"><span>{{ ucfirst($content->product_description) ?? null }}</span> </td> --}}
                                                                    <td class="text-nowrap align-middle">
                                                                        <span class="badge {{ $content->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                                                            <i class="fa {{ $content->status == '1' ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                                                            {{ $content->status == '1' ? 'Active' : 'Inactive' }}
                                                                        </span>
                                                                    </td>


                                                                    {{-- <td class="text-center align-middle">
                                                                        <div class="btn-group align-top br-7 ">
                                                                            <a href="{{ route('admin.product-detail', ['slug' => $content->product_name, 'id' => $content->id]) }}"><button class="btn btn-sm btn-primary badge" type="button">De-activate</button></a>

                                                                            <a href="{{ route('admin.subproduct-list', ['type' => $productType, 'slug' => $content->product_name]) }}"><button class="btn btn-sm btn-success badge" type="button">Subproducts</button></a>
                                                                        </div>
                                                                    </td> --}}

                                                                    <td class="text-center align-middle">
                                                                        <div class="btn-group align-top br-7">
                                                                            @if($content->status == '1')
                                                                            <!-- Deactivate Button -->
                                                                            <button class="btn btn-sm btn-danger badge ms-2" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeactivateModal-{{ $content->id }}">
                                                                                De-activate
                                                                            </button>

                                                                            @else

                                                                            <button class="btn btn-sm btn-success badge ms-2" type="button" data-bs-toggle="modal" data-bs-target="#confirmactivateModal-{{ $content->id }}">
                                                                                activate
                                                                            </button>

                                                                            @endif

                                                                            <!-- Subproducts Button -->
                                                                            <a href="{{ route('admin.subproduct-list', ['type' => $productType, 'slug' => $content->id]) }}">
                                                                                <button class="btn btn-sm btn-info badge ms-2" type="button">Subproducts</button>
                                                                            </a>
                                                                        </div>

                                                                        <!-- Confirmation Modal for Deactivation -->
                                                                        <div class="modal fade" id="confirmDeactivateModal-{{ $content->id }}" tabindex="-1" aria-labelledby="confirmDeactivateModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm Deactivation</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Are you sure you want to deactivate the product <strong>{{ ucfirst($content->product_name) }}</strong>?
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                            <button type="submit" data-bs-dismiss="modal" type="button" wire:click="deactivateProduct({{ $content->id }})" class="btn btn-danger">Yes, Deactivate</button>
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
                                                                                        Are you sure you want to activate the product <strong>{{ ucfirst($content->product_name) }}</strong>?
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                            <button type="submit" type="button" data-bs-dismiss="modal"  wire:click="activateProduct({{ $content->id }})" class="btn btn-success">Yes, activate</button>
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
     <script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>

     <!-- APEXCHART JS -->
     <script src="{{ asset('build/assets/plugins/apexcharts/apexcharts.min.js') }}"></script>

     <!-- DATA TABLES JS -->
     {{-- <script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script> --}}
     <script src="{{ asset('build/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('build/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

     <!-- INDEX JS -->
     @vite('resources/assets/js/index3.js')
     @vite('resources/assets/js/select2.js')

    @endsection
                            </div>
