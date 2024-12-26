@canany(['edit-PayrollDeduction','delete-PayrollDeduction'])
<x-table-action>
    @can('edit-PayrollDeduction')
    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('deductions.edit', $id) }}" data-ajax-modal="true"
        data-title="{{ __('Edit Deduction') }}" data-bs-toggle="tooltip" data-bs-title="{{ __('Edit Deduction') }}" data-size="md"><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    @endcan
    @can('delete-PayrollDeduction')
    <a class="dropdown-item deleteBtn" data-route="{{ route('deductions.destroy', $id) }}" data-title="{{ __('Delete Deduction') }}"
        data-question="{{ __('Are you sure you want to delete?') }}" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
    @endcan
</x-table-action>
@endcanany
