<div>

                                    <!-- PAGE HEADER -->
                                    <div class="page-header d-sm-flex d-block">
                                        <ol class="breadcrumb mb-sm-0 mb-3">
                                            <!-- breadcrumb -->
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{$slug ?? ""}} Sub Product Utility</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add new Sub Product {{$pageType ?? ""}}</li>
                                        </ol><!-- End breadcrumb -->
                                        <div class="ms-auto">
                                            <div>
                                                <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm"
                                                   onclick="window.history.back()" data-bs-toggle="tooltip" title="Go back"
                                                   data-bs-placement="bottom">
                                                    <span>
                                                        <i class="fa fa-arrow-left"></i> Go back
                                                    </span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- END PAGE HEADER -->

                                    <!-- ROW -->
                                    <form wire:submit.prevent="storeSub">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">

                                                <div class="card-body">

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Type:</label>
                                                        <div class="col-md-9">
                                                            <select id="product_entity_id" class="form-control form-select" wire:model="product_entity_id">
                                                                <option value="">---- choose sub product ----</option>
                                                                @foreach($productContents as $productContent)
                                                                    <option value="{{ $productContent->id }}" {{ old('product_entity_id') == $productContent->id ? ' selected ' : '' }}>
                                                                        {{ ucfirst($productContent->product_name) }} [{{ $productContent->product_description }}]
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('product_entity_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>
                                                     </div>

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Sub Product Name :</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"  wire:model="sub_name" >
                                                        </div>
                                                        @error('sub_name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Sub Price :</label>
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control"  wire:model="sub_price" >
                                                        </div>
                                                        @error('sub_price') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">User Percentage :</label>
                                                        <div class="col-md-9">
                                                            <input type="number" placeholder="Enter user percent e.g 0.60 (60%)" class="form-control"  wire:model="user_percent" >
                                                        </div>
                                                        @error('user_percent') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Optional Parameters :</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Enter optional parameters" class="form-control"  wire:model="optional_param" >
                                                        </div>
                                                        @error('optional_param') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Data Type :</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Enter data type" class="form-control"  wire:model="data_id" >
                                                        </div>
                                                        @error('data_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>


                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Plan Type:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Enter plan type" class="form-control"  wire:model="plan_id" >
                                                        </div>
                                                        @error('plan_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Auto Sub Production ID :</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Enter auto production" class="form-control"  wire:model="auto_sub_pro_id" >
                                                        </div>
                                                        @error('auto_sub_pro_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Addon Code:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" placeholder="Enter addon code" class="form-control"  wire:model="addon_code" >
                                                        </div>
                                                        @error('addon_code') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>


                                                </div>

                                                <div class="card-footer">
                                                    <!--Row-->
                                                    <div class="row">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-9">
                                                            {{-- <a href="javascript:void(0)" class="btn btn-light float-end">Discard</a> --}}
                                                            <button type="submit" class="btn btn-primary">Create Sub Product</button>
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




</div>
