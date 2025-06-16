<div class="bg-white p-6 rounded shadow max-w-7xl mx-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="text-gray-700 font-semibold border-b">
                <th class="py-2 w-1/4">ID</th>
                <th class="py-2 w-1/2">Name</th>
                <th class="py-2 w-1/4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2">{{ $department->id }}</td>
                    <td class="py-2">{{ $department->name }}</td>
                    <td class="py-2">
                        <a href="#"
                           class="text-yellow-600 hover:underline mr-2 load-edit-form"
                           data-url="{{ route('admin.department.edit', $department->id) }}">
                            Edit
                        </a>

                        <button class="delete-department text-red-600 hover:underline"
                                data-url="{{ route('admin.department.destroy', $department->id) }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
