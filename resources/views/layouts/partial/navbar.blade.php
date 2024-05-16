<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-black" style="height: 729px">
    <div class="offcanvas-md offcanvas-end bg-black" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="" style="font-size: 20px">
                        Hello, {{ auth()->user()->name }}
                    </a>
                </li>

                <hr class="my-2 border">

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="/admin/dashboard/{{ auth()->user()->id }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="/admin/student">
                        Student
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/admin/class">
                        Class
                    </a>
                </li>
            </ul>

            <hr class="my-2 border">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <form action="/auth/logout" method="POST">
                        @csrf
                        <button class="nav-link d-flex align-items-center gap-2" onclick="return confirm('Are you sure you want to logout?')">
                            Sign out
                        </button>
                    </form>

                </li>
            </ul>
        </div>
    </div>
</div>
