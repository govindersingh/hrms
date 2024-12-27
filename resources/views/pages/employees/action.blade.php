@canany(['edit-employee', 'delete-employee'])
<x-table-action>
    @can('edit-employee')
    <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('employees.edit', ['employee' => \Crypt::encrypt($id)]) }}" data-ajax-modal="true"
        data-title="Edit Employee" data-size="lg"><i class="fa-solid fa-pencil m-r-5"></i>
        {{ __('Edit') }}
    </a>
    @endcan
    @can('delete-employee')
    <a class="dropdown-item deleteBtn" data-route="{{ route('employees.destroy', $id) }}" data-title="Delete Employee"
        data-question="Are you sure you want to delete?" href="javascript:void(0)">
        <i class="fa-regular fa-trash-can m-r-5"></i>
        {{ __('Delete') }}
    </a>
    @endcan
</x-table-action>
@endcanany
