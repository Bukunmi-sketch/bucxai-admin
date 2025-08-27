<div>


    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
      <ol class="breadcrumb mb-sm-0 mb-3">
          <!-- breadcrumb -->
          <li class="breadcrumb-item"><a href="javascript:void(0);">Manage </a></li>
          <li class="breadcrumb-item active" aria-current="page">Bulk Airtime</li>
      </ol><!-- End breadcrumb -->
      <div class="ms-auto">
          <div>
              {{-- <button class="btn btn-primary mb-4" wire:click="$set('showModal', true)">Add Notice</button> --}}
          </div>
      </div>
  </div>
  <!-- END PAGE HEADER -->
<style>
.no-hover{
    box-shadow: none;
}

</style>

  <!-- Noticeboard Table -->
  <div class="row">
      <div class="col-lg-12">

  <div class="e-panel card">
      <div class="card-header">
          {{-- <h2 class="card-title">1 - 30 of 546 users</h2> --}}
          <h2 class="card-title">1 - {{ $airtimes->count() }}  Printed Bulk Airtime</h2>
           <div class="page-options">
              <button class="btn btn-primary mb-4 no-hover" wire:click="$set('showModal', true)">Print Bulk Airtime</button>
          </div>

      </div>
  <div class="card-body">
  <table class="table table-bordered">
      <thead>
          <tr>
              <th>#</th>
              <th>Reference</th>
              <th>Business Name</th>
              <th>Network</th>
              <th>Amount</th>
              <th>Date Added</th>
              <th>Options</th>
          </tr>
      </thead>
      <tbody>
          @foreach($airtimes as $index => $airtime)
              <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $airtime->reference }}</td>
                  <td>{{ $airtime->business_name }}</td>
                  <td>{{ ucfirst($airtime->network) }}</td>
                  <td>{{ $airtime->amount }}</td>
                  <td>{{ $airtime->created_at->format('jS F Y') }}</td>
                  <td>
                      <div class="dropdown">
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                              Action
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <li><a class="dropdown-item" href="#" wire:click="viewDetails({{ $airtime->id }})">View Details</a></li>
                              {{-- <li><a class="dropdown-item" href="#">Edit</a></li> --}}
                              <li><a class="dropdown-item" href="#" wire:click="confirmDelete({{ $airtime->id }})">Delete</a></li>
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
                  <h5 class="modal-title">Print Bulk Airtime</h5>
                  <button type="button" class="close" wire:click="$set('showModal', false)">
                      <span>&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form wire:submit.prevent="submit">
                      <!-- Title -->
                      <div class="form-group">
                          <label for="business_name">Business Name</label>
                          <input type="text" id="business_name" wire:model="business_name" class="form-control" placeholder="Enter Business Name">
                          @error('business_name') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>

                        <!-- Visibility -->
                        <div class="form-group">
                            <label for="network">Network</label>
                            <select id="network" wire:model="network" class="form-control">
                                <option value="">Select Network</option>
                                <option value="MTN">MTN</option>
                                <option value="GLO">GLO</option>
                                <option value="AIRTEL">AIRTEL</option>
                                <option value="9MOBILE">9MOBILE</option>
                            </select>
                            @error('network') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                         <!-- Title -->
                      <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" wire:model="amount" class="form-control" placeholder="Enter Amount">
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                     <!-- Title -->
                     <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" wire:model="quantity" class="form-control" placeholder="Enter Quantity">
                        @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                      {{-- <!-- Description -->
                      <div class="form-group">
                          <label for="description">Quantity</label>
                          <textarea id="description" wire:model="description" class="form-control" placeholder="Enter Notice Description"></textarea>
                          @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                      </div> --}}


                      @if(session()->has('newsage_response'))
                      <div class="alert alert-info">
                          <pre>{{ print_r(session('newsage_response'), true) }}</pre>
                      </div>
                  @endif


                  @if(session()->has('success'))
                  <div class="alert alert-info">
                      <pre>{{ print_r(session('success'), true) }}</pre>
                  </div>
                 @endif
                      <!-- Submit Button -->
                      <button type="submit" class="btn btn-primary">Print</button>
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

  {{-- <!-- Modal backdrop to close the modal -->
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
  </div> --}}

  {{-- <!-- Modal backdrop to close the modal -->
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
  </div> --}}

  {{-- <!-- Modal backdrop to close the modal -->
  @if($viewingNoticeDetails)
      <div class="modal-backdrop fade show"></div>
  @endif --}}


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









{{--
<div>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="business_name">Business Name</label>
            <input type="text" id="business_name" wire:model="business_name" class="form-control">
            @error('business_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="network">Network</label>
            <select id="network" wire:model="network" class="form-control">
                <option value="">Select Network</option>
                <option value="MTN">MTN</option>
                <option value="AIRTEL">AIRTEL</option>
                <option value="GLO">GLO</option>
                <option value="9MOBILE">9Mobile</option>
            </select>
            @error('network') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" wire:model="amount" class="form-control">
            @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" wire:model="quantity" class="form-control">
            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div> --}}
