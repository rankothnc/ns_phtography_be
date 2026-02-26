<style>
    #viewItemModal * {
        /* font-family: 'Plus Jakarta Sans', sans-serif; */
        box-sizing: border-box;
    }

    #viewItemModal .modal-dialog {
        max-width: 800px;
    }

    #viewItemModal .modal-content {
        border: none;
        border-radius: 22px;
        overflow: hidden;
        background: #fff;
        box-shadow:
            0 0 0 1px rgba(139, 92, 246, 0.1),
            0 30px 70px rgba(109, 40, 217, 0.2),
            0 8px 24px rgba(0, 0, 0, 0.1);
    }

    /* ── Close button (top-right, floating) ── */
    #viewItemModal .btn-close {
        position: absolute;
        top: 30px;
        right: 30px;
        z-index: 10;
        width: 32px;
        height: 32px;
        border-radius: 0.5rem;
        background-color: rgba(255, 255, 255, 0.92);
        box-shadow: 0 2px 10px rgba(109, 40, 217, 0.25);
        opacity: 1;
        transition: background-color .2s, transform .2s;
        backdrop-filter: blur(4px);
        padding: 0;
    }

    /* ── Left: Image panel ── */
    #viewItemModal .vim-img-col {
        position: relative;
        background: #1a0a2e;
        min-height: 460px;
    }

    #viewItemModal .vim-img-col img {
        width: 100%;
        height: 100%;
        min-height: 460px;
        object-fit: cover;
        display: block;
        opacity: 0.9;
        transition: opacity .3s;
    }



    /* Purple gradient overlay on image bottom */
    #viewItemModal .vim-img-col::after {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    /* ── Right: Content panel ── */
    #viewItemModal .vim-content-col {
        background: #fff;
        padding: 3.5rem 1.8rem 0 1.8rem;
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    /* Title */
    #viewItemModal .vim-title {
        font-size: 1.65rem;
        font-weight: 800;
        color: #1e0a3c;
        line-height: 1.15;
        margin-bottom: 0.6rem;
        letter-spacing: -0.02em;
    }

    /* Category chip */
    #viewItemModal .vim-category {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 1rem;
        font-weight: 600;
        color: #75688d;
        margin-bottom: 0.9rem;
        width: fit-content;
    }

    /* Date row */
    #viewItemModal .vim-date-row {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: #626976;
        margin-bottom: 0.75rem;
    }

    #viewItemModal .vim-date-row i {
        color: #8a919d;
        font-size: 0.95rem;
    }

    /* Status badge */
    #viewItemModal .vim-status {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 0.1rem 0.5rem;
        border-radius: 999px;
        margin-bottom: 1.1rem;
        width: fit-content;
    }

    #viewItemModal .vim-status::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    #viewItemModal .vim-status.active {
        color: #16a34a;
        background: #f0fdf4;
        border: 1.5px solid #bbf7d0;
    }

    #viewItemModal .vim-status.inactive {
        color: #dc2626;
        background: #fff1f2;
        border: 1.5px solid #fecdd3;
    }

    #viewItemModal .vim-status.pending {
        color: #d97706;
        background: #fffbeb;
        border: 1.5px solid #fde68a;
    }

    /* Divider */
    #viewItemModal .vim-divider {
        height: 1px;
        background: linear-gradient(90deg, #ede9fe, transparent);
        margin-bottom: 1rem;
    }

    /* Short description */
    #viewItemModal .vim-short-label {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #8a919d;
        margin-bottom: 0.3rem;
    }

    #viewItemModal .vim-short-text {
        font-size: 0.9rem;
        font-weight: 400;
        color: #626976;
        line-height: 1.55;
        margin-bottom: 1rem;
    }

    /* Long description scrollable box */
    #viewItemModal .vim-long-label {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #8a919d;
        margin-bottom: 0.4rem;
    }

    #viewItemModal .vim-long-box {
        background: #e9e9e978;
        border: 1px solid #e9e9e9;
        border-radius: 12px;
        padding: 0.85rem 1rem;
        max-height: 216px;
        overflow-y: auto;
        font-size: 0.8rem;
        font-weight: 400;
        color: #626976;
        line-height: 1.65;
        scrollbar-width: thin;
        scrollbar-color: #c4b5fd #f5f3ff;
        flex-shrink: 0;
        text-align: justify;
    }

    #viewItemModal .vim-long-box::-webkit-scrollbar {
        width: 4px;
    }

    #viewItemModal .vim-long-box::-webkit-scrollbar-track {
        background: #f5f3ff;
        border-radius: 99px;
    }

    #viewItemModal .vim-long-box::-webkit-scrollbar-thumb {
        background: #c4b5fd;
        border-radius: 99px;
    }

    /* ── Footer ── */
    #viewItemModal .vim-footer {
        padding: 1.2rem 1.8rem 1.6rem 1.8rem;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.65rem;
        background: #fff;
    }

    #viewItemModal .vim-btn-close {
        font-size: 0.78rem;
        font-weight: 600;
        color: #7c3aed;
        background: #f5f3ff;
        border: 1.5px solid #ddd6fe;
        padding: 0.55rem 1.5rem;
        border-radius: 12px;
        transition: all .2s;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    #viewItemModal .vim-btn-close:hover {
        background: #ede9fe;
        border-color: #c4b5fd;
    }

    #viewItemModal .vim-btn-edit {
        font-size: 0.78rem;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        border: none;
        padding: 0.55rem 1.5rem;
        border-radius: 12px;
        transition: all .22s;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(124, 58, 237, 0.38);
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    #viewItemModal .vim-btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(124, 58, 237, 0.48);
    }

    /* ── Modal entrance animation ── */
    #viewItemModal.fade .modal-dialog {
        transform: scale(0.96) translateY(16px);
        transition: transform .32s cubic-bezier(.22, 1, .36, 1), opacity .32s ease;
    }

    #viewItemModal.show .modal-dialog {
        transform: scale(1) translateY(0);
    }

    .vim-meta-row {
        display: flex;
        align-items: center;
        gap: 30px;
        /* space between items */
        flex-wrap: wrap;
        /* optional: moves to next line on very small screens */
    }

    .vim-date-row {
        display: flex;
        align-items: center;
        gap: 6px;
    }
</style>
<x-app-layout>
    {{-- Success Alert --}}
    @if (session('success'))
        <div id="alert-success" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Alert --}}
    @if ($errors->any())
        <div id="alert-error" class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
        <h1 class="mb-0 fw-bold display-6">All Items</h1>

        <a href="{{ route('image-items.create') }}" class="btn btn-primary">
            Add New Item
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('image-items.index') }}">
                <div class="row g-3">

                    <!-- Title search -->
                    <div class="col-md-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ request('title') }}" list="titleList"
                            class="form-control" placeholder="Search by title">

                        <datalist id="titleList">
                            @foreach ($titles as $t)
                                <option value="{{ $t->image_title }}">
                            @endforeach
                        </datalist>
                    </div>

                    <!-- Category search -->
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->ic_id }}"
                                    {{ request('category_id') == $cat->ic_id ? 'selected' : '' }}>
                                    {{ $cat->ic_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Captured date -->
                    <div class="col-md-2">
                        <label class="form-label">From Date</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">To Date</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
                    </div>
                    <!-- Status -->
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="delete" {{ request('status') == 'delete' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-end gap-2">

                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>

                        <a href="{{ route('image-items.index') }}" class="btn btn-outline-secondary">
                            Reset
                        </a>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Striped Rows -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Short Description</th>
                        <th>Captured Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($items as $index => $item)
                        <tr>
                            <td><strong>{{ $items->firstItem() ? $items->firstItem() + $index : $index + 1 }}</strong>
                            </td>

                            <td>
                                <strong>{{ $item->image_title }}</strong>
                            </td>

                            <td>
                                <img src="{{ asset($item->image_path) }}" alt="Image" class="img-fluid"
                                    width="100" height="100">
                            </td>

                            <td>
                                {{ $item->category ? $item->category->ic_name : '-' }}
                            </td>

                            <td>
                                {{ $item->image_desc_short }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->capture_date)->format('d M Y') }}
                            </td>

                            <td>
                                @if ($item->status == 'active')
                                    <span class="badge bg-label-primary me-1">Active</span>
                                @else
                                    <span class="badge bg-label-secondary me-1">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>

                                    <div class="dropdown-menu">
                                        <!-- View item -->
                                        <a class="dropdown-item text-primary" href="#" data-bs-toggle="modal"
                                            data-bs-target="#viewItemModal" data-id="{{ $item->ii_id }}">
                                            <i class="bx bx-show me-1"></i> View
                                        </a>

                                        <!-- Edit item -->
                                        <a class="dropdown-item text-warning"
                                            href="{{ route('image-items.edit', $item->ii_id) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>

                                        @if ($item->status === 'active')
                                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                                data-bs-target="#statusModal" data-id="{{ $item->ii_id }}"
                                                data-status="delete"
                                                data-message="Are you sure you want to delete this item?">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        @else
                                            <a class="dropdown-item text-success" href="#" data-bs-toggle="modal"
                                                data-bs-target="#statusModal" data-id="{{ $item->ii_id }}"
                                                data-status="active" data-message="Do you want to activate this item?">
                                                <i class="bx bx-check me-1"></i> Activate
                                            </a>
                                        @endif

                                    </div>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No items added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <div class="d-flex justify-content-end mt-3">
                                {{ $items->links('pagination::bootstrap-5') }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!--/ Striped Rows -->

    <!-- Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" id="statusForm">
                @csrf

                <input type="hidden" name="status" id="statusInput">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Action</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p id="statusMessage"></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            No
                        </button>
                        <button type="submit" class="btn" id="confirmBtn">
                            Yes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Status Modal -->

    <!-- View Item Modal -->
    <div class="modal fade" id="viewItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content position-relative">

                <!-- Floating close button (top-right as in sketch) -->
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                <div class="row g-0" style="min-height:460px;">

                    <!-- LEFT: Image -->
                    <div class="col-md-5 vim-img-col">
                        <img id="modalImage"
                            src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80"
                            alt="Item image" />
                    </div>

                    <!-- RIGHT: Content -->
                    <div class="col-md-7 d-flex flex-column">
                        <div class="vim-content-col flex-grow-1">

                            <!-- Title -->
                            <h4 class="vim-title" id="modalTitle"></h4>

                            <div class="vim-meta-row">
                                <!-- Category -->
                                <span class="vim-category" id="modalCategory">
                                    <i class="bi bi-grid-fill"></i>
                                </span>

                                <!-- Captured Date -->
                                <div class="vim-date-row">
                                    <i class="bi bi-calendar3"></i>
                                    <span id="modalDate"></span>
                                </div>

                                <!-- Status -->
                                <span class="vim-status active" id="modalStatus"></span>
                            </div>

                            <div class="vim-divider"></div>

                            <!-- Short Description -->
                            {{-- <p class="vim-short-label">Short Description</p> --}}
                            <p class="vim-short-text" id="modalShort">

                            </p>

                            <!-- Long Description -->
                            {{-- <p class="vim-long-label">Description</p> --}}
                            <div class="vim-long-box" id="modalLong">

                            </div>

                        </div>

                        <!-- Footer inside right col -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <a href="#" class="btn btn-primary" id="modalEditBtn"
                                data-edit-url-template="{{ route('image-items.edit', ':id') }}">
                                Edit Item
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    const statusModal = document.getElementById('statusModal');

    statusModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const itemId = button.getAttribute('data-id');
        const status = button.getAttribute('data-status');
        const message = button.getAttribute('data-message');

        // Set message & hidden input
        document.getElementById('statusMessage').textContent = message;
        document.getElementById('statusInput').value = status;

        // Set form action
        const form = document.getElementById('statusForm');
        form.action = `/image-items/status/${itemId}`;

        // Change button color
        const confirmBtn = document.getElementById('confirmBtn');
        confirmBtn.classList.remove('btn-danger', 'btn-success');

        if (status === 'delete') {
            confirmBtn.classList.add('btn-danger');
        } else {
            confirmBtn.classList.add('btn-success');
        }
    });

    //alert timeout
    setTimeout(() => {
        const successAlert = document.getElementById('alert-success');
        const errorAlert = document.getElementById('alert-error');

        if (successAlert) {
            successAlert.style.transition = 'opacity 0.5s';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 500);
        }

        if (errorAlert) {
            errorAlert.style.transition = 'opacity 0.5s';
            errorAlert.style.opacity = '0';
            setTimeout(() => errorAlert.remove(), 500);
        }
    }, 5000);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const modal = document.getElementById('viewItemModal');
        const editBtn = document.getElementById('modalEditBtn');

        modal.addEventListener('show.bs.modal', function(event) {

            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            fetch(`/image-items/${id}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById('modalTitle').textContent = data.image_title;
                    document.getElementById('modalImage').src = '/' + data.image_path;
                    document.getElementById('modalCategory').textContent =
                        data.category ? data.category.ic_name : '-';
                    document.getElementById('modalShort').textContent =
                        data.image_desc_short ?? '-';
                    document.getElementById('modalLong').textContent =
                        data.image_desc_long ?? '-';
                    document.getElementById('modalDate').textContent = data.capture_date;
                    document.getElementById('modalStatus').textContent = data.status;

                    // ✅ CORRECT EDIT URL (Laravel-safe)
                    const template = editBtn.dataset.editUrlTemplate;
                    editBtn.href = template.replace(':id', data.ii_id);
                });
        });

    });
</script>
