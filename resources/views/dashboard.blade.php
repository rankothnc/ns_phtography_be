<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="font-size:1.4rem;">
                    Welcome back, {{ auth()->user()->name }}
                </h4>
                <p class="text-muted mb-0" style="font-size:.875rem;">{{ now()->format('l, F j, Y') }}</p>
            </div>
            <a href="{{ route('image-items.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> New Item
            </a>
        </div>

        <!-- ─── STAT CARDS ─── -->
        <div class="row g-4 mb-4">

            <!-- Total Photos -->
            <div class="col-sm-6 col-xl-4">
                <div class="card h-100 stat-card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-stretch h-100">

                            <!-- Coloured left accent strip -->
                            <div class="stat-accent d-flex align-items-center justify-content-center px-4"
                                style="background:linear-gradient(160deg,#696cff,#9b8fff);min-width:90px;">
                                <i class="bx bx-images" style="font-size:2rem;color:#fff;"></i>
                            </div>

                            <!-- Content -->
                            <div class="d-flex flex-column justify-content-center px-4 py-3 flex-grow-1">
                                <p class="mb-1 text-muted fw-semibold text-uppercase"
                                    style="font-size:.7rem;letter-spacing:.8px;">Total Photos</p>
                                <h3 class="mb-0 fw-bold" style="font-size:1.8rem;color:#2b2c40;line-height:1;">
                                    {{ $totalPhotos ?? '0' }}
                                </h3>
                                <div class="mt-2">
                                    <span class="badge" style="background:#eeeeff;color:#696cff;font-size:.7rem;">
                                        <i class="bx bx-image-alt me-1"></i>All time uploads
                                    </span>
                                </div>
                            </div>

                            <!-- Background watermark icon -->
                            <div class="stat-watermark" style="color:#696cff;">
                                <i class="bx bx-images"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-sm-6 col-xl-4">
                <div class="card h-100 stat-card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-stretch h-100">

                            <div class="stat-accent d-flex align-items-center justify-content-center px-4"
                                style="background:linear-gradient(160deg,#ff9f43,#ffbe76);min-width:90px;">
                                <i class="bx bx-folder-open" style="font-size:2rem;color:#fff;"></i>
                            </div>

                            <div class="d-flex flex-column justify-content-center px-4 py-3 flex-grow-1">
                                <p class="mb-1 text-muted fw-semibold text-uppercase"
                                    style="font-size:.7rem;letter-spacing:.8px;">Categories</p>
                                <h3 class="mb-0 fw-bold" style="font-size:1.8rem;color:#2b2c40;line-height:1;">
                                    {{ $totalCategories ?? '0' }}
                                </h3>
                                <div class="mt-2">
                                    <span class="badge" style="background:#fff4e6;color:#ff9f43;font-size:.7rem;">
                                        <i class="bx bx-collection me-1"></i>Active collections
                                    </span>
                                </div>
                            </div>

                            <div class="stat-watermark" style="color:#ff9f43;">
                                <i class="bx bx-folder-open"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Uploaded This Month -->
            <div class="col-sm-6 col-xl-4">
                <div class="card h-100 stat-card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-stretch h-100">

                            <div class="stat-accent d-flex align-items-center justify-content-center px-4"
                                style="background:linear-gradient(160deg,#28c76f,#48da89);min-width:90px;">
                                <i class="bx bx-calendar-check" style="font-size:2rem;color:#fff;"></i>
                            </div>

                            <div class="d-flex flex-column justify-content-center px-4 py-3 flex-grow-1">
                                <p class="mb-1 text-muted fw-semibold text-uppercase"
                                    style="font-size:.7rem;letter-spacing:.8px;">Uploaded This Month</p>
                                <h3 class="mb-0 fw-bold" style="font-size:1.8rem;color:#2b2c40;line-height:1;">
                                    {{ $uploadedThisMonth ?? '0' }}
                                </h3>
                                <div class="mt-2">
                                    <span class="badge" style="background:#e8faf1;color:#28c76f;font-size:.7rem;">
                                        <i class="bx bx-calendar me-1"></i>{{ now()->format('F Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="stat-watermark" style="color:#28c76f;">
                                <i class="bx bx-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Storage -->
            {{-- <div class="col-sm-6 col-xl-3">
        <div class="card h-100">
          <div class="card-body d-flex align-items-center gap-3">
            <div class="avatar flex-shrink-0">
              <span class="avatar-initial rounded bg-label-info">
                <i class="bx bx-server bx-sm"></i>
              </span>
            </div>
            <div class="w-100">
              <p class="mb-0 text-muted" style="font-size:.8rem;">Storage Used</p>
              <h5 class="mb-0 fw-bold">{{ $storageUsed ?? '0 GB' }}</h5>
              <div class="progress mt-1" style="height:5px;">
                <div class="progress-bar bg-info" style="width:{{ $storagePercent ?? 0 }}%"></div>
              </div>
              <small class="text-muted">{{ $storagePercent ?? 0 }}% of {{ $storageTotal ?? '0 GB' }}</small>
            </div>
          </div>
        </div>
      </div> --}}

        </div>
        <!-- /STAT CARDS -->

        <!-- ─── MIDDLE ROW: Recent Uploads + Quick Actions ─── -->
        <div class="row g-4 mb-4">

            <!-- Recent Uploads -->
            <div class="col-lg-7">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Recent Uploads</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('image-items.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bx bx-filter-alt me-1"></i>View All
                            </a>
                            <a href="{{ route('image-items.create') }}" class="btn btn-sm btn-primary">
                                <i class="bx bx-plus me-1"></i>Upload
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (isset($recentItems) && $recentItems->count())
                            <div class="row g-3">
                                @foreach ($recentItems->take(5) as $item)
                                    <div class="col-4">
                                        <div class="position-relative rounded overflow-hidden" style="aspect-ratio:1;">
                                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->image_title }}"
                                                class="w-100 h-100 object-fit-cover" style="object-fit:cover;">
                                            <div class="position-absolute bottom-0 start-0 end-0 p-2"
                                                style="background:linear-gradient(to top,rgba(0,0,0,.65),transparent);">
                                                <span class="badge bg-primary" style="font-size:.7rem; background-color:#6f6f9299 !important;">
                                                    {{ $item->category?->ic_name ?? 'Uncategorized' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Add Photo Card -->
                                <div class="col-4">
                                    <a href="{{ route('image-items.create') }}"
                                        class="d-flex flex-column align-items-center justify-content-center rounded text-primary text-decoration-none h-100"
                                        style="aspect-ratio:1;border:2px dashed #696cff;background:#f5f5ff;transition:.2s;"
                                        onmouseover="this.style.background='#e7e7ff'"
                                        onmouseout="this.style.background='#f5f5ff'">
                                        <i class="bx bx-plus bx-md"></i>
                                        <small class="fw-semibold mt-1">Add Photo</small>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bx bx-image-add bx-lg text-muted mb-3 d-block"></i>
                                <p class="text-muted mb-3">No photos uploaded yet.</p>
                                <a href="{{ route('image-items.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bx bx-plus me-1"></i>Upload First Photo
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- ─── CATEGORIES CARD ─── -->
            <div class="col-lg-5">
                <div class="card h-100 d-flex flex-column">

                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-0">Categories</h5>
                            <small class="text-muted">{{ $categories->count() }} total</small>
                        </div>
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-plus me-1"></i>Add New
                        </a>
                    </div>

                    <!-- Scrollable list fills remaining card height -->
                    <div class="card-body p-0 flex-grow-1 overflow-auto" style="max-height:360px;">

                        @php
                            // Cycle through Sneat label colours for variety
                            $colours = ['primary', 'success', 'warning', 'info', 'danger', 'secondary'];
                        @endphp

                        @forelse($categories as $index => $category)
                            @php $colour = $colours[$index % count($colours)]; @endphp
                            <div class="d-flex align-items-center gap-3 px-4 py-3 category-row border-bottom">

                                <!-- Icon avatar -->
                                <div class="avatar avatar-sm flex-shrink-0">
                                    <span class="avatar-initial rounded-circle bg-label-{{ $colour }}">
                                        <i class="bx bx-folder"></i>
                                    </span>
                                </div>

                                <!-- Name + item count bar -->
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-semibold text-truncate" style="font-size:.875rem;">
                                            {{ $category->ic_name }}
                                        </span>
                                        <span class="text-muted ms-2 flex-shrink-0" style="font-size:.75rem;">
                                            {{ $category->items_count }} photos
                                        </span>
                                    </div>
                                    <div class="progress" style="height:4px;border-radius:99px;">
                                        @php
                                            $max = $categories->max('items_count') ?: 1;
                                            $pct = round(($category->items_count / $max) * 100);
                                        @endphp
                                        <div class="progress-bar bg-{{ $colour }}"
                                            style="width:{{ $pct }}%;border-radius:99px;"
                                            title="{{ $pct }}%"></div>
                                    </div>
                                </div>

                                <!-- Status badge -->
                                <div class="flex-shrink-0">
                                    @if ($category->status === 'active')
                                        <span class="badge bg-label-success" style="font-size:.7rem;">Active</span>
                                    @else
                                        <span class="badge bg-label-secondary" style="font-size:.7rem;">Draft</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div
                                class="d-flex flex-column align-items-center justify-content-center h-100 py-5 text-center">
                                <i class="bx bx-folder-open bx-lg text-muted mb-2"></i>
                                <p class="text-muted mb-3" style="font-size:.875rem;">No categories yet.</p>
                                <a href="{{ route('image-categories.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bx bx-plus me-1"></i>Create First Category
                                </a>
                            </div>
                        @endforelse

                    </div>

                    <!-- Footer summary -->
                    @if ($categories->count())
                        <div class="card-footer d-flex align-items-center justify-content-between py-2 px-4"
                            style="background:#f9f9ff;border-top:1px solid #ebebff;">
                            <small class="text-muted">
                                <i class="bx bx-check-circle text-success me-1"></i>
                                {{ $categories->where('status', 'active')->count() }} active
                            </small>
                            <small class="text-muted">
                                <i class="bx bx-image text-primary me-1"></i>
                                {{ $categories->sum('items_count') }} photos total
                            </small>
                            <a href="{{ route('categories.index') }}"
                                class="btn btn-xs btn-outline-primary py-1 px-2" style="font-size:.75rem;">
                                Manage All
                            </a>
                        </div>
                    @endif

                </div>
            </div>
            <!-- /CATEGORIES CARD -->

        </div>

        <style>
            .category-row {
                transition: background .15s;
            }

            .category-row:hover {
                background: #f5f5ff;
            }

            .category-row:last-child {
                border-bottom: none !important;
            }

            .category-edit-btn {
                opacity: 0;
                transition: opacity .15s;
                font-size: 1rem;
            }

            .category-row:hover .category-edit-btn {
                opacity: 1;
            }
        </style>
        <!-- /MIDDLE ROW -->

    </div><!-- /container -->

    <style>
        .quick-action-btn {
            transition: all .2s;
            text-decoration: none;
        }

        .quick-action-btn:hover {
            border-color: #696cff !important;
            background: #f0f0ff;
            transform: translateY(-2px);
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(43, 44, 64, 0.08);
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(43, 44, 64, 0.14);
        }

        .stat-accent {
            border-radius: 0;
            position: relative;
        }

        .stat-watermark {
            position: absolute;
            right: -10px;
            bottom: -8px;
            font-size: 5rem;
            opacity: .06;
            pointer-events: none;
            line-height: 1;
        }
    </style>

</x-app-layout>
