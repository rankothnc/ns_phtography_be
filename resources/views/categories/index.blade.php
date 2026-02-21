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

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="deleteErrorContainer"></div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
        <h1 class="mb-0 fw-bold display-6">Categories</h1>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            Add New Category
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="categoryForm" action="{{ route('categories.store') }}">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category Name *</label>
                            <input type="text" id="ic_name" name="ic_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="delete">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">
                            Save
                        </button>
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
                        <th>Category</th>
                        <th>Description</th>
                        <th>Item Count</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td><strong>{{ $categories->firstItem() ? $categories->firstItem() + $index : $index + 1 }}</strong>
                            </td>

                            <td>
                                <strong>{{ $category->ic_name }}</strong>
                            </td>

                            <td>
                                {{ $category->description }}
                            </td>

                            <td>
                                {{ $category->items_count }}
                            </td>

                            <td>
                                @if ($category->status == 'active')
                                    <span class="badge bg-label-primary me-1">Active</span>
                                @else
                                    <span class="badge bg-label-secondary me-1">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <div class="dropdown w-auto">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-warning edit-category-btn"
                                            href="javascript:void(0)" data-id="{{ $category->ic_id }}"
                                            data-name="{{ $category->ic_name }}"
                                            data-description="{{ $category->description }}"
                                            data-status="{{ $category->status }}" data-bs-toggle="modal"
                                            data-bs-target="#addCategoryModal">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>

                                        @if ($category->status === 'active')
                                            <a class="dropdown-item text-danger delete-category" href="#"
                                                data-bs-toggle="modal" data-bs-target="#statusModal"
                                                data-id="{{ $category->ic_id }}" data-status="delete"
                                                data-items="{{ $category->items_count }}"
                                                data-message="Are you sure you want to delete this category?">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        @else
                                            <a class="dropdown-item text-success" href="#" data-bs-toggle="modal"
                                                data-bs-target="#statusModal" data-id="{{ $category->ic_id }}"
                                                data-status="active"
                                                data-message="Do you want to activate this category?">
                                                <i class="bx bx-check me-1"></i> Activate
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No Categories added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="d-flex justify-content-end mt-3">
                                {{ $categories->links('pagination::bootstrap-5') }}
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


</x-app-layout>

<script>
    const statusModal = document.getElementById('statusModal');

    statusModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const itemCount = parseInt(button.getAttribute('data-items'));
        const status = button.getAttribute('data-status');

        if (status === 'delete' && itemCount > 0) {
            event.preventDefault(); 

            const container = document.getElementById('deleteErrorContainer');
            container.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                This category cannot be deleted because it still contains associated images.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
            return;
        }

        const categoryId = button.getAttribute('data-id');
        const message = button.getAttribute('data-message');

        document.getElementById('statusMessage').textContent = message;
        document.getElementById('statusInput').value = status;

        const form = document.getElementById('statusForm');
        form.action = `/categories/status/${categoryId}`;

        const confirmBtn = document.getElementById('confirmBtn');
        confirmBtn.classList.remove('btn-danger', 'btn-success');

        confirmBtn.classList.add(
            status === 'delete' ? 'btn-danger' : 'btn-success'
        );
    });
</script>


<script>
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

        const modal = document.getElementById('addCategoryModal');
        const form = document.getElementById('categoryForm');
        const modalTitle = document.getElementById('categoryModalTitle');
        const saveBtn = document.getElementById('saveBtn');

        modal.addEventListener('show.bs.modal', function(event) {

            const button = event.relatedTarget;

            // If opened by Edit button
            if (button && button.classList.contains('edit-category-btn')) {

                document.getElementById('ic_name').value = button.dataset.name;
                document.getElementById('description').value = button.dataset.description;
                document.getElementById('status').value = button.dataset.status;

                modalTitle.textContent = 'Edit Category';
                saveBtn.textContent = 'Save Changes';

                form.action = `/categories/update/${button.dataset.id}`;
            }
            // If opened by Add button
            else {
                form.reset();
                modalTitle.textContent = 'Add New Category';
                saveBtn.textContent = 'Save';
                form.action = "{{ route('categories.store') }}";
            }
        });

    });
</script>
