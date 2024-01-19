@forelse ($items as $key => $item)
    <tr>
        <td class="align-middle text-center" style="width: 2%;">{{ ($items->currentPage() - 1) * $items->perPage() + $key + 1 }}</td>
        <td class="align-middle text-center" style="width: 4%;">
            <img alt="image" class="avatar avatar-md br-7"
                src="{{ asset('storage/users/profile_images/') }}/{{ $item['profile_image'] }}">
        </td>
        <td class="text-nowrap align-middle" style="width: 2%;">{{ $item['first_name'] }}</td>
        <td class="text-nowrap align-middle" style="width: 2%;">{{ $item['last_name'] }}</td>
        <td class="text-nowrap align-middle" style="width: 2%;">{{ $item['email'] }}</td>
        {{-- <td class="text-nowrap align-middle" style="width: 2%;">{{ $item['phone'] }}</td>
        <td class="text-nowrap align-middle" style="width: 2%;">{{ $item->teacher->department }}</td>
        <td class="text-nowrap align-middle" style="width: 2%;">{{ $item->teacher->teacher_id }}</td> --}}
        <td class="text-center align-middle" style="width: 2%;">
            <div class="form-group">
                <label class="custom-switch form-switch mb-0 pt-2">
                    <span
                        style="margin-right: 0.5rem;color: #6e7687;transition: 0.3s color;">Off</span>
                    <input type="checkbox" {{ $item['is_active'] == 1 ? 'checked' : '' }}
                        onchange="ajax_post('{{ route('admin.teachers.status-update', $item['id']) }}','','')"
                        class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">On</span>
                </label>
            </div>
        </td>
        <td class="text-center align-middle" style="width: 2%;">
            <div class="form-group">
                <label class="custom-switch form-switch mb-0 pt-2">
                    <span
                        style="margin-right: 0.5rem;color: #6e7687;transition: 0.3s color;">Off</span>
                    <input type="checkbox" {{ $item['is_verified'] == 1 ? 'checked' : '' }}
                        onchange="ajax_post('{{ route('admin.teachers.verification-update', $item['id']) }}','','')"
                        class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">On</span>
                </label>
            </div>
        </td>
        <td class="text-center align-middle" style="width: 2%;">
            <div class="g-2">
                <a class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"
                    href="{{ route('admin.teachers.edit', $item['id']) }}"><span
                        class="fe fe-edit fs-14"></span></a>
                <a class="btn text-danger btn-sm" href="javascript:void(0)" data-bs-toggle="tooltip"
                    data-bs-original-title="Delete" onclick="alert_function('delete-{{ $item['id'] }}')">
                    <span class="fe fe-trash-2 fs-14"></span></a>
                <form action="{{ route('admin.teachers.destroy', $item['id']) }}"
                    id="delete-{{ $item['id'] }}" method="post">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="11" class="text-center align-middle" style="padding: 3rem 0 !important;">
           Nothing to show !</td>
    </tr>
@endforelse
