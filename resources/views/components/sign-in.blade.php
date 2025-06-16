
@auth
    @php
        $role = Auth::user()->role;
    @endphp

    @if($role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="sign-btn">Go to Dashboard</a>
    @elseif($role === 'department_head')
        <a href="{{ route('department.dashboard') }}" class="sign-btn">Go to Dashboard</a>
    @elseif($role === 'student')
        <a href="{{ route('student.dashboard') }}" class="sign-btn">Go to Dashboard</a>
    @else
        <a href="#" onclick="alert('Unknown role');" class="sign-btn">Sign in</a>
    @endif
@else
    <a href="{{ route('login') }}" class="sign-btn">Sign in</a>
@endauth
