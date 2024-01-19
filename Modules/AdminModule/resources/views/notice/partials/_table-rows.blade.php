@forelse ($items as $key => $item)
    <tr>
        <td class="align-middle text-center">{{ ($items->currentPage() - 1) * $items->perPage() + $key + 1 }}</td>
        <td class="text-nowrap align-middle">{{ $item['title'] }}</td>
        <td class="text-nowrap align-middle">{{substr($item['description'], 0, 20). '...'}}</td>
        <td class="text-center align-middle">
            <div class="form-group">
                <label class="custom-switch form-switch mb-0 pt-2">
                    <span style="margin-right: 0.5rem;color: #6e7687;transition: 0.3s color;">Off</span>
                    <input type="checkbox" {{ $item['is_active'] == 1 ? 'checked' : '' }}
                        onchange="ajax_post('{{ route('admin.notices.status-update', $item['id']) }}','','')"
                        class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">On</span>
                </label>
            </div>
        </td>
        <td class="text-center align-middle">
            <div class="g-2">
                <a class="btn text-primary btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Edit"
                    href="{{ route('admin.notices.edit', $item['id']) }}"><span class="fe fe-edit fs-14"></span></a>
                <a class="btn text-danger btn-sm" href="javascript:void(0)" data-bs-toggle="tooltip"
                    data-bs-original-title="Delete" onclick="alert_function('delete-{{ $item['id'] }}')">
                    <span class="fe fe-trash-2 fs-14"></span></a>
                <form action="{{ route('admin.notices.destroy', $item['id']) }}" id="delete-{{ $item['id'] }}"
                    method="post">
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
