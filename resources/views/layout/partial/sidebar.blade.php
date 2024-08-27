<div class="sidebar" style="width: 20vw; height: 100vh; padding: 15px; margin: 0; border-right: #1a202c solid 1px">
    <div style="height: 80%">
        <div style="margin: 11.5px 0">
            <h3 style="color: #9F41EA; font-weight: bold">RusCare</h3>
        </div>

        <hr class="my-2"  style="border: #1a202c 1px solid">

        <div style="display: flex; flex-direction: column; gap: 20px">
            <a href="/admin/dashboard" style="margin-top: 20px; text-decoration: none; font-size: large; font-weight: bold; color: #9F41EA">Dashboard</a>
            <a href="/admin/mentor" style="text-decoration: none; font-size: large; font-weight: bold; color: #9F41EA">Mentor</a>
            <a href="/admin/student" style="text-decoration: none; font-size: large; font-weight: bold; color: #9F41EA">Student</a>
        </div>
    </div>
    <div style="display: flex; height: 20%; justify-content: left; align-items: end">
{{--        <form action="/auth/logout" method="POST">--}}
{{--            @csrf--}}
{{--            <button class="nav-link d-flex align-items-center gap-2" onclick="return confirm('Are you sure you want to logout?')">--}}
{{--                Sign out--}}
{{--            </button>--}}
{{--        </form>--}}
        <form action="/auth/logout" method="post" class="d-inline">
            @csrf
            @method('post')
            <button onclick="return confirm('Are you sure you want to Logout')" style="text-decoration: none; font-size: large; font-weight: bold; margin-bottom: 7px; color: #ef4444; border: none; background: white">Logout</button>
        </form>
    </div>
</div>
