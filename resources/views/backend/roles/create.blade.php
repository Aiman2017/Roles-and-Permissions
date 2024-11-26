@extends('backend.app.app')


@section('title', 'Create roles')

@section('content')
    <div class="container mt-5">
        <h2>Создать новую роль</h2>

        <div class="card mt-3">
            <div class="card-body">
                @include('backend.app.errors')
                <form action="{{route('admin.roles.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="roleName" class="form-label">Название роли</label>
                        <input type="text" class="form-control" id="roleName" name="name"
                               placeholder="Введите название роли">
                    </div>
                                        <div class="mb-3">
                                            <label for="roleDescription" class="form-label">Описание роли</label>
                                            <textarea class="form-control" id="roleDescription" name="description" rows="4"
                                                      placeholder="Введите описание роли"></textarea>
                                        </div>

                    <div class="mb-3">
                        <!-- Global Select All Checkbox for the entire form -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="select_all">
                            <label class="form-check-label" for="select_all">Select All Permissions</label>
                        </div>

                        @foreach(config('permissions') as $key => $abilities)
                            <fieldset class="border p-3 mb-3">
                                <legend class="w-auto">{{ $key }}</legend>

                                <!-- Select All Checkbox for the current category/group -->
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="select_all_{{ $loop->index }}">
                                    <label class="form-check-label" for="select_all_{{ $loop->index }}">Select All {{ $key }}</label>
                                </div>

                                <div class="row">
                                    @foreach($abilities as $code => $ability)
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input ability-checkbox"
                                                       name="abilities[{{ $code }}]"
                                                       id="permission_{{ $loop->parent->index }}_{{ $loop->index }}"
                                                       value="on"
                                                    {{ old('abilities.' . $code) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission_{{ $loop->parent->index }}_{{ $loop->index }}">
                                                    {{ $ability }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                        @endforeach
                    </div>



                    <button type="submit" class="btn btn-primary">Создать роль</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Global "Select All" functionality: Selects all checkboxes in the entire form
        document.getElementById('select_all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.ability-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Handle "Select All" for each permission group (categories, users, etc.)
        document.querySelectorAll('.form-check-input[id^="select_all_"]').forEach(selectAllCheckbox => {
            selectAllCheckbox.addEventListener('change', function() {
                // Get all checkboxes in the same fieldset
                const fieldset = this.closest('fieldset');
                const checkboxes = fieldset.querySelectorAll('.ability-checkbox');

                // Set all checkboxes in this fieldset to match the "Select All" checkbox state
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        });

        // Optional: If any individual checkbox is unchecked, uncheck the "Select All" checkbox (global and group-specific)
        document.querySelectorAll('.form-check-input.ability-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Check if all checkboxes in the entire form are checked
                const selectAllCheckbox = document.getElementById('select_all');
                const allCheckboxes = document.querySelectorAll('.ability-checkbox');

                selectAllCheckbox.checked = Array.from(allCheckboxes).every(cb => cb.checked);

                // Check if all checkboxes within the current group are checked, and update "Select All" for that group
                const fieldset = this.closest('fieldset');
                const selectAllGroupCheckbox = fieldset.querySelector('.form-check-input[id^="select_all_"]');
                const groupCheckboxes = fieldset.querySelectorAll('.ability-checkbox');

                selectAllGroupCheckbox.checked = Array.from(groupCheckboxes).every(cb => cb.checked);
            });
        });
    </script>



@endsection

