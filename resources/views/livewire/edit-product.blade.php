<div>
    {{-- <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="update">
            <div class="form-group">
                <label for="bill_description">Bill Description</label>
                <textarea class="form-control" id="bill_description" wire:model="product_description" ></textarea>
                @error('bill_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" wire:model="status">
                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="user_percentage">User Percentage</label>
                <input type="text" class="form-control" id="user_percentage" wire:model="user_percentage">
                @error('user_percentage') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="product_icon">product Icon</label>
                <input type="file" class="form-control" id="product_icon" wire:model="product_icon">
                @error('product_icon') <span class="text-danger">{{ $message }}</span> @enderror
                @if ($existing_product_icon)
                    <img src="{{ Storage::disk('product_icon')->url($existing_product_icon) }}" alt="Bill Icon" width="100">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div> --}}


                                    <!-- PAGE HEADER -->
                                    <div class="page-header d-sm-flex d-block">
                                        <ol class="breadcrumb mb-sm-0 mb-3">
                                            <!-- breadcrumb -->
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{$slug ?? ""}} Product Utility</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                                    <form wire:submit.prevent="update">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">

                                                <div class="card-body">
                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">Product Name :</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"  wire:model="product_name" >
                                                        </div>
                                                        @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label mb-4" for="product_icon">Product Icon Upload: </label>
                                                        <div class="col-md-9">
                                                            <input type="file" class="form-control"  accept=".jpg, .png, image/jpeg, image/png" multiple id="product_icon" wire:model="product_icon">
                                                            @error('product_icon')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            @if ($existing_product_icon)
                                                                <img src="{{ Storage::disk('product_icon')->url($existing_product_icon) }}" alt="Product Icon" width="100" style="margin-top: 10px;">
                                                            @endif
                                                        </div>
                                                    </div>



                                                       <!-- Row -->
                                                       <div class="row mb-4">
                                                        <label class="col-md-3 form-label mb-4">Product Description :</label>
                                                        <div class="col-md-9 mb-4">
                                                            <textarea class="form-control" wire:model="product_description" ></textarea>
                                                        </div>
                                                        @error('product_description') <span class="text-danger">{{ $message }}</span> @enderror
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
                                                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>


                                                    <div class="row mb-4">
                                                        <label class="col-md-3 form-label">User Percentage</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder="Enter User Percentage" wire:model="user_percentage">
                                                        </div>
                                                        @error('user_percentage') <span class="text-danger">{{ $message }}</span> @enderror
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
                                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>


                                                </div>

                                                <div class="card-footer">
                                                    <!--Row-->
                                                    <div class="row">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-9">
                                                            {{-- <a href="javascript:void(0)" class="btn btn-light float-end">Discard</a> --}}
                                                            <button type="submit" class="btn btn-primary">Edit Product Utility</button>
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
