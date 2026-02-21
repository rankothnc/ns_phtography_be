<style>
    /* ── Upload Card ── */
    .upload-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(105, 108, 255, 0.12), 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .upload-card .card-header {
        border: none;
        padding: 1rem 1.4rem;
        position: relative;
        overflow: hidden;
    }

    .upload-card .card-header::after {
        content: '';
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
        top: -40px;
        right: -20px;
        pointer-events: none;
    }

    .upload-card .card-header h5 {
        color: #566a7f;
        text-transform: uppercase;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.01em;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .upload-card .card-header h5 i {
        font-size: 1rem;
        opacity: 0.85;
    }

    .upload-card .card-body {
        background: #fff;
        padding: 1.4rem;
        padding-top: 1rem !important;
    }

    /* ── Drop Zone ── */
    .upload-dropzone {
        border: 2px dashed #d4d4ff;
        border-radius: 16px;
        background: #f5f5ff;
        padding: 2.2rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all .25s ease;
        position: relative;
    }

    .upload-dropzone:hover,
    .upload-dropzone.dragover {
        border-color: #8b8eff;
        background: #f5f0ff;
        box-shadow: 0 0 0 4px rgba(105, 108, 255, 0.1);
    }

    /* Hidden real input */
    .upload-dropzone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-icon-wrap {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #eeeeff, #f0f0ff);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        border: 1.5px solid #d4d4ff;
        transition: all .25s;
    }

    .upload-dropzone:hover .upload-icon-wrap {
        background: linear-gradient(135deg, #696cff, #8b8eff);
        border-color: transparent;
        box-shadow: 0 6px 18px rgba(105, 108, 255, 0.35);
    }

    .upload-icon-wrap i {
        font-size: 1.6rem;
        color: #696cff;
        transition: color .25s;
    }

    .upload-dropzone:hover .upload-icon-wrap i {
        color: #fff;
    }

    .upload-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1a1a40;
        margin-bottom: 0.25rem;
    }

    .upload-subtitle {
        font-size: 0.75rem;
        color: #9ca3af;
        margin-bottom: 1rem;
    }

    .upload-subtitle span {
        color: #696cff;
        font-weight: 600;
    }

    .upload-formats {
        display: flex;
        justify-content: center;
        gap: 0.4rem;
        flex-wrap: wrap;
    }

    .upload-format-chip {
        font-size: 0.62rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #696cff;
        background: #eeeeff;
        border: 1px solid #d4d4ff;
        border-radius: 999px;
        padding: 0.2rem 0.6rem;
    }

    /* ── Preview ── */
    .upload-preview {
        width: 100%;
        height: 100%;
        display: none;
        flex-direction: column;
    }

    .upload-preview img {
        width: 100%;
        height: auto;
        max-height: calc(100vh - 220px);
        object-fit: contain;
        background: #f5f5ff;
        display: block;
    }

    .upload-preview-bar {
        background: linear-gradient(135deg, #696cff, #8b8eff);
        padding: 0.55rem 0.9rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
    }

    .upload-preview-name {
        font-size: 0.72rem;
        font-weight: 600;
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 75%;
    }

    .upload-preview-remove {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: #fff;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: background .2s;
        padding: 0;
    }

    .upload-preview-remove:hover {
        background: rgba(255, 255, 255, 0.35);
    }
</style>
<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
        <h1 class="mb-0 fw-bold display-6">
            {{ isset($item) ? 'Edit Item' : 'Add New Item' }}
        </h1>

        <a href="{{ route('image-items.index') }}" class="btn btn-primary">
            View All Items
        </a>
    </div>

    <div class="row align-items-stretch">
        <div class="col-12">
            <form action="{{ isset($item) ? route('image-items.update', $item->ii_id) : route('image-items.add') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($item))
                    @method('PUT')
                @endif
                @csrf
                <div class="row">
                    <div class="col-12 col-xl-6 d-flex flex-column">
                        <div class="card mb-4 w-100 h-100 flex-grow-1">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="category-select">Category</label>
                                    <div class="mb-3">
                                        <select name="ic_id" class="form-control" id="category-select" required>
                                            @if ($categories->count() > 0)
                                                <option value="">Select a category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->ic_id }}"
                                                        {{ isset($item) && $item->ic_id == $category->ic_id ? 'selected' : '' }}>
                                                        {{ $category->ic_name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">No active categories</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="img-ttl">Title</label>
                                    <input type="text" class="form-control" name="image_title" id="img-ttl"
                                        value="{{ $item->image_title ?? '' }}" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="shrt-desc">Short Description</label>
                                    <input type="text" class="form-control" name="image_desc_short"
                                        value="{{ $item->image_desc_short ?? '' }}" id="shrt-desc" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-date">Captured Date</label>
                                    <div class="input-group input-group-merge">
                                        <input type="date" id="basic-default-date" name="capture_date"
                                            class="form-control" value="{{ $item->capture_date ?? '' }}"
                                            aria-describedby="basic-default-date2" max="{{ date('Y-m-d') }}"
                                            required />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="img-desc">Description</label>
                                    <textarea id="img-desc" name="image_desc_long" class="form-control">{{ $item->image_desc_long ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="img-status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="active"
                                            {{ isset($item) && $item->status == 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="delete"
                                            {{ isset($item) && $item->status == 'delete' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 d-flex flex-column">
                        <div class="card upload-card mb-4 w-100 h-100 flex-grow-1">
                            <!-- Header -->
                            <div class="card-header">
                                <h5><i class="bi bi-image-fill"></i> Image Upload</h5>
                            </div>
                            <!-- Body -->
                            <div class="card-body d-flex flex-column">
                                <!-- Drop zone -->
                                <div class="upload-dropzone {{ isset($item->image_path) ? 'd-none' : '' }}"
                                    id="uploadDropzone">
                                    <input type="file" name="image" id="image" accept="image/*" />

                                    <div class="upload-icon-wrap">
                                        <i class="bi bi-cloud-arrow-up-fill"></i>
                                    </div>
                                    <p class="upload-title">Drop your image here</p>
                                    <p class="upload-subtitle">or <span>browse to upload</span></p>
                                    <div class="upload-formats">
                                        <span class="upload-format-chip">JPG</span>
                                        <span class="upload-format-chip">PNG</span>
                                        <span class="upload-format-chip">WEBP</span>
                                        <span class="upload-format-chip">GIF</span>
                                    </div>
                                </div>

                                <!-- Preview -->
                                <div class="upload-preview {{ isset($item->image_path) ? 'd-flex' : 'd-none' }}"
                                    id="uploadPreview">
                                    <img id="previewImg"
                                        src="{{ isset($item->image_path) ? asset($item->image_path) : '' }}"
                                        alt="Preview" />

                                    <div class="upload-preview-bar">
                                        <span class="upload-preview-name" id="previewName">
                                            {{ isset($item->image_path) ? basename($item->image_path) : '' }}
                                        </span>

                                        <button type="button" class="upload-preview-remove" id="removeBtn"
                                            title="Remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($item) ? 'Update' : 'Save' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

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
    document.addEventListener('DOMContentLoaded', () => {

        const fileInput = document.getElementById('image');
        const dropzone = document.getElementById('uploadDropzone');
        const preview = document.getElementById('uploadPreview');
        const previewImg = document.getElementById('previewImg');
        const previewName = document.getElementById('previewName');
        const removeBtn = document.getElementById('removeBtn');

        // When selecting a new image
        fileInput?.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            previewImg.src = URL.createObjectURL(file);
            previewName.textContent = file.name;

            dropzone.classList.add('d-none');
            preview.classList.remove('d-none');
            preview.classList.add('d-flex');
        });

        // Remove image preview
        removeBtn?.addEventListener('click', () => {
            fileInput.value = '';
            preview.classList.add('d-none');
            dropzone.classList.remove('d-none');
        });

    });
</script>
