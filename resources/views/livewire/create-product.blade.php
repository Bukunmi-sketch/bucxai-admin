<div>
{{-- @extends('layouts.app') --}}

@section('styles')

@endsection

{{-- @section('content') --}}

                            <!-- PAGE HEADER -->
                            <div class="page-header d-sm-flex d-block">
                                <ol class="breadcrumb mb-sm-0 mb-3">
                                    <!-- breadcrumb -->
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Product Utility</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                                </ol><!-- End breadcrumb -->
                                <div class="ms-auto">
                                    <div>
                                        <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm" data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="Rating"> <span> <i class="fa fa-star"></i> Go back </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- END PAGE HEADER -->

                            <!-- ROW -->
                            <form wire:submit="store" >
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <div class="card-title">Add New Product</div>
                                        </div>

                                        <div class="card-body">
                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Product Name :</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Enter product name" wire:model="product_name" >
                                                </div>
                                                {{-- @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                             <!--Row-->
                                             <div class="row mb-4">
                                                <label class="col-md-3 form-label mb-4">Product Icon Upload :</label>
                                                <div class="col-md-9">
                                                    <input id="demo" type="file" accept=".jpg, .png, image/jpeg, image/png" multiple wire:model="product_icon">
                                                </div>
                                                {{-- @error('product_icon') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                               <!-- Row -->
                                               <div class="row mb-4">
                                                <label class="col-md-3 form-label mb-4">Product Description :</label>
                                                <div class="col-md-9 mb-4">
                                                    <textarea class="content" wire:model="product_description" ></textarea>
                                                </div>
                                                {{-- @error('product_description') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>
                                            <!--End Row-->

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Type:</label>
                                                <div class="col-md-9">
                                                    <select class="form-control form-select select2" data-bs-placeholder="Select Type" wire:model="type">
                                                        <option value="internet" {{ old('type') == 'internet' ? 'selected' : '' }}>Internet</option>
                                                        <option value="electricity" {{ old('type') == 'electricity' ? 'selected' : '' }}>Electricity</option>
                                                        <option value="cable tv" {{ old('type') == 'cable tv' ? 'selected' : '' }}>Cable TV</option>
                                                        <option value="more" {{ old('type') == 'more' ? 'selected' : '' }}>More</option>
                                                    </select>
                                                </div>
                                                {{-- @error('type') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>


                                            <!--End Row-->
                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Service Id:</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="type" wire:model="service_id">
                                                </div>
                                                {{-- @error('service_id') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Network:</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="network" wire:model="network">
                                                </div>
                                                {{-- @error('network') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Instruction 1:</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Instruction 1" wire:model="instruct_1">
                                                </div>
                                                {{-- @error('instruct_1') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Instruction 2:</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Instruction 2" wire:model="instruct_2">
                                                </div>
                                                {{-- @error('instruct_2') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Maximum Amount</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Maximum amount" wire:model="max_amount">
                                                </div>
                                                {{-- @error('max_amount') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Minimum Amount</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Minimum Amount" wire:model="min_amount">
                                                </div>
                                                {{-- @error('min_amount') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">User Percentage</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Enter User Percentage" wire:model="user_percentage">
                                                </div>
                                                {{-- @error('user_percentage') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Reseller Percentage</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Enter Reseller Percentage" wire:model="reseller_percentage">
                                                </div>
                                                {{-- @error('reseller_percentage') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Phone</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder=" Enter phone" wire:model="phone">
                                                </div>
                                                {{-- @error('phone') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Per charges</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="per charges" wire:model="per_charges">
                                                </div>
                                                {{-- @error('per_charges') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Auto Production Id: </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Enter Production Id" wire:model="auto_prod_id">
                                                </div>
                                                {{-- @error('auto_prod_id') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>

                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Auto Type: </label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Enter Auto type" wire:model="auto_type">
                                                </div>
                                                {{-- @error('auto_type') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>



                                            <div class="row mb-4">
                                                <label class="col-md-3 form-label">Status:</label>
                                                <div class="col-md-9">
                                                    <select  class="form-control form-select select2"
                                                        data-bs-placeholder="Select status"  wire:model="status">
                                                        <option value="1" {{ old('status') == '1' ? ' selected ' : '' }}>Active</option>
                                                        <option value="0" {{ old('status') == '0' ? ' selected ' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                                {{-- @error('status') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                            </div>


                                        </div>

                                        <div class="card-footer">
                                            <!--Row-->
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">
                                                    {{-- <a href="javascript:void(0)" class="btn btn-light float-end">Discard</a> --}}
                                                    <button type="submit" class="btn btn-primary">Create Product Utility</button>
                                                </div>
                                            </div>

                                            @if (session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                           @endif
                                            <!--End Row-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <!-- END ROW -->

{{-- @endsection --}}

@section('scripts')

        <!-- SELECT2 JS -->
        <script src="{{asset('build/assets/plugins/select2/select2.full.min.js')}}"></script>
        @vite('resources/assets/js/select2.js')


        <!-- INTERNAL WYSIWYG EDITOR JS -->
        <script src="{{asset('build/assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
        <script src="{{asset('build/assets/plugins/wysiwyag/wysiwyag.js')}}"></script>

        <!-- INTERNAL FILE-UPLOADS JS -->
        <script src="{{asset('build/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
        <script src="{{asset('build/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
        <script src="{{asset('build/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
        <script src="{{asset('build/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
        <script src="{{asset('build/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>

@endsection
                        </div>
