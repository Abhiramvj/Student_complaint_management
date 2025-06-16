<div class="bg-white p-4 rounded shadow mb-4">
    <h2 class="text-lg font-semibold mb-3">Create Department</h2>
    <form action="{{ route('admin.department.store') }}" method="POST" id="create-department-form">
    @csrf

    <input type="text" name="name" placeholder="Department Name" required class="w-full border px-3 py-2 mb-3">

    <input type="text" name="head_name" placeholder="Department Head Name" required class="w-full border px-3 py-2 mb-3">
    <input type="email" name="head_email" placeholder="Department Head Email" required class="w-full border px-3 py-2 mb-3">
    <input type="password" name="head_password" placeholder="Department Head Password" required class="w-full border px-3 py-2 mb-3">

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
</form>

</div>

