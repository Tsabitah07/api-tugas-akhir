<div class="sidebar" style="width: 20vw; height: 100vh; padding: 15px; margin: 0; border-right: #1a202c solid 1px">
    <div style="height: 80%">
        <div style="margin: 11.5px 0">
            <h3>Hello, Admin</h3>
        </div>

        <hr class="my-2"  style="border: #1a202c 1px solid">

        <div style="display: flex; flex-direction: column; gap: 15px">
            <a href="/admin/dashboard" style="text-decoration: none; font-size: large">Dashboard</a>
            <a href="/admin/mentor" style="text-decoration: none; font-size: large">Mentor</a>
            <a href="/admin/student" style="text-decoration: none; font-size: large">Student</a>
        </div>
    </div>
    <div style="display: flex; height: 20%; justify-content: left; align-items: end">
{{--        <form action="/auth/logout" method="POST">--}}
{{--            @csrf--}}
{{--            <button class="nav-link d-flex align-items-center gap-2" onclick="return confirm('Are you sure you want to logout?')">--}}
{{--                Sign out--}}
{{--            </button>--}}
{{--        </form>--}}
        <div>
            <p>Student</p>

        </div>

        <a style="text-decoration: none; font-size: large; font-weight: bold; margin-bottom: 7px">Logout</a>
    </div>
</div>
