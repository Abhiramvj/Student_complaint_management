<form id="edit-department-form" action="{{ route('admin.department.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $department->name }}" required class="w-full border px-3 py-2 mb-3">
    <input type="text" name="head_name" value="{{ $head->name ?? '' }}" required class="w-full border px-3 py-2 mb-3">
    <input type="email" name="head_email" value="{{ $head->email ?? '' }}" required class="w-full border px-3 py-2 mb-3">
    <input type="password" name="head_password" placeholder="New Password (optional)" class="w-full border px-3 py-2 mb-3">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
</form>





