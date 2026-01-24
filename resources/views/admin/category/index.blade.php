@extends('admin.layouts.app')

@section('contents')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Categories</span>
                        <button class="btn btn-primary" id="btn-new">New</button>
                    </div>
                    <div class="card-body">
                        <div id="category-tree" class="dd">

                        </div>
                        <div id="tree-loading" class="d-none my-2 text-center">
                            <div class="spinner-border"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><span id="category-title">Create Category</span></div>
                    <div class="card-body">
                        <form action="" id="category-form">
                            <input type="hidden" id="category-id">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label for="" class="form-label">Icon <span
                                                class="text-danger"></span></label>
                                        <x-input-image imageUploadId="image-upload" imagePreviewId="image-preview"
                                            imageLabelId="image-label" name="icon" />
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="mb-2">
                                        <label for="" class="form-label">Image <span
                                                class="text-danger"></span></label>
                                        <x-input-image imageUploadId="image-upload-two" imagePreviewId="image-preview-two"
                                            imageLabelId="image-label-two" name="image" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required id="name">
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" class="form-control" required id="slug">
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Parent Category <span
                                        class="text-danger">*</span></label>
                                <select name="parent_id" class="form-select" id="parent_id">
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-check form-switch form-switch-3">
                                            <input class="form-check-input" type="checkbox" name="is_featured"
                                                id="is_featured">
                                            <span class="form-check-label">is featured</span>
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-check form-switch form-switch-3">
                                            <input class="form-check-input" type="checkbox" checked="" name="is_active"
                                                id="is_active">
                                            <span class="form-check-label">Active</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
                                <button type="button" class="btn btn-danger d-none" id="btn-delete">Delete</button>
                                <button type="button" class="btn btn-secondary" id="btn-cancel">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        $(function() {

            $('#category-form').submit(function(e) {
                e.preventDefault();
                let id = $('#category-id').val();
                let method = id ? 'PUT' : 'POST';
                let url = "{{ route('admin.categories.store') }}";
                 let formData = new FormData();
                formData.append('name', $('#name').val());
                formData.append('slug', $('#slug').val());
                formData.append('parent_id', $('#parent_id').val());
                formData.append('is_active', $('#is_active').is(':checked') ? 1 : 0);
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('is_featured', $('#is_featured').is(':checked') ? 1 : 0);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        notyf.success(response.message);

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                    }
                })
            });

            // load parent dropdown
            function loadParentDropdown(selectedId, excludeId) {
                $.get("{{ route('admin.categories.nested') }}", function(data) {
                    let options = '<option value="">None (Root)</option>';

                    function addOptions(cats, prefix, depth) {
                        cats.forEach(function(cat) {
                            if (cat.id == excludeId) return;
                            options +=
                                `<option value="${cat.id}" ${selectedId == cat.id ? 'selected' : '' } > ${prefix}${cat.name}</option>`;
                            if (cat.children_nested && cat.children_nested.length) {
                                addOptions(cat.children_nested, prefix + '--', depth + 1);
                            }
                        })
                    }

                    addOptions(data, '', 0);

                    $('#parent_id').html(options);

                })
            }

            // slug auto-generate

            // clear form
            function clearForm() {
                $('#category-form')[0].reset();
                $('#category-title').text('Create Category');
                $('#name').val('');
                $('#slug').val('');
                $('#parent_id').val('');
                $('#is_active').prop('checked', true);
                loadParentDropdown(null, null);
                $('#category-id').val('');
            }

            // Initial Load
            clearForm();
            // loadTree();
        })
    </script>
@endpush
